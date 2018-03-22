<?php

$json_dat = array(); //Initialize array for encoding data to json format
$errors= array(); //Initialize array to store errors

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

//Connect to the Database
require '../../res/scripts/connect.php';

//Run query and get result from SQL server
$query_text = "SELECT visitee_no,name FROM visitees;";

if(!($result= mysqli_query($conn,$query_text))){
  kill('5501');
}
$column_names = array();  //Initialize array for saving property

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

?>
