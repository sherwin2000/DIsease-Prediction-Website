<?php
include('database_connection.php');
$query = "SELECT * FROM symptom where body_part='{$_POST['body_part']}'";
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$output = '<div class="row text-center">';
$filtered_rows = $statement->rowCount();
if($filtered_rows>0)
{
  foreach($result as $row)
  {
    $id=$row['symptom_id'];
    $output.= "<a href='changestatus.php?id=$id' id='symptom123' class='btn btn-success col-md-3 symptom'>{$row["symptom_name"]}</a>";
  }
  $output.='</div>';
  echo $output;
}
else
{
  echo 'no records found';
}
?>