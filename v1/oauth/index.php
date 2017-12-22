<?php
session_start();

//Connect to the Database
//The connection is in $conn
require_once '../../res/scripts/connect.php';

//Initialize array to store debug/success data
$success = array();
$debug = array();

// Error Handler
require_once '../res/kill.php';

/* Flag to check if the process was successful
* 0 - There are errors (default)
* 1 - No errors (check performed after all validations are completed) */
$flag=0;

if(!isset($_POST['username'],$_POST['password'])){
  kill('1157');
}

//Get device information, if provided (for Android, this could be ANDROID_ID)
if(isset($_POST['device-info'])){
  $devinfo = mysqli_real_escape_string($conn,$_POST['device-info']);
}
else if(isset($_SERVER['HTTP_USER_AGENT'])){
  $devinfo = mysqli_real_escape_string($conn,$_SERVER['HTTP_USER_AGENT']);
}
else{
  $devinfo = "Unknown";
}

//Get Username and password from POST
$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = $_POST['password'];

//Get debug variable
//Development code
if(isset($_POST['debug']) && $_POST['debug']=="1") {$isdebug = "true";}
else {$isdebug = "false";}

//Pass the query to the Database
$query_text="SELECT id,password,access_level FROM users WHERE username='$username'";

if(!($result=mysqli_query($conn,$query_text))){
  $debug['mysql']="Could not retrieve data from database. Error message: ".mysqli_error($conn);
  kill('5501');
}

//If no result found
if(mysqli_num_rows($result)==0){
  $debug['username']="Username ".$username." does not exist.";
  kill('1142');
}

//Get the data
$data = mysqli_fetch_array($result,MYSQLI_ASSOC);
$db_password = $data['password'];
$id = $data['id'];

//Verify password
if(password_verify($password,$db_password)){
  //If password is correct, generate auth_key and display it
  $_SESSION['username']=$username;
  $_SESSION['id']=$id;
  $_SESSION['access_level']=$data['access_level'];
  $auth_key = generate_auth_key();
  $cur_time = time();
  $auth_key_db = hash('sha1',$auth_key);
  $expiry = $cur_time + 2592000;

  //Insert the values in the Database
  $query_text = "INSERT INTO `auth_tokens` (`auth_key`, `user_id`, `creation_time`, `expiry`, `last_access`, `device_info`) VALUES ('$auth_key_db','".$_SESSION['id']."',$cur_time,$expiry, $cur_time, '$devinfo');";
  if(!mysqli_query($conn, $query_text)){
    $debug['mysql']="Could not insert data into database. Error message: ".mysqli_error($conn);
    kill('5501');
  }

  //Add auth_key to success
  $success['access_token']=$auth_key;
  $success['expiry']=$expiry;

  //Output json
  $json = array();
  $json['success']=true;
  $json['data']=$success;
  header('Content-Type: application/json');
  echo json_encode($json,JSON_PRETTY_PRINT);
}
//Else show error
else{
  kill('1142');
}

//Function to generate Unique ID for session storage
function generate_auth_key(){
  $auth_key = bin2hex(random_bytes(20)); //Cryptographically secure
  return $auth_key;
}
?>
