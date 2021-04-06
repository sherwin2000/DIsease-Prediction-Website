<?php
   include('database_connection.php');
   $name='';
   $mail='';
   $password='';
   $confirmpassword='';
   $photo='';
   $doctorspecialization='';
   $error_user_name='';
   $error_user_email='';
   $error_user_password='';
   $error_user_confirm_password='';
   $error_doctorspecialization='';
   $success_role='';
   $error=0;
   if(empty($_POST['name']))
   {
    $error_user_name='Name field should not be empty';
    $error++;
   }
   else
   {
     $name=$_POST['name'];
   }

   if(empty($_POST['email']))
   {
    $error_user_email='Email field should not be empty';
    $error++;
   }
   else
   {
     $email=$_POST['email'];
     $query ="SELECT * FROM doctor WHERE doctor_email='".$email."'";
     $statement = $conn->prepare($query);
     $statement->execute();
     $count= $statement->rowCount();
     if($count>0)
     {
      $error_user_email='Email Already Exists';
      $error++;
     }
   }

   if(empty($_POST['password']))
   {
    $error_user_password='Password field should not be empty';
    $error++;
   }
   else
   {
     $password=$_POST['password'];
   }

   if(empty($_POST['confirmpassword']))
   {
    $error_user_confirm_password='Password field should not be empty';
    $error++;
   }
   else
   {
     if($password!=$_POST['confirmpassword'])
     {
      $error_user_confirm_password='Password must be same';
      $error++;
     }
   }

   if(empty($_POST['doctorspecialization']))
   {
    $error_doctorspecialization='Specialization field should not be empty';
    $error++;
   }
   else
   {
     $doctorspecialization=$_POST['doctorspecialization'];
   }
   if($error==0)
   {
    $img=$_FILES['image']['name'];
    $img_temp=$_FILES['image']['tmp_name'];
    $img_folder="../images/profilephoto/{$img}";
    $img_folder1="images/profilephoto/{$img}";
    move_uploaded_file($img_temp,$img_folder);
    $query ="INSERT INTO doctor (`doctor_id`,`doctor_name`,`doctor_email`,`doctor_password`,`doctor_specialization`,`doctor_photo`) VALUES ('','$name','$email','$password','$doctorspecialization','$img_folder1')";
    $statement = $conn->prepare($query);
    $statement->execute();
    if($statement)
    {
    }
   }
   if($error>0)
   {
      $output=array(
         'error'                 => true,
         'error_user_name' => $error_user_name,
         'error_user_email' => $error_user_email,
         'error_user_password' => $error_user_password,
         'error_user_confirm_password'  => $error_user_confirm_password,
         'error_doctorspecialization'=>$error_doctorspecialization
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