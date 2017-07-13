<?php

$success = array();
$errors= array(); //Initialize array to store errors
$spec_object = false; //Will be set to true if looking for specific object
//Require token validator
require '../../res/scripts/token.php';

$access_token = get_access_token();
if(is_null($access_token)){
  $errors['headers']="An active access token must be used to query information about the current visitors.";
  $errors['type']="OAuthException";
  $errors['code']="1190";
  kill($errors);
}

//Validate token
$token_data=validate_token($access_token);
if(!$token_data['validated']){
  $errors['access_token']="Invalid OAuth access token.";
  $errors['type']="OAuthException";
  $errors['code']=$token_data['code'];
  kill($errors);
}



//Connect to the Database
require '../../res/scripts/connect.php';

//Check if required parameter is given
if(isset($_GET['v'])){
  $get_id = mysqli_real_escape_string($conn,$_GET['v']);
}
else{
  $errors['message']="Unsupported get request. Please read the API documentation.";
  $errors['type']="APIMethodException";
  $errors['code']="3100";
  kill($errors);
}

//Set current date for DB insertion
$datetime = date('Y-m-d H:i:s');
$datetime = mysqli_real_escape_string($conn,$datetime);

//Run query and get result from SQL server
$query_text = "UPDATE `visitors` SET `exit_time` = '$datetime', `in_campus` = 0 WHERE `visitor_id` = '$get_id';";

if(!mysqli_query($conn,$query_text)){
  $errors['server']="Server encountered an error. Please try again later";
  $errors['type']="ServerSideException";
  $errors['code']="5501";
  kill($errors);
}
$column_names = array();  //Initialize array for saving property

// If nothing updated
if(mysqli_affected_rows($conn)==0){
  $errors['no_data']="Unsupported get request. Object with ID '$get_id' does not exist. Please read the API documentation.";
  $errors['type']="APIMethodException";
  $errors['code']="3404";
  kill($errors);
}

//close Mysql connection
mysqli_close($conn);

//Output json data
header('Content-Type: application/json');
$json = array();
$json['success'] = true;
echo json_encode($json,JSON_PRETTY_PRINT);

//This will stop excecution immediately and show corresponding error(s)
function kill($errors){
  header('Content-Type: application/json');
  $json=array();
  $json['success']=false;
  $json['errors']=$errors;
  echo json_encode($json,JSON_PRETTY_PRINT);
  die(1);
}

?>
