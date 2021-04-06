<?php
  include('database_connection.php');
  $id=$_GET['id'];
  $query ="DELETE FROM `disease` where `disease_id`='$id'";
  $statement = $conn->prepare($query);
  $statement->execute();
  if(!$statement)
  {
    $_SESSION['ERROR']='Deletion Failed!!!!';
    header('Location:disease.php');
  }
  else{
    $_SESSION['SUCCESS']='Disease Deleted Successfully!!!!';
    header('Location:disease.php');
  }
?>