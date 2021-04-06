<?php
include('database_connection.php');
$id=$_POST['appo_id'];
$reason='';
$error=0;
if(empty($_POST['reason']))
{
  $error_reason='reason field should not be empty';
  $error++;
}
else
{
   $reason=$_POST['reason'];
}
if($error==0)
{
  $query = "UPDATE `appointment` SET `cancel`='$reason',`payment`='0',`approve`='0' where `appointment_id`='$id'";
  $statement = $conn->prepare($query);
  $statement->execute();
  $row = $statement->fetchAll();
  if($statement)
  {}
  else
  {
    $error++;
  }
}
if($error>0)
   {
      $output=array(
         'error'                 => true,
         'error_reason' => $error_reason
      );
   }
   else
   {
      $output=array(
        'success'  => true
    );
   }
   echo json_encode($output);
?>