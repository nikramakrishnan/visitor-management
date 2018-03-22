<?php
$error=array();
$json=array();
// Error Handler
require_once 'res/kill.php';

//Get URI
$path = $_SERVER['REQUEST_URI'];

//Get substring after /v1
$startpos = strpos($path, "/v1/")+3;
$path = substr($path, $startpos);

//Message
kill('2600',$path);
?>
