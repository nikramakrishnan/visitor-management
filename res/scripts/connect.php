<?php
//TODO - Reject/404 if directly opened via browser

// Error Handler
require_once '../../v1/res/kill.php';

//Credentials
$servername = "localhost";//"mysql4.gear.host";
$username = "root";//"vms";
$password = "";//"FRt01#63Z";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  if(function_exists(kill)){
    kill('5501');
  }
  else if(function_exists(error)){
    error("504: Internal Server Error. Please try again in a while.
    If problem persists, contact the developer with the Error Code <strong>CONNECTION_ACTIVELY_REFUSED</strong>");
  }
  else die("504: Internal Server Error. Please try again in a while.
  If problem persists, contact the developer with the Error Code <strong>CONNECTION_ACTIVELY_REFUSED</strong>");
}
//echo "Connected successfully";
mysqli_select_db($conn,"vms");
?>
