<?php
session_start();
if(isset($_SESSION['username'])){
  header('Location: home.php');
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
    <p>Login Page</p>
  </div>
  <div class="container">
    <h2>Login</h2>
  <form class="form-horizontal" id="login" action="auth.php" method="POST"> <!-- Change action to "v1/oauth/" to get JSON Response with token -->
    <div class="form-group">
      <label class="control-label col-sm-2" for="username">Username:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php if(isset($_SESSION['errorusr'])) echo $_SESSION['errorusr']; ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="password">Password:</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
      </div>
    </div>
    <!-- <input type="hidden" name="debug" value="1"> --> <!-- Uncomment previous comment to enable debug mode when form action="v1/oauth/" -->
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
	<?php if(isset($_SESSION['errMsg'])) { echo '
	<div class="form-group">
		<div class="alert alert-danger">
			<strong>Alert!</strong> '.$_SESSION['errMsg'].'
		</div>
	</div>
	';session_destroy();}?>
	<?php if(isset($_GET['logout'])) {
	if($_GET['logout']==true){
	echo '
	<div class="form-group">
		<div class="alert alert-success">
			<strong>Success!</strong> You have successfully logged out.
		</div>
	</div>
	';}}?>
  </form>
</div>

</body>
</html>
