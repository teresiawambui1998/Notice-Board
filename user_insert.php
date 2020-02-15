<?PHP
include("includes/connection.php");
if(isset($_POST['sign_up']))
{

$fname = mysqli_real_escape_string($con,$_POST['f_name']);
$lname = mysqli_real_escape_string($con,$_POST['lname']);
$reg_no = mysqli_real_escape_string($con,$_POST['reg_no']);
$pass =mysqli_real_escape_string($con,$_POST['password']);
$pa =mysqli_real_escape_string($con,$_POST['confirm_pass']);
$email = mysqli_real_escape_string ($con,$_POST['email']);
$country = mysqli_real_escape_string ($con,$_POST['u_country']);
$gender =mysqli_real_escape_string($con,$_POST['gender']);
$b_day = mysqli_real_escape_string($con, $_POST['u_birthday']);
$name =mysqli_real_escape_string($con, $_POST['f_name']);
$status = "unverified";
$posts = "No";
$active="Yes";
if($pass!=$pa)
{
$insert = "insert into   signup_attempts(user_name,email,password) values
 ('$f_name','$email','$pass')";
$run_insert=mysqli_query($con,$insert); 
echo"<script> alert('Password mismutch!')</script>";
exit();
}
$get_email="select * from users where user_email='$email'";
$run_email=mysqli_query($con,$get_email);
$check=mysqli_num_rows($run_email);
if($check==1)
{
$insert = "insert into   signup_attempts(user_name,email,password) values
 ('$f_name','$email','$pass')";
$run_insert=mysqli_query($con,$insert);  
echo"<script> alert('email exist try another please!')</script>";
exit();
} 
$get_email="select * from users where reg_no='$reg_no'";
$run_email=mysqli_query($con,$get_email);
$check=mysqli_num_rows($run_email);
if($check==1)
{
$insert = "insert into   signup_attempts(user_name,email,password) values
 ('$name','$email','$pass')";
$run_insert=mysqli_query($con,$insert); 
echo"<script> alert('reg_no exist  please try again!')</script>";
exit();
}
if(strlen($pass)<8)

{
$insert = "insert into   signup_attempts(user_name,email,password) values
('$name','$email','$pass')";
$run_insert=mysqli_query($con,$insert); 
echo"<script>alert('Password should be a minimum  of 8 characters!')</script>";
exit();
}

else{

$insert = "insert into  users (f_name,lname,reg_no,user_pass,user_email,user_county,user_gender,
user_b_day,user_image,register_date,last_login,status,active,posts) 
values('$fname','$lname','$reg_no','$pass','$email','$country','$gender',
'$b_day','default.jpg',NOW(),NOW(),'$status','$active','$posts')";
$run_insert=mysqli_query($con,$insert);  
if($run_insert)
{

echo"<script>alert('registration successful please enter your username and password and click the login button!')</script>";
echo"<script>window.open('index.php','_self')</script>";
}
}
}
?>