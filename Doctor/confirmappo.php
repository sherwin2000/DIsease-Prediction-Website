<?php
include('database_connection.php');
$id=$_POST['appo_id'];
$date=$_POST['date'];
$time=$_POST['time'];
$date = date("y-m-d", strtotime($date));
  $query = "UPDATE `appointment` SET `date`='$date',`time`='$time' where `appointment_id`='$id'";
  $statement = $conn->prepare($query);
  $statement->execute();
  $row = $statement->fetchAll();
  if($statement)
  {
    $output=array(
      'success'  => true
  );
  echo json_encode($output);
  }
?>