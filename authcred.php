<?php
session_start();

//Initialize array to store error/success data
$errors= array();
$success=array();

/* Flag to check if the process was successful
* 0 - There are errors (default)
* 1 - No errors (check performed after all validations are completed) */
$flag=0;

if(!isset($_POST['username'],$_POST['password'])){
  $errors['data']="Username/password not supplied.";
  kill($errors);
}

//Get device information, if provided (for Android, this could be ANDROID_ID)
if(isset($_POST['device-info'])){
  $devinfo = $_POST['device-info'];
}
else if(isset($_SERVER['HTTP_USER_AGENT'])){
  $devinfo = $_SERVER['HTTP_USER_AGENT'];
}
else{
  $devinfo = "Unknown";
}

//Connect to the Database
//The connection is in $conn
require 'res/scripts/connect.php';

//Get Username and password from POST
$username = $_POST['username'];
$password = $_POST['password'];

//Pass the query to the Database
$query_text="SELECT id,password,access_level FROM users WHERE username='$username'";
$result=mysqli_query($conn,$query_text);

//If no result found
if(mysqli_num_rows($result)==0){
  $errors['credentials']="Wrong username/password. Please try again.";
  kill($errors);
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
    $errors['mysql']="Could not insert data into database. Error message: ".mysqli_error($conn);
    kill($errors);
  }

  //Add auth_key to success
  $success['auth_key']=$auth_key;

  //Output json
  $json = array();
  header('Content-Type: application/json');
  $json['success']=true;
  $json['data']=$success;
  echo json_encode($json);
}
//Else show error
else{
  $errors['credentials']="Wrong username/password. Please try again.";
  kill($errors);
}

//Function to generate Unique ID for session storage
function generate_auth_key(){
  $auth_key = bin2hex(random_bytes(20)); //Cryptographically secure
  return $auth_key;
}

//This will stop excecution immediately and show corresponding error(s)
function kill($errors){
  header('Content-Type: application/json');
  $json=array();
  $json['success']=false;
  $json['errors']=$errors;
  echo json_encode($json);
  die(1);
}
?>
