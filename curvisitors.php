<?php
include('res/css/tabstyle.css');

$errors= array(); //Initialize array to store errors

//Connect to the Database
require 'res/scripts/connect.php';

//Run query and get result from SQL server
$result= mysqli_query($conn,"SELECT card_no,name,entry_time,mobile,purpose FROM visitors WHERE in_campus=1 ORDER BY entry_time ASC;");
$column_names = array();  //Initialize array for saving property

//If no result found
if(mysqli_num_rows($result)==0){
  $errors['no_data']="No data was received from database".mysqli_error($conn);
  kill($errors);
}

//Set scroll bar if there are too many columns
echo "\n<div style=\"overflow-x:auto;\">\n";

//Initialize table and hedding row
echo "<table>\n\t<tr>\n";
while ($column = mysqli_fetch_field($result)) {
    echo "\t\t<th>" . $column->name . "</th>\n";  //Get column name
    array_push($column_names, $column->name);  //Save column name to array
}
echo "\t</tr>\n";

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
//Close table
echo "</table>\n";
echo "</div>\n";

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
