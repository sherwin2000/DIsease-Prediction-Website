<?php
   include('database_connection.php');
   $name='';
   $mail='';
   $password='';
   $confirmpassword='';
   $photo='';
   $error_user_name='';
   $error_user_email='';
   $error_user_password='';
   $error_user_confirm_password='';
   $success_role='';

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
     $result = mysqli_query($conn, $query);
     $count = mysqli_num_rows($result);
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
   if($error==0)
   {
    $img=$_FILES['image']['name'];
    $img_temp=$_FILES['image']['tmp_name'];
    $img_folder="images/profilephoto/{$img}";
    move_uploaded_file($img_temp,$img_folder);
    $query ="INSERT INTO doctor (`doctor_id`,`doctor_name`,`doctor_email`,`doctor_password`,`doctor_photo`) VALUES ('','$name','$email','$password','$img_folder')";
    $result = mysqli_query($conn, $query);
    if($result)
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
         'error_user_confirm_password'  => $error_user_confirm_password
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