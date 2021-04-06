<?php
   include('database_connection.php');
   $role=$_SESSION['role'];
   $user_email='';
   $user_password='';
   $error_user_email='';
   $error_user_password='';
   $error_status='';
   $error=0;
   if(empty($_POST['email']))
   {
    $error_user_email='Email field should not be empty';
    $error++;
   }
   else
   {
     $user_email=$_POST['email'];
   }

   if(empty($_POST['password']))
   {
    $error_user_password='Password field should not be empty';
    $error++;
   }
   else
   {
     $user_password=$_POST['password'];
   }
   if($error==0)
   {
    $email = $role . "_email";
    $password = $role . "_password";
    $userid = $role."_id";
    $query ="SELECT * FROM $role WHERE $email='".$user_email."'";
    $result = mysqli_query($conn, $query);
    if($result)
    {
      $count = mysqli_num_rows($result);
      if($count>0)
      {
        $row = mysqli_fetch_array($result); 
        if($row[$password]==$user_password)
        {
           if($_SESSION['role']=='doctor')
           {
            $_SESSION['demail']=$row[$email];
            $_SESSION['did']=$row[$userid];
           }
           else
           {
            $_SESSION['email']=$row[$email];
            $_SESSION['id']=$row[$userid];
           }
        }
        else
        {
           $error_user_password='Password is wrong!!!';
           $error++;
        }
      }
      else{
        $error_user_email='Email is wrong!!!';
        $error++;   
      }
    }
   }
   if($error>0)
   {
      $output=array(
         'error'                 => true,
         'error_user_email' => $error_user_email,
         'error_user_password'  => $error_user_password
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