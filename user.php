<?php
  $host="localhost";
  $username="root";
  $pass="";
  $db="teproject";
  $conn=mysqli_connect($host,$username,$pass,$db);
  if(!$conn){
    die("Database connection error");
  }
  if($_REQUEST['email']!="")
  {
     $name=$_POST['name'];
     $age=$_POST['age'];
     $gender=$_POST['gender'];
     $email=$_POST['email'];
     $number=$_POST['number'];
     $address=$_POST['address'];
     $code=$_POST['code'];

     echo $query="INSERT INTO user (`name`,`age`,`gender`,`email`,`number`,`address`,`code`)
            VALUES ('$name','$age','$gender','$email','$number','$address','$code')";
     echo $result=mysqli_query($conn,$query);
     if(!$result)
     {
       echo "no";
     }
     else
     {
       echo "yes";
     }
  }
  else
  {
    echo "not";
  }
?>