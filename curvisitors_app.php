<?php

$json_dat = array(); //Initialize array for encoding data to json format
$errors= array(); //Initialize array to store errors

//Require token validator
require 'token.php';

//Validate token
$token_data=validate_token($_POST['token']);
if(!$token_data['validated']){
  $errors['token']="403: Invalid/expired token supplied.";
}

//Connect to the Database
require 'res/scripts/connect.php';

//Run query and get result from SQL server
$result= mysqli_query($conn,"SELECT visitor_no,card_no,name,mobile,purpose FROM visitors WHERE in_campus=1;");
$column_names = array();  //Initialize array for saving property

//If no result found
if(mysqli_num_rows($result)==0){
  $errors['no_data']="No data was received from database".mysqli_error($conn);
  kill($errors);
}

//Get column names
while ($column = mysqli_fetch_field($result)) {
    //Save column name to array 
    array_push($column_names, $column->name);  
}

//Store column names for encoding to json format
$json_dat[] = $column_names; 

//Get rows 
while ($row = mysqli_fetch_array($result)) {
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
echo json_encode($json);

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