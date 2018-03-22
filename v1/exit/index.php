<?php

//Connect to the Database
//The connection is in $conn
require_once '../../res/scripts/connect.php';

$success = array();
$errors= array(); //Initialize array to store errors
$spec_object = false; //Will be set to true if looking for specific object

//Require token validator
require '../../res/scripts/token.php';

// Error Handler
require_once '../res/kill.php';

$access_token = get_access_token();
if(is_null($access_token)){
  kill('1190');
}

//Validate token
$token_data=validate_token($access_token);
if(!$token_data['validated']){
  kill('1403');
}


//Check if required parameter is given
if(isset($_GET['v'])){
  $get_id = mysqli_real_escape_string($conn,$_GET['v']);
}
else{
  kill('3100');
}

//Set current date for DB insertion
$datetime = date('Y-m-d H:i:s');
$datetime = mysqli_real_escape_string($conn,$datetime);

//Run query and get result from SQL server
$query_text = "UPDATE `visitors` SET `exit_time` = '$datetime', `in_campus` = 0 WHERE `visitor_id` = '$get_id';";

if(!mysqli_query($conn,$query_text)){
  kill('5501');
}
$column_names = array();  //Initialize array for saving property

// If nothing updated
if(mysqli_affected_rows($conn)==0){
  kill('3404',$get_id);
}

//close Mysql connection
mysqli_close($conn);

//Output json data
header('Content-Type: application/json');
$json = array();
$json['success'] = true;
echo json_encode($json,JSON_PRETTY_PRINT);

?>
