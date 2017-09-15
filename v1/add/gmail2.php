<?php
require 'mail/PHPMailerAutoload.php';
//The function starts here because we need to have the require only once
function sendmail($email,$args){
  //Variable to store status
  $mailer_msg = array();
  //Create a new PHPMailer instance
  $mail = new PHPMailer;

  //Tell PHPMailer to use SMTP
  $mail->isSMTP();

  //Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 0;

  //Ask for HTML-friendly debug output
  $mail->Debugoutput = 'html';

  //Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';
  // use
  // $mail->Host = gethostbyname('smtp.gmail.com');
  // if your network does not support SMTP over IPv6

  //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 587;

  //Set the encryption system to use - ssl (deprecated) or tls
  $mail->SMTPSecure = 'tls';

  //Whether to use SMTP authentication
  $mail->SMTPAuth = true;

  //Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = "bennettlaundry@gmail.com";

  //Password to use for SMTP authentication
  $mail->Password = "laundrybu@123";

  //Set who the message is to be sent from
  $mail->setFrom('bennettlaundry@gmail.com', 'Visitor Information');

  //Set an alternative reply-to address
  $mail->addReplyTo('it-support@bennett.edu.in', 'Visitor Information');

  //Set who the message is to be sent to
  $mail->addAddress($email);
    ob_start();
    include('contents_1.php');
    $date=date("d/m");
    $subject='You have a Visitor';
    $body=ob_get_clean();
  //Set the subject line

  $mail->Subject = $subject;

  //Read an HTML message body from an external file, convert referenced images to embedded,
  //convert HTML into a basic plain-text alternative body
  //$mail->msgHTML(file_get_contents('contents.php'), dirname(__FILE__));
  $mail->msgHTML($body, dirname(__FILE__));

  //Replace the plain text body with one created manually
  //$mail->AltBody = 'This is a plain-text message body';

  //Attach an image file
  //$mail->addAttachment('images/phpmailer_mini.png');

  //send the message, check for errors
  if (!$mail->send()) {
    $mailer_msg['mailerror']="Mailer Error: " . $mail->ErrorInfo;
  } else {
    $mailer_msg['success']="Message sent!";
  }
  return $mailer_msg;
}
