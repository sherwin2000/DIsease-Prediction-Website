<?php
include('database_connection.php');
$update_status;
$query = "SELECT * FROM symptom";
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$filtered_rows = $statement->rowCount();
$a=array();
if($filtered_rows>0)
{
  foreach($result as $row)
  {
    $a[]=$row['status'];
  }
}
else
{} 
$query = "UPDATE `symptom` SET `status`='0'";
$statement = $conn->prepare($query);
$statement->execute();
$data=implode(",",array_values($a));
$output=shell_exec("python index.py "  .$data);
$_SESSION['diseases_predicted']=$output;
echo $output;


?>