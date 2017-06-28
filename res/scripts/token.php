<?php
//Connect to the Database
//The connection is in $conn
require 'res/scripts/connect.php';

function validate_token($token){
  //Variables
  global $conn;
  $return_data = array();

  $token = hash('sha1',$token);
  $query_text = "SELECT `user_id`, `expiry` FROM `auth_tokens` WHERE `auth_key`='$token'";

  if(!($result=mysqli_query($conn,$query_text))){
    $return_data['validated']=false;
    $return_data['error']="Could not connect to Database. Please try again later";
    return $return_data;
  }

  if(mysqli_num_rows($result)==0){
    $return_data['validated']=false;
    $return_data['error']="Invalid Token";
    return $return_data;
  }
  else{
    //Get the data
    $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $isValid = validate_expiry($data['expiry']);
    if($isValid){
      $return_data['validated']=true;
      $return_data['id'] = $data['user_id'];
      $return_data['expiry'] = $data['expiry'];
    }
    else{
      $return_data['validated']=false;
      $return_data['error']="Invalid token";
      $return_data['expired']=true;
      $result = delete_token($token);
    }
    return $return_data;
  }
}

function validate_expiry($expiry){
  $curtime = time();
  if($curtime<$expiry) return true;
  else return false;
}

function delete_token($token){
  global $conn;

  $query_text = "DELETE FROM `auth_tokens` WHERE `auth_tokens`.`auth_key` = '$token';";

  if(mysqli_query($conn,$query_text)){
    return true;
  }
  else{
    return false;
  }
}
?>
