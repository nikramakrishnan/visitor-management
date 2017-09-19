<?php
$date=date("H:i");
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
  <?php if(!empty($args['visitor_org'])){
  echo "  <li>Organization: <strong>".$args['visitor_org']."</strong></li>";
  } ?>
  <li>Mobile No: <strong><?php echo $args['visitor_mobile']; ?></strong></li>
  <li>Reason for Visit: <strong><?php echo $args['visit_reason']; ?></strong></li>
  <li>Arrival Time: <strong><?php echo $date; ?></strong></li>
</ul>
<p>If you are not available on campus, please call up the visitor, or the campus main gate security at <strong>+91-120-719-9389</strong>.</p>

<p><br>Regards,<br>
Visitor Management System</p><br>
--
<br>
<small>This is an automatically generated mail. Please do not reply to it. Please direct queries to it-helpdesk@bennett.edu.in</small>
</body>
</html>
