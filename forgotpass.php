<?php 
session_start();
error_reporting(0);
include("functions/functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Integrated Tertiary finance system </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/coin-slider.css" />

</head>
<body>
<div class="main">
<div id="header">

<img src="images/kevo.png"style="float:left; padding:5px;" height="100" width="100" />
<form id="form1" name="form1" method="post" action="">
<table align="right" width="100%">
  <tr><td><strong>Email: </strong><input type="email" name="email"  placeholder="Email" required="required"/></td>
 
  <td><strong>Password:</strong><input type="password" name="pass" placeholder="*****" required="required" /></td></tr>
  <tr><td><b>Login:   </b><button name="login" >Login</button></td></tr>
  </label>
  </table>
</form>
</div>
  <div class="header">
    <div class="header_resize">
      
      <div class="logo">
        <h1>Tertiary Finance </h1>
      </div>
      <div class="clr"></div>

<div id="form2">
<table align="right" ><tr><td><a href="index.php"><button>Sign Up</button></a></td></tr></table>
<form action="" method="Post">
<h2>Reset Password</h2>
<table >

  
  <tr>
         <td align="right">User_name:</td>
    <td><Input type="text" name="u_name" placeholder="Enter Your Password."required="required"  /></td>
     </tr>
   <tr>
    <td align="right">Email:</td>
    <td><Input type="email" name="u_email" placeholder="Enter Your Mail."required="required"  /></td>
    </tr>
  
  
  
  <tr>
    <td align="right" colspan="6">
	<button name="reset">Reset Password</button></td>
  </tr> </table>

</form>

<?php
if(isset($_POST['reset'])){
$name=$_POST['u_name'];
$email=$_POST['u_email'];
$get_name="select * from users where user_name='$f_name'";
$run_name=mysqli_query($con,$get_name);
$check=mysqli_num_rows($run_name);
if($check==1)
{
$row_user=mysqli_fetch_array($run_name);
$user_email=$row_user['user_email'];
$user_pass=$row_user['user_pass'];

} 
else
echo"<script> alert('user_name or email address incorect.')</script>";

//ensuring the email is correct
if($user_email!=$email)
{
echo"<script> alert('user_name or email address incorect.')</script>";

echo"<script>window.open('forgotpass.php','_self')</script>";
}
if($user_email==$email)
{

$get_newpass="select * from users where user_name='$name' and user_email='$email'";
$run_newpass=mysqli_query($con,$get_newpass);
$check=mysqli_num_rows($run_newpass);
if($check==1)
{
//creating email valiables
$webmaster="davimwangi96@gmail.com";
$headers="From:mwangisolutions<$webmaster>";
$subject="Your NEW password";
$message="Hello.your password was been reset.your new password is bellow.\n";
$message.="password:$user_pass\n";

if(mail($email,$subject,$message,$headers)){
echo"<script> alert('Your password was send to your email ......please check your mail.')</script>";
}
else
echo"<script> alert('An error has occoured and your password was not send to your email address.')</script>";
echo"<script>window.open('forgotpass.php','_self')</script>";

}

} }
?>
</div>

  </div>



  <div class="content">
  <img src="images/join.png"height="400"width="500" style="float:left;margin-left:-40px;">
    <div class="content_resize">
      <h3> The System faccilitates  Fee payment.</h3>
      
        
      </div>
      
      
    </div>
  </div>
  
      
      
      <div class="clr"></div>
    </div>
  </div>
  <div class="footer1">
  <div class="footer">
    <div class="footer_resize">
      <p class="lf">Copyright &copy; <a href="#">David Mwangi</a>. All Rights Reserved</p>
      <p class="rf">Design by <a target="_blank" href="http://www.David001.gifsuccess.com/">Administrator</a></p>
      <div style="clear:both;"></div>
    </div>
  </div>
</div>
<?php 
include("user_insert.php");?>
</body>
</html>
<?php
include("login.php");
?>
