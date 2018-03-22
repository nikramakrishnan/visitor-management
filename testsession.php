<?php
session_start();
echo 'Session ID-'.session_id()."<br>";
echo 'Session User-'.$_SESSION['username']."<br>";
$tohash = session_id().$_SESSION['username'].time();
echo 'Session ID to hash -'.$tohash."<br>";
echo hash("sha1",$tohash);
echo "<br>";

//Generate a random string.
$token = bin2hex(random_bytes(20));
//Print it out for example purposes.
echo $token.'<br>';
echo hash('sha1',$token)."<br>";
echo hash('sha1',"64225c88726695296590a1abee60fdcfacd0d105")
?>
