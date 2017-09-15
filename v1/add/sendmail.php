<?php
function email($conn,$visitee_no,$visitor_name,$org,$mobile,$visit_reason){
	require 'gmail2.php';
	$mail_data = array();

	//Get visitee email ID
	$visitee_query = "SELECT `name`,`email` FROM `visitees` WHERE `visitee_no`='$visitee_no'";
	if(!($visitee_result= mysqli_query($conn,$visitee_query))){
		return 0;
	}
	if(mysqli_num_rows($visitee_result)==0){
		return 0;
	}
	$visitee_row = mysqli_fetch_assoc($visitee_result);
	$visitee_email = $visitee_row['email'];
	//Set up required arguments
	$args = array();
	$args['visitee_name'] = $visitee_row['name'];
	$args['visitor_name'] = $visitor_name;
	$args['visitor_org'] = $org;
	$args['visitor_mobile'] = $mobile;
	$args['visit_reason'] = $visit_reason;
	// function logger($msg){
	// $logdate=date("Y-m-d H:i:s");
	// $ip=$_SERVER["REMOTE_ADDR"];
	// $logtxt=$logdate."; Remote IP: ".$ip."; Message: ".$msg.";";
	// $myfile = file_put_contents('logs.txt', $logtxt.PHP_EOL , FILE_APPEND | LOCK_EX);
	// }

	$mail_data = sendmail($visitee_email,$args);
	if(isset($mail_data['success'])){
		return 1;
	}
	else if(isset($mail_data['mailerror'])){
		return 0;
	}
}
?>
