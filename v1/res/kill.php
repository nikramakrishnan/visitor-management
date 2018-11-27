<?php

function kill($errcode, $param=null){
  $arr = array();

  /*
   * OAuthException - 1xxx
  */
  $arr['1142'] = array();
  $arr['1142']['message'] = "Wrong username/password. Please try again.";
  $arr['1142']['type']="OAuthException";

  $arr['1157'] = array();
  $arr['1157']['message'] = "Username/password not supplied.";
  $arr['1157']['type']="OAuthException";

  $arr['1190'] = array();
  $arr['1190']['message'] = "An active access token must be used to query information about the current visitors.";
  $arr['1190']['type']="OAuthException";

  $arr['1403'] = array();
  $arr['1403']['message'] = "Invalid OAuth access token.";
  $arr['1403']['type']="OAuthException";

  /*
   * APIMethodException - 2xxx/3xxx
  */

  $arr['2200'] = array();
  $arr['2200']['message'] = "Required data not supplied. Please check documentation for more information.";
  $arr['2200']['type']="APIMethodException";

  //NOTE: 23xx series is for the v1/add/ endpoint
  $arr['2301'] = array();
  $arr['2301']['message'] = "Incorrect format for field 'cardno'";
  $arr['2301']['type']="APIMethodException";

  $arr['2302'] = array();
  $arr['2302']['message'] = "Incorrect format for field 'mobile'";
  $arr['2302']['type']="APIMethodException";

  $arr['2303'] = array();
  $arr['2303']['message'] = "Incorrect format for field 'purpose'";
  $arr['2303']['type']="APIMethodException";


  $arr['2400'] = array();
  $arr['2400']['message'] = "Incorrect data format or data supplied is too large. Please check documentation for more information.";
  $arr['2400']['type']="APIMethodException";

  $arr['2415'] = array();
  $arr['2415']['message'] = "Incorrect format for image file";
  $arr['2415']['type']="APIMethodException";

  $arr['2600'] = array();
  $arr['2600']['message'] = "Unknown path components: $param";
  $arr['2600']['type']="APIMethodException";

  $arr['3100'] = array();
  $arr['3100']['message'] = "Unsupported get request. Please check documentation for more information.";
  $arr['3100']['type']="APIMethodException";

  $arr['3404'] = array();
  $arr['3404']['message']="Unsupported get request. Object with ID '$param' does not exist. Please check documentation for more information.";
  $arr['3404']['type']="APIMethodException";

  /*
   * RequestedObjectException - 4xxx
  */

  $arr['4515'] = array();
  $arr['4515']['message'] = "Image not available.";
  $arr['4515']['type']="RequestedObjectException";

  /*
   * ServerSideException - 5xxx
  */

  $arr['5501'] = array();
  $arr['5501']['message'] = "Server encountered an error. Please try again later";
  $arr['5501']['type']="ServerSideException";

  $errors = array();
  if(array_key_exists($errcode,$arr)){
    $errors['message'] = $arr[$errcode]['message'];
    $errors['type'] = $arr[$errcode]['type'];
    $errors['code'] = $errcode;
  }
  else{
    $errors['message'] = "Unknown error occured. This should not happen normally. Please contact a developer.";
    $errors['type'] = "ServerSideException";
    $errors['code'] = "5404";
  }
  killpage($errors);
}


//This will stop excecution immediately and show corresponding error(s)
function killpage($errors){
  //Development code
  global $isdebug,$debug;
  $json=array();
  $json['success']=false;
  $json['errors']=$errors;
  //Development code
  if(!empty($debug) && $isdebug==="true") $json['debug']=$debug;

  //Echo the data
  header('Content-Type: application/json');
  echo json_encode($json,JSON_PRETTY_PRINT);
  die(1);
}

?>
