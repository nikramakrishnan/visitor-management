<?php

$json_dat = array(); //Initialize array for encoding data to json format
$errors= array(); //Initialize array to store errors

//Require token validator
require '../../res/scripts/token.php';
/* This code must be un - commented when app implementation is completed.
 * It validates the token provided as POST data.
 * Without this, data will be displayed without authentication

//Check if all data is set
if(!isset($_POST['token'])){
  $errors['post']="Required data not supplied. Please check documentation for more information.";
  kill($errors);
}

//Validate token
$token_data=validate_token($_POST['token']);
if(!$token_data['validated']){
  $errors['access_token']="403: Invalid/expired token supplied.";
  kill($errors);
}

*/


//Connect to the Database
require '../../res/scripts/connect.php';

//Run query and get result from SQL server
$query_text = "SELECT card_no,name,entry_time,mobile,purpose FROM visitors WHERE in_campus=1 ORDER BY entry_time ASC;";
if(!($result= mysqli_query($conn,$query_text))){
  $error['server']="Server encountered an error. Please try again later";
  kill($errors);
}
$column_names = array();  //Initialize array for saving property

//If no result found
if(mysqli_num_rows($result)==0){
  $errors['no_data']="No data available.";
  kill($errors);
}

//Get column names
while ($column = mysqli_fetch_field($result)) {
    //Save column name to array
    array_push($column_names, $column->name);
}

//Store column names for encoding to json format
//$json_dat[] = $column_names;

//Get rows
while ($row = mysqli_fetch_assoc($result)) {
  //Store rows for encoding to json format
  $json_dat[] = $row;
}

//close Mysql connection
mysqli_close($conn);

//Output json data
header('Content-Type: application/json');
$json = array();
$json['success'] = true;
$json['data'] = $json_dat;
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
