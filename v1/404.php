<?php
$error=array();
$json=array();
$error['message']="404: API endpoint does not exist";
$error['type']="APIException";
$json['success']=false;
$json['errors']=$error;

header('Content-Type: application/json');
echo json_encode($json);
?>
