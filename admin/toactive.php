<?php
include('database_connection.php');
$id=$_GET['id'];
$query = "UPDATE `doctor` SET `status`=1 where `doctor_id`='$id'";
$statement = $conn->prepare($query);
$statement->execute();
$row = $statement->fetchAll();
if($statement)
{
  $_SESSION['SUCCESS']="Activated Successfully";
  header('Location:doctor.php');
}
else
{
  $_SESSION['ERROR']="Activation Failed";
  header('Location:doctor.php');
}
?>