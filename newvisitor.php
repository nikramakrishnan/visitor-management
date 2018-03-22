<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:index.php?next=newvisitor.php");
  die('Please login to continue.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Add Visitor</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <link href="//getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="res/css/narrow.css" rel="stylesheet">

</head>

<body>

  <div class="container">
    <div class="header clearfix">
      <nav>
        <ul class="nav nav-pills pull-right">
          <li role="presentation"><a href="home.php">Home</a></li>
          <li role="presentation" class="active"><a href="#">Add Visitor</a></li>
          <li role="presentation"><a href="curvisitors.php">Current Visitors</a></li>
          <li role="presentation"><a href="https://github.com/nikramakrishnan/visitor-management/wiki" target="_blank">Help</a></li>
        </ul>
      </nav>
      <h3 class="text-muted">Visitor Entry Demo</h3>
    </div>

    <form id="visitor" class="form-horizontal" action="v1/add/" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <p class="text-muted">Please note that optional fields such as address, organization and visitee are not included in this form.</p>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="cardno">Card Number:</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="cardno" placeholder="Card Number" name="cardno" autofocus required>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="name">Name:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="mobile">Mobile Number:</label>
        <div class="col-sm-10">
          <input type="tel" class="form-control" id="mobile" placeholder="Mobile Number" name="mobile">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="purpose">Purpose of Visit:</label>
        <div class="col-sm-10">
          <select class="form-control" name="purpose" id="purpose" required>
            <option selected disabled value="">Select one...</option>
            <option value="1">Reason 1</option>
            <option value="2">Reason 2</option>
            <option value="3">Reason 3</option>
            <option value="4">Reason 4</option>
            <option value="5">Reason 5</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="image">Upload Photo:</label>
        <div class="col-sm-10">
          <input type="file" class="form-control-file" name="image" id="image" aria-describedby="fileHelp" required>
          <small id="fileHelp" class="form-text text-muted">Upload a photo of the visitor (captured on camera in the app)</small>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="access_token">Access Token:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="access_token" placeholder="Access Token" name="access_token" required>
          <small id="access-token-help" class="form-text text-muted">Access token can be obtained from /v1/oauth/ endpoint. <a href="https://github.com/nikramakrishnan/visitor-management/wiki/API:-Generating-a-Token" target="_blank">Check documentation</a> for more information.</small>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
            <label><input type="checkbox" name="remember" aria-describedby="agree" required>I agree that the data above is correct</label>
          </div>
          <small id="agree" class="form-text text-muted">Furnising wrong information is liable to penalty/legal action</small>
        </div>
      </div>
      <!-- <input type="hidden" name="access_token" value="4d146d21a4b8eb0e921389f36719b95beb30ebc3"> -->
      <!-- <input type="hidden" name="debug" value="1"> --> <!-- Uncomment previous comment to enable debug mode -->
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Submit</button><br>
          <small id="submit-help" class="form-text text-muted">This will redirect to /v1/add/ where output will be shown in JSON. <a href="https://github.com/nikramakrishnan/visitor-management/wiki/API:-Adding-a-Visitor" target="_blank">Check documentation</a> for more information.</small></small>
        </div>
      </div>
    </form>

    <footer class="footer">
      <p>&copy; <?php echo date('Y'); ?> Company, Inc.</p>
    </footer>

  </div> <!-- /container -->
</body>
</html>
