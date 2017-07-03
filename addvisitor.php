<?php

/* BEWARE!
 * This file is deprecated and will be removed in subsequent versions.
 * Please use the /v1/add/ endpoint
 */

 //Initialize array to store error/success data
 $errors= array();
 $success=array();
 $debug = array();

 //Check if all data is set
 if(!isset($_POST['cardno'],$_POST['name'],$_POST['mobile'],$_POST['purpose'],$_POST['token'])){
   $errors['post']="Required data not supplied. Please check documentation for more information.";
   kill($errors);
 }

 //Require token validator
 require 'res/scripts/token.php';

 //Validate token
 $token_data=validate_token($_POST['token']);
 if(!$token_data['validated']){
   $errors['access_token']="403: Invalid/expired token supplied.";
 }

 //Start validation only if all data is provided and token is valid
 if(empty($errors)==true){

   //Assign variables to POST data
   $cardno = $_POST['cardno'];
   $name = $_POST['name'];
   $mobile = $_POST['mobile'];
   $purpose = $_POST['purpose'];

   //Assign variable to current DateTime
   $datetime = date("Y-m-d H:i:s");

   //Get current user ID from $token_data
   $user_id=$token_data['id'];

   //Development code
   //Get debug variable
   if(isset($_POST['debug']) && $_POST['debug']=="1") {$isdebug = "true";}
   else {$isdebug = "false";}

   /* Flag to check if the process was successful
   * 0 - There are errors (default)
   * 1 - No errors (check performed after all validations are completed) */
   $flag=0;

   //Connect to the Database
   //The connection is in $conn
   require 'res/scripts/connect.php';

   //Validate card number
   function validate_cardno($numcard){
     return preg_match('/^[0-9]+$/', $numcard);
   }
   if(validate_cardno($cardno)==0){
     $errors['cardno']="Please enter a valid card number";
   }

   //Validate Mobile Number
   function validate_mobile($nummob){
     return preg_match('/^[0-9]{5,10}+$/', $nummob);
   }
   if(validate_mobile($mobile)==0){
     $errors['mobile']="Please enter a valid mobile number";
   }

   //Validate purpose
   function validate_purpose($purpose){
     if(empty($purpose)){
       $errors['purpose']="Please select/enter a valid purpose";
     }
   }

 }

 //Validate Image
 if(isset($_FILES['image'])){
   $file_name = $_FILES['image']['name'];
   $file_size =$_FILES['image']['size'];
   $file_tmp =$_FILES['image']['tmp_name'];
   $file_type=$_FILES['image']['type'];
   $file_ext_p=explode('.',$_FILES['image']['name']);
   $file_ext=strtolower(end($file_ext_p));

   $expensions= array("jpeg","jpg","png","bmp");

   if(in_array($file_ext,$expensions)=== false){
     $errors['format']="400: Image file required";
   }

   if($file_size > 5242880){
     $errors['image_size']='400: File size must not be greater than than 5 MB';
   }

   //If there are no errors yet, upload the image
   if(empty($errors)==true){
     $uid=generate_uuid();
     $uid_name = $uid.'.'.$file_ext;
     if(move_uploaded_file($file_tmp,"images/".$uid_name)){
       $success['image']=true;
       $success['image_url']=$uid_name;
     }
     else{
       $errors['server']="Server encountered an error. Please try again later";
       $debug['upload']="Sorry, could not upload photo. Please try again in a while";
     }
   }
 }else{
   $errors['image']="Image file not supplied";
 }

 /* Generate file name for image.
 * Activated the more_entropy parameter. This makes uniqid() more unique */
 function generate_uuid(){
   $unique_id=uniqid(mt_rand(1,99999), true);
   $unique_id = str_replace('.', '',$unique_id);
   return $unique_id;
 }

 //If there are no errors yet, Add new row to database (visitors)
 if(empty($errors)==true){
   $query_text = "INSERT INTO visitors (card_no, name, mobile, purpose, photo_ref, entry_time, added_by) VALUES ($cardno, '$name', $mobile, '$purpose', '$uid_name', '$datetime','$user_id');";

   if(!mysqli_query($conn, $query_text)){
     $errors['server']="Server encountered an error. Please try again later";
     $debug['mysql']="Could not insert data into database. Error message: ".mysqli_error($conn);

     delete_image(); //Delete image if SQL insertion was unsuccessful

     kill($errors); //Kill the process
   }
 }

 //Function to delete the image from server if the SQL query was unsuccessful
 function delete_image(){
   global $uid_name,$errors;
   $file_loc = 'images/'.$uid_name;
   unlink($file_loc);
 }

 //Check if errors is empty, and set flag accordingly
 if(empty($errors)==true){
   $flag=1;
 }
 else{
   $flag=0;
 }

 //Print errors/success depending on flag
 $json=array();
 if($flag==1){
   $json['success']=true;
   $json['image_url']= $success['image_url'];
 }
 else{
   $json['success']=false;
   $json['errors']= $errors;
   //Development code
   if(!empty($debug) && $isdebug==="true") $json['debug']=$debug;
 }
 header('Content-Type: application/json');
 echo json_encode($json);


 //Other Functions
 //This will stop excecution immediately and show corresponding error(s)
 function kill($errors){
   //Development code
   global $isdebug,$debug;
   $json=array();
   $json['success']=false;
   $json['errors']=$errors;
   //Development code
   if(!empty($debug) && $isdebug==="true") $json['debug']=$debug;

   //Echo the data
   header('Content-Type: application/json');
   echo json_encode($json);
   die(1);
 }
 ?>
