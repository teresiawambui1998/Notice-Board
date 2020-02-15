<?php
session_start();
include("includes/connection.php");
if(isset($_POST['login'])){

$email = mysqli_real_escape_string($con,$_POST['email']);
$pass =mysqli_real_escape_string($con,$_POST['pass']);
$get_user="select * from users where user_email='$email' and active='no'";
$run_user=mysqli_query($con,$get_user);
$check=mysqli_num_rows($run_user);
if($check==1)
{
$insert = "insert into login_attempts(email,password) values
 ('$email','$pass')";
$run_insert=mysqli_query($con,$insert); 
echo"<script>alert('Your account has been deactivited please call the admin 0791008761!')</script>";
exit();
}
$get_user="select * from users where user_email='$email' and user_pass ='$pass' and active='yes'";
$run_user=mysqli_query($con,$get_user);
$check=mysqli_num_rows($run_user);
if($check==1)
{
$insert = "insert into success_logins(email,password) values
 ('$email','$pass')";
$run_insert=mysqli_query($con,$insert); 
$_SESSION['user_email']=$email;

echo"<script>alert('You have successfully loged inn !')</script>";
echo"<script>window.open('home.php','_self')</script>";
}
else
{
echo"<script>alert('username or password incorect!')</script>";
}
}

?>