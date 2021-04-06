<?php
include('database_connection.php');
$query = "SELECT distinct(body_part) FROM symptom";
$statement = $conn->prepare($query);
$statement->execute();
$data = array();
$filtered_rows = $statement->rowCount();
if($filtered_rows>0)
{
  $result=array();
  while( $row = $statement->fetch(PDO::FETCH_ASSOC) ) {
    $result[] = $row;
  }
  echo json_encode($result);
}
else
{
  echo 'no records found';
}
?>