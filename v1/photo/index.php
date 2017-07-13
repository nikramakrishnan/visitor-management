<?php

$errors= array(); //Initialize array to store errors
$thumb = false; //Will be set to true if looking for specific object
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
  $errors['code']="1100";
  kill($errors);
}

//Check optional Parameters
if(isset($_GET['thumb'])){
  $thumb=true;
}

//Run query and get result from SQL server
$query_text = "SELECT `photo_ref` FROM visitors WHERE `visitor_id`='$get_id' AND in_campus=1;";

if(!($result= mysqli_query($conn,$query_text))){
  $errors['server']="Server encountered an error. Please try again later";
  $errors['type']="ServerSideException";
  $errors['code']="1501";
  kill($errors);
}

// If no result found
if(mysqli_num_rows($result)==0){
  $errors['no_data']="Unsupported get request. Object with ID '$get_id' does not exist. Please read the API documentation.";
  $errors['type']="APIMethodException";
  $errors['code']="1404";
  kill($errors);
}

$row = mysqli_fetch_assoc($result);
$filename = $row['photo_ref'];

$remoteImage = "../../images/".$filename;
//If thumbnail requested
if($thumb==true){
  $remoteImage = "../../images/thumb/".$filename;
}
if(!(file_exists($remoteImage))){
  $errors['thumb']="Thumbnail was not generated. Please use full image.";
  $errors['type']="APIMethodException";
  $errors['code']="1415";
  kill($errors);
}
$imginfo = getimagesize($remoteImage);
header("Content-type: ".$imginfo['mime']);
readfile($remoteImage);

//close Mysql connection
mysqli_close($conn);

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
