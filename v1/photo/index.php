<?php

//Connect to the Database
//The connection is in $conn
require_once '../../res/scripts/connect.php';

$errors= array(); //Initialize array to store errors
$thumb = false; //Will be set to true if looking for specific object
//Require token validator
require_once '../../res/scripts/token.php';

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

//Check optional Parameters
if(isset($_GET['thumb'])){
  $thumb=true;
}

//Run query and get result from SQL server
$query_text = "SELECT `photo_ref` FROM visitors WHERE `visitor_id`='$get_id' AND in_campus=1;";

if(!($result= mysqli_query($conn,$query_text))){
  kill('5501');
}

// If no result found
if(mysqli_num_rows($result)==0){
  kill('3404',$get_id);
}

$row = mysqli_fetch_assoc($result);
$filename = $row['photo_ref'];

$remoteImage = "../../images/".$filename;
//If thumbnail requested
if($thumb==true){
  $remoteImage = "../../images/thumb/".$filename;
}
if(!(file_exists($remoteImage))){
  kill('4515');
}
$imginfo = getimagesize($remoteImage);
header("Content-type: ".$imginfo['mime']);
readfile($remoteImage);

//close Mysql connection
mysqli_close($conn);

?>
