<?php
$date=date(" H:i:s d/m/Y");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Visitor Notification</title>
</head>
<body>
<p>Hello <?php echo $args['visitee_name'] ?>,<br><br>You have a visitor on campus.<br>Here are the details:<br></p>
<ul>
  <li>Name: <strong><?php echo $args['visitor_name']; ?></strong></li>
  <li>Reason for Visit:<strong><?php echo $args['visit_reason']; ?></strong></li>
  <li>Date and Time: <strong><?php echo $date; ?></strong></li>
</ul>
<p><br>Regards,<br>
Visitor Management System</p><br>
--
<br>
<small>This is an automatically generated mail. Please do not reply to it. Please direct queries to it-helpdesk@bennett.edu.in</small>
</body>
</html>
