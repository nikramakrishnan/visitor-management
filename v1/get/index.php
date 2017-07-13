<?php

$json_dat = array(); //Initialize array for encoding data to json format
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

//Run query and get result from SQL server
$query_text = "SELECT visitor_id,card_no,name,entry_time,mobile,purpose FROM visitors WHERE in_campus=1 ORDER BY entry_time ASC;";

//If specific visitor data is requested, provide that
if(isset($_GET['v'])){
  $spec_object = true; //Set specific object search
  $get_id = mysqli_real_escape_string($conn,$_GET['v']);
  $query_text = "SELECT visitor_id,card_no,name,entry_time,mobile,purpose FROM visitors WHERE `visitor_id`='$get_id' AND in_campus=1;";
}

if(!($result= mysqli_query($conn,$query_text))){
  $errors['server']="Server encountered an error. Please try again later";
  $errors['type']="ServerSideException";
  $errors['code']="5501";
  kill($errors);
}
$column_names = array();  //Initialize array for saving property

if($spec_object){
  // If no result found
  if(mysqli_num_rows($result)==0){
    $errors['no_data']="Unsupported get request. Object with ID '$get_id' does not exist. Please read the API documentation.";
    $errors['type']="APIMethodException";
    $errors['code']="3404";
    kill($errors);
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
