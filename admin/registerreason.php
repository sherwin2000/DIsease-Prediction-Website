<?php
   include('database_connection.php');
   $reason='';
   $id=$_POST['id'];
   $tablename=$_POST['tablename'];
   $error_reason='';
   $error=0;
   if(empty($_POST['reason']))
   {
    $error_reason='Reason field should not be empty';
    $error++;
   }
   else
   {
     $reason=$_POST['reason'];
   }
   $tableid=$tablename.'_id';
   if($error==0)
   {
    echo $query ="UPDATE `$tablename` SET `status`='$reason' where `$tableid`='$id'";
    $statement = $conn->prepare($query);
    $statement->execute();
    if($statement)
    {
    }
   }
   if($error>0)
   {
      $output=array(
         'error'       => true,
         'error_reason'=>$error_reason
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