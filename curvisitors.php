<?php
include('res/css/tabstyle.css');

$errors= array(); //Initialize array to store errors

//Connect to the Database
require 'res/scripts/connect.php';

//Run query and get result from SQL server
$result= mysqli_query($conn,"SELECT visitor_no,card_no,name,mobile,purpose FROM visitors WHERE in_campus=1;");
$column_names = array();  //Initialize array for saving property

//If no result found
if(mysqli_num_rows($result)==0){
  $errors['no_data']="No data was received from database".mysqli_error($conn);
  kill($errors);
}

//Set scroll bar if there are too many columns
echo "<div style=\"overflow-x:auto;\">";

//Initialize table and hedding row
echo '<table> <tr>';
while ($column = mysqli_fetch_field($result)) {
    echo '<th>' . $column->name . '</th>';  //Get column name
    array_push($column_names, $column->name);  //Save column name to array
}
echo '</tr>';

//Printing data
while ($row = mysqli_fetch_array($result)) {

    echo "<tr>";
    foreach ($column_names as $col) {
        echo '<td>' . $row[$col] . '</td>'; //print rows
    }
    echo '</tr>';
}
//Close table
echo "</table>";
echo "</div>";

//close Mysql connection
mysqli_close($conn);

//This will stop excecution immediately and show corresponding error(s)
function kill($errors){
  header('Content-Type: application/json');
  $json=array();
  $json['success']=false;
  $json['errors']=$errors;
  echo json_encode($json);
  die(1);
}

?>