<?php
//Assign variables to POST data

$cardno = $_POST['cardno'];
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$purpose = $_POST['purpose'];

//Initialize array to store error/success data
$errors= array();
$success=array();
//Flag to check if process was successfull
$flag=0;
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
    $errors['image']="400: Image file required";
  }

  if($file_size > 5242880){
    $errors['image2']='400: File size must not be greater than than 5 MB';
  }

  if(empty($errors)==true){
    $uid=generate_uuid();
    $uid_name = $uid.'.'.$file_ext;
    if(move_uploaded_file($file_tmp,"images/".$uid_name)){
      $success['image']=true;
      $success['image-url']=$uid_name;
      $flag=1;
    }
    else{
      $errors['upload']="Sorry, could not upload photo. Please try again in a while";
      $flag=0;
    }
  }else{
    $flag=0;
  }
}
//Generate file name for image
/* Activated the more_entropy parameter. This makes uniqid() more unique */
function generate_uuid(){
  $unique_id=uniqid(mt_rand(), true);
  $unique_id = str_replace('.', '',$unique_id);
  return $unique_id;
}

//Print errors/success depending on flag
$json=array();
if($flag==1){
  $json['success']=true;
  $json['info']= $success;
}
else{
  $json['success']=false;
  $json['errors']= $errors;
}
header('Content-Type: application/json');
echo json_encode($json);
?>
