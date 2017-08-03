<?php
//Initialize array to store error/success data
$errors= array();
$success=array();
$debug = array();
$visitee_no = -1;

//Check if all data is set
if(!isset($_POST['cardno'],$_POST['name'],$_POST['mobile'],$_POST['purpose'],$_POST['access_token'])){
  $errors['post']="Required data not supplied. Please check documentation for more information.";
  $errors['type']="APIMethodException";
  $errors['code']="2200";
  kill($errors);
}

//Require token validator
require '../../res/scripts/token.php';

//Validate token
$token_data=validate_token($_POST['access_token']);
if(!$token_data['validated']){
  $errors['access_token']="403: Invalid/expired token supplied.";
  $errors['type']="OAuthException";
  $errors['code']=$token_data['code'];
}

//Start validation only if all data is provided and token is valid
if(empty($errors)==true){

  //Connect to the Database
  //The connection is in $conn
  require '../../res/scripts/connect.php';

  //Assign variables to POST data and escape them
  $cardno = $_POST['cardno'];
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $mobile = $_POST['mobile'];
  $purpose = mysqli_real_escape_string($conn,$_POST['purpose']);

  //Assign visitee number if provided otherwise remains default as -1
  if(isset($_POST['visitee_no']))
  	$visitee_no = $_POST['visitee_no'];

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

  //Validate card number
  function validate_cardno($numcard){
    return preg_match('/^[0-9]+$/', $numcard);
  }
  if(validate_cardno($cardno)==0){
    $errors['cardno']="Please enter a valid card number";
    $errors['type']="APIMethodException";
    $errors['code']="2400";
  }

  //Validate Mobile Number
  function validate_mobile($nummob){
    return preg_match('/^[+]?[0-9]{6,15}$/', $nummob);
  }
  if(validate_mobile($mobile)==0){
    $errors['mobile']="Please enter a valid mobile number";
    $errors['type']="APIMethodException";
    $errors['code']="2400";
  }

  //Validate purpose
  function validate_purpose($purpose){
    if(empty($purpose)){
      $errors['purpose']="Please select/enter a valid purpose";
      $errors['type']="APIMethodException";
      $errors['code']="2400";
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
    $errors['format']="Image file required";
    $errors['type']="APIMethodException";
    $errors['code']="2415";
  }

  if($file_size > 5242880){
    $errors['image_size']='File size must not be greater than than 5 MB';
    $errors['type']="APIMethodException";
    $errors['code']="2400";
  }

  //If there are no errors yet, upload the image
  if(empty($errors)==true){
    $uid=generate_uuid(); //Also the Visitor ID
    $uid_name = $uid.'.'.$file_ext;
    if(move_uploaded_file($file_tmp,"../../images/".$uid_name)){
      $success['image']=true;
      $success['visitor_id']=$uid;
      make_thumb("../../images/".$uid_name, "../../images/thumb/".$uid_name, 200);
    }
    else{
      $errors['server']="Server encountered an error. Please try again later";
      $errors['type']="ServerSideException";
      $errors['code']="5501";
      $debug['upload']="Sorry, could not upload photo. Please try again in a while";
    }
  }
}else{
  $errors['image']="Image file not supplied";
  $errors['type']="APIMethodException";
  $errors['code']="2200";
}

/* Generate file name for image.
* Activated the more_entropy parameter. This makes uniqid() more unique */
function generate_uuid(){
  $unique_id=uniqid(mt_rand(1,99999), true);
  $unique_id = hash('sha1',$unique_id);
  return $unique_id;
}

//If there are no errors yet, Add new row to database (visitors)
if(empty($errors)==true){
	if($visitee_no==-1)	
	  $query_text = "INSERT INTO `visitors` (`visitor_id`, `card_no`, `name`, `mobile`, `purpose`, `photo_ref`, `entry_time`, `added_by`) VALUES ('$uid', $cardno, '$name', '$mobile', '$purpose', '$uid_name', '$datetime','$user_id');";
	else
		$query_text = "INSERT INTO `visitors` (`visitor_id`, `card_no`, `name`, `mobile`, `purpose`, `photo_ref`, `entry_time`, `added_by`, `visitee_no`) VALUES ('$uid', $cardno, '$name', '$mobile', '$purpose', '$uid_name', '$datetime','$user_id', '$visitee_no' );";

  if(!mysqli_query($conn, $query_text)){
    $errors['server']="Server encountered an error. Please try again later";
    $errors['type']="ServerSideException";
    $errors['code']="5501";
    $debug['mysql']="Could not insert data into database. Error message: ".mysqli_error($conn);

    delete_image(); //Delete image if SQL insertion was unsuccessful

    kill($errors); //Kill the process
  }
}

//Function to delete the image from server if the SQL query was unsuccessful
function delete_image(){
  global $uid_name,$errors;
  $file_loc = '../../images/'.$uid_name;
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
  $json['visitor_id']= $success['visitor_id'];
}
else{
  $json['success']=false;
  $json['errors']= $errors;
  //Development code
  if(!empty($debug) && $isdebug==="true") $json['debug']=$debug;
}
header('Content-Type: application/json');
echo json_encode($json,JSON_PRETTY_PRINT);

function make_thumb($src, $dest, $desired_width) {

  /* read the source image */
  if(!($source_image = imageCreateFromAny($src))){
    return false;
  }
  $width = imagesx($source_image);
  $height = imagesy($source_image);

  /* find the "desired height" of this thumbnail, relative to the desired width  */
  $desired_height = floor($height * ($desired_width / $width));

  /* create a new, "virtual" image */
  $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

  /* copy source image at a resized size */
  imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

  /* create the physical thumbnail image to its destination */
  if(!(imagejpeg($virtual_image, $dest))){
    return false;
  }
  imagedestroy($virtual_image);
  return true;
}

function imageCreateFromAny($filepath) {
    $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
    $allowedTypes = array(
        1,  // [] gif
        2,  // [] jpg
        3,  // [] png
        6   // [] bmp
    );
    if (!in_array($type, $allowedTypes)) {
        return false;
    }
    switch ($type) {
        case 1 :
            $im = imageCreateFromGif($filepath);
        break;
        case 2 :
            $im = imageCreateFromJpeg($filepath);
        break;
        case 3 :
            $im = imageCreateFromPng($filepath);
        break;
        case 6 :
            $im = imageCreateFromBmp($filepath);
        break;
    }
    return $im;
}


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
  echo json_encode($json,JSON_PRETTY_PRINT);
  die(1);
}
?>
