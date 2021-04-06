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
   $error=0;
   if(empty($_POST['name']))
   {
    $error_user_name='Name field should not be empty';
    $error++;
   }
   else
   {
     $name=$_POST['name'];
     if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $error_user_name = "Don't Use Special Characters or Numbers";
      $error++;
    }
   }

   if(empty($_POST['email']))
   {
    $error_user_email='Email field should not be empty';
    $error++;
   }
   else
   {
     $email=$_POST['email'];
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_user_email="Invalid email format";
      $error++;
    }
    else
    {
      $query ="SELECT * FROM patient WHERE patient_email='".$email."'";
      $result = mysqli_query($conn, $query);
      $count = mysqli_num_rows($result);
      if($count>0)
      {
        $error_user_email='Email Already Exists';
        $error++;
      }
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
     $len=strlen($password);
     if($len<8)
     {
        $error_user_password='Password Must Contain At least 8 Characters';
        $error++;
     }
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
     else
     {
      $len=strlen($_POST['confirmpassword']);
      if($len<8)
      {
         $error_user_confirm_password='Password Must Contain At least 8 Characters';
         $error++;
      }
     }
   }
   if($error==0)
   {
    $img=$_FILES['image']['name'];
    $img_temp=$_FILES['image']['tmp_name'];
    $img_folder="images/profilephoto/{$img}";
    move_uploaded_file($img_temp,$img_folder);
    $query ="INSERT INTO patient (`patient_id`,`patient_name`,`patient_email`,`patient_password`,`patient_photo`) VALUES ('','$name','$email','$password','$img_folder')";
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