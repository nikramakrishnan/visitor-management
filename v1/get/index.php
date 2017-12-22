<?php

//Connect to the Database
require_once '../../res/scripts/connect.php';

$json_dat = array(); //Initialize array for encoding data to json format
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

//Run query and get result from SQL server
$query_text = "SELECT visitor_id,card_no,name,entry_time,mobile,purpose FROM visitors WHERE in_campus=1 ORDER BY entry_time ASC;";

//If specific visitor data is requested, provide that
if(isset($_GET['v'])){
  $spec_object = true; //Set specific object search
  $get_id = mysqli_real_escape_string($conn,$_GET['v']);
  $query_text = "SELECT visitor_id,card_no,name,entry_time,mobile,purpose FROM visitors WHERE `visitor_id`='$get_id' AND in_campus=1;";
}

if(!($result= mysqli_query($conn,$query_text))){
  kill('5501');
}
$column_names = array();  //Initialize array for saving property

if($spec_object){
  // If no result found
  if(mysqli_num_rows($result)==0){
    //Suply param with kill for parametrized error
    kill('3404',$get_id);
  }
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

?>
