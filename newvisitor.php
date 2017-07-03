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
          <li role="presentation" class="active"><a href="home.php">Home</a></li>
          <li role="presentation"><a href="#">About</a></li>
          <li role="presentation"><a href="#">Help</a></li>
        </ul>
      </nav>
      <h3 class="text-muted">VMS</h3>
    </div>

    <form id="visitor" class="form-horizontal" action="v1/add/" method="post" enctype="multipart/form-data">
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
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
            <label><input type="checkbox" name="remember" aria-describedby="agree" required>I agree that the data above is correct</label>
          </div>
          <small id="agree" class="form-text text-muted">Furnising wrong information is liable to penalty/legal action</small>
        </div>
      </div>
      <input type="hidden" name="token" value="aa77d525346a69468925fcfe5d18778340c89447">
      <!-- <input type="hidden" name="debug" value="1"> --> <!-- Uncomment previous comment to enable debug mode when form action="authcred.php" -->
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Submit</button>
        </div>
      </div>
    </form>

    <footer class="footer">
      <p>&copy; <?php echo date('Y'); ?> Company, Inc.</p>
    </footer>

  </div> <!-- /container -->
</body>
</html>
