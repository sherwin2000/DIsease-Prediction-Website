<?php
include('database_connection.php');
$doctor_id=$_POST['doctor_id'];
$patientid=$_SESSION['did'];
$query = "SELECT * FROM patient WHERE `patient_id`='$patientid'";
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
$patient_name=$row['patient_name'];
}

$query = "SELECT * FROM doctor WHERE `doctor_id`='$doctor_id'";
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
$doctor_name=$row['doctor_name'];
}
$dieasesname='';
$error=0;
if(empty($_POST['dieasesname']))
{
  $error_dieases_name='reason field should not be empty';
  $error++;
}
else
{
   $dieasesname=$_POST['dieasesname'];
}
if($error==0)
{
  $date='0000-00-00';
  $time='00:00:00';
  $query = "INSERT INTO appointment (`appointment_id`,`appointment_name`,`associated_doctor`,`associated_dieases`,`date`,`time`,`patient_id`,`doctor_id`) 
  VALUES ('','$patient_name','$doctor_name','$dieasesname','$date','$time','$patientid','$doctor_id')";
  $statement = $conn->prepare($query);
  $statement->execute();
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