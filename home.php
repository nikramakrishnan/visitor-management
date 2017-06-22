<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:index.php");
  die('Please login to continue.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Visitor Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="jumbotron text-center">
    <h1>Visitor Management System</h1>
    <h3>Hello, <?php echo $_SESSION['username']; ?></h3>
    <a href="logout.php">Logout</a>
  </div>

  <div class = "container">
    <p><a class="btn btn-lg btn-success" href="newvisitor.php" role="button">Visitor Entry</a></p>
  </div>

</body>
