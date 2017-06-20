<?php
//TODO - Reject/404 if directly opened via browser

//Credentials
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
mysqli_select_db($conn,"vms");
?>
