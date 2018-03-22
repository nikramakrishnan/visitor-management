<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:index.php?next=curvisitors.php");
  die('Please login to continue.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Current Visitors - VMS</title>
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
    <h1>Current Visitors</h1>
    <a href="home.php">Home Page</a> |
    <a href="newvisitor.php">Visitor Entry</a>
  </div>
  <div class="container">
    <table class="table table-striped">
      <thead><tr>
        <?php

        $errors= array(); //Initialize array to store errors

        //Connect to the Database
        require_once 'res/scripts/connect.php';

        //Run query and get result from SQL server
        $query_text = "SELECT card_no,name,entry_time,mobile,purpose,visitee_no FROM visitors WHERE in_campus=1 ORDER BY entry_time ASC;";
        if(!($result= mysqli_query($conn,$query_text))){
          $error['server']="Server encountered an error. Please try again later";
          kill($errors);
        }
        $column_names = array();  //Initialize array for saving property

        //Initialize table and hedding row
        while ($column = mysqli_fetch_field($result)) {
          echo "\t\t<th>" . $column->name . "</th>\n";  //Get column name
          array_push($column_names, $column->name);  //Save column name to array
        }
        echo "\t</tr></thead>\n<tbody>\n";
        //End of table header

        //If no result found
        if(mysqli_num_rows($result)==0){
          $errors['no_data']="No data was received from database";
          kill($errors);
        }
        //If no error, echo the css
        //include('res/css/tabstyle.css');

        //Printing data
        while ($row = mysqli_fetch_array($result)) {

          echo "\t<tr>\n";
          foreach ($column_names as $col) {
            if($col=="entry_time"){
              $datetime= date_create_from_format("Y-m-d H:i:s",$row[$col]);
              $datefn = date_format($datetime,"H:i:s");
              $row[$col]=$datefn;
            }
            echo "\t\t<td>" . $row[$col] . "</td>\n"; //print rows
          }
          echo "\t</tr>\n";
        }


        //close Mysql connection
        mysqli_close($conn);

        //This will stop excecution immediately and show corresponding error(s)
        function kill($errors){
          foreach ($errors as $name => $text) {
            echo "<tr><td colspan=\"6\"><center>Error: ".$name." (".$text.")</center></td></tr>";

          }
          echo "\t\t\t</tbody></table>\n\t\t</div>\n\t</div> <!-- /container -->\n</body>\n</html>";
          die();
        }

        ?>
      </tbody></table>
    </div>
  </div> <!-- /container -->
</body>
</html>
