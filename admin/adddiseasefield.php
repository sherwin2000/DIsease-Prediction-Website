<?php
   include('database_connection.php');
   $name='';
   $symptoms='';
   $remedies='';
   $error_name='';
   $error_symptoms='';
   $error_remedies='';
   $error=0;

   if(empty($_POST['name']))
   {
    $error_name='Name field should not be empty';
    $error++;
   }
   else
   {
     $name=$_POST['name'];
     $query ="SELECT * FROM disease WHERE disease_name='".$name."'";
     $statement = $conn->prepare($query);
     $statement->execute();
     $count = $statement->rowCount();
     if($count>0)
     {
      $error_name='Disease Already Exists';
      $error++;
     }
   }

   if(empty($_POST['symptoms']))
   {
    $error_symptoms='Symptoms field should not be empty';
    $error++;
   }
   else
   {
     $symptoms=$_POST['symptoms'];
   }

   if(empty($_POST['remedies']))
   {
    $error_remedies='Remedies field should not be empty';
    $error++;
   }
   else
   {
     $remedies=$_POST['remedies'];
   }
   if($error==0)
   {
    $query ="INSERT INTO disease (`disease_id`,`disease_name`,`disease_symptoms`,`disease_remedies`) VALUES ('','$name','$symptoms','$remedies')";
    $statement = $conn->prepare($query);
    $statement->execute();
    if($statement)
    {
    }
   }
   if($error>0)
   {
      $output=array(
         'error'           => true,
         'error_name' => $error_name,
         'error_symptoms' => $error_symptoms,
         'error_remedies' => $error_remedies
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