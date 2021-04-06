<?php
include('database_connection.php');
$id=$_GET['id'];
$update_status;
$query = "SELECT * FROM symptom where `symptom_id`='$id'";
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$filtered_rows = $statement->rowCount();
if($filtered_rows>0)
{
  foreach($result as $row)
  {
    if($row['status']=='0')
    {
       $update_status='1';
    }
    else
    {
      $update_status='0';
    }
  }
}
$query = "UPDATE `symptom` SET `status`='$update_status' where `symptom_id`='$id'";
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