<?php
include('database_connection.php');
$query = "UPDATE `symptom` SET `status`='0'";
$statement = $conn->prepare($query);
$statement->execute();
$row = $statement->fetchAll();
$filtered_rows = $statement->rowCount();
if($filtered_rows>0)
{
  echo 'success';
  header('location:home.php');
}
?>