<?php
$error=array();
$json=array();
//Get URI
$path = $_SERVER['REQUEST_URI'];
//Get substring after /v1
$startpos = strpos($path, "/v1/")+3;
$path = substr($path, $startpos);
//Message
$error['message']="Unknown path components: $path";
$error['type']="APIException";
$error['code']="2600";
$json['success']=false;
$json['errors']=$error;

header('Content-Type: application/json');
echo json_encode($json);
?>
