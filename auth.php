<?php
session_start();

//Get the next page
$next = $_GET['next'];

//Check if required data was supplied
if(!isset($_POST['username'])||!isset($_POST['password'])){
  error("Please login to continue");
}

//Connect to the Database
//The connection is in $conn
require 'res/scripts/connect.php';

//Get Username and password from POST
$username = mb_strtolower($_POST['username']);
$username = mysqli_real_escape_string($conn,$username);
$password = $_POST['password'];

//Pass the query to the Database
$query_text="SELECT password,access_level,id FROM users WHERE username='$username'";
if(!($result=mysqli_query($conn,$query_text))){
  error("500: Internal Server Error. Please try again in a while.
          If problem persists, contact the developer with the Error Code <strong>".mysqli_errno($conn)."</strong>");
}
#If no result found
if(mysqli_num_rows($result)==0){
  error("Wrong username/password. Please try again.");
}

//Get the data
$data = mysqli_fetch_array($result,MYSQLI_ASSOC);
$db_password = $data['password'];

//Verify password
if(password_verify($password,$db_password)){
  //If password is correct, redirect to home page
  $_SESSION['username']=$username;
  $_SESSION['access_level']=$data['access_level'];
  $_SESSION['id']=$data['id'];
  echo 'Log in successful. <a href="'.$next.'">Click here</a> if you are not redirected.';
  header('Location: '.$next);
}
//Else go back to home page
else{
  error("Wrong username/password. Please try again.");
}

//Function to supply error messages
function error($errMsg){
  global $next;
  $_SESSION['errMsg']=$errMsg;
  if(isset($_POST['username']))
    $_SESSION['errorusr']=$_POST['username'];
    if($next=="home.php") header('Location: index.php');
    else header('Location: index.php?next='.$next);
  die("Error. If not redirected, <a href='/index.php?next=".$next.">Click here</a> to go to the Home Page.");
}
?>
