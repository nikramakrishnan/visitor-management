<?php
//Connect to the Database
//The connection is in $conn
require 'connect.php';

function validate_token($token){
  //Variables
  global $conn;
  $return_data = array();
  $errors = array();

  $token = hash('sha1',$token);
  $query_text = "SELECT `id`, `user_id`, `expiry` FROM `auth_tokens` WHERE `auth_key`='$token'";

  if(!($result=mysqli_query($conn,$query_text))){
    $return_data['validated']=false;
    $return_data['error']="Could not connect to Database. Please try again later";
    $return_data['code']="5501";
    //Kill page
    $errors['server']="Server encountered an error. Please try again later";
    $errors['type']="ServerSideException";
    $errors['code']="5501";
    if(function_exists(kill)){
      kill($errors);
    }
    return $return_data;
  }

  if(mysqli_num_rows($result)==0){
    $return_data['validated']=false;
    $return_data['error']="Invalid Token";
    $return_data['code']="1403";
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
      $token_id = $data['id'];
      $result = update_time($conn,$token_id);
    }
    else{
      $return_data['validated']=false;
      $return_data['error']="Invalid token";
      $return_data['expired']=true;
      $return_data['code']="1403";
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
  /* Function deletes a token if it is found to be expired
   * This ensures the table remains clean
   */

  global $conn;

  $query_text = "DELETE FROM `auth_tokens` WHERE `auth_tokens`.`auth_key` = '$token';";

  if(mysqli_query($conn,$query_text)){
    return true;
  }
  else{
    return false;
  }
}

function update_time($conn,$token_id){
  /* Function updates the access time as soon as the token is validated
   * Parameters:
   * $conn - Database connection
   * $token_id - ID of the token (NOTE: This is NOT the user id)
   */

  $curtime = time();
  $query_text = "UPDATE `auth_tokens` SET `last_access` = '".$curtime."' WHERE `auth_tokens`.`id` = ".$token_id.";";

  if(mysqli_query($conn,$query_text)){
    return true;
  }
  else{
    return false;
  }
}

function get_access_token(){
  /*
   * Returns access token from Apache HTTP Headers.
   *
   * Header name: Authorization
   * Header key format: Token <access_token>
   *
   * Returns token value if exists
   * Else returns null.
   */

  $token = null;
  $headers = apache_request_headers();
  if(isset($headers['Authorization'])){
    $matches = array();
    preg_match('/(?:token|Token) (.*)/', $headers['Authorization'], $matches);
    if(isset($matches[1])){
      $token = $matches[1];
    }
  }
  //Fix for weird HTTPS bug on 000
  else if(isset($headers['authorization'])){
    $matches = array();
    preg_match('/(?:token|Token) (.*)/', $headers['authorization'], $matches);
    if(isset($matches[1])){
      $token = $matches[1];
    }
  }
  return $token;
}
?>
