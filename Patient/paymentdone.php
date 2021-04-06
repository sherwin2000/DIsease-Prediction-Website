<?php
include('database_connection.php');
$id=$_COOKIE['appo_id'];
$_SESSION['id']=$_COOKIE['id'];
$_SESSION['email']=$_COOKIE['email'];
  $query = "UPDATE `appointment` SET `payment`='0' where `appointment_id`='$id'";
  $statement = $conn->prepare($query);
  $statement->execute();
  $row = $statement->fetchAll();
  if($statement)
  {
    header('location:./appointment.php');
  }
?>