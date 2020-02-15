<?php 
session_start();
include("includes/connection.php");
include("functions/functions.php");
if(!isset($_SESSION['user_email']))
{ 
header("location:index.php");

}
else{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Integrated Tertiary finance system</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/coin-slider.css" />
</head>
<body>
<div class="main">

  <div class="header">
    <div class="header_resize">
	<div class="menu_nav">
        <ul>
        <li class="active"><a href="home.php"><span>Home Page</span></a></li> <li><a href="members.php"><span>Members</span></a></li><li><a href="county_bursary.php"><span>County Bursary</span></a></li>
		  <li><a href="report.php"><span>Report</span></a></li>
		  <li><a href="pesapay.php"><span>Pesa Pay</span></a></li>
		  <li><a href="tf_card.php"><span><strong>Pay with Tokens</strong></span></a></li>
		   <li><a href="transcript.php"><span>Fee Statement</span></a></li>
		     <li><a href="logout.php"><span><strong>Logout</strong></span></a></li>
		
         </ul>
      </div>
      
      <div class="logo">
        <img src="images/kevo.png"style="float:left; padding:5px;" height="117" width="117" />
      </div>
      <div class="clr"></div>
	  


  </div>



  <div class="content">
  <div id="user_timeline">
 <div id="user_details">


<?php
$user = $_SESSION['user_email'];
$get_user="select * from users where user_email='$user'";
$run_user=mysqli_query($con,$get_user);
$row=mysqli_fetch_array($run_user);
$user_id=$row['user_id'];
$f_name=$row['f_name'];
$lname=$row['lname'];
$user_email=$row['user_email'];
$user_gender=$row['user_gender'];
$user_pass=$row['user_pass'];
$user_county=$row['user_county'];
$user_image=$row['user_image'];
$register_date=$row['register_date'];
$last_login=$row['last_login'];
$user_posts="select*from posts where user_id='$user_id'";
$run_posts=mysqli_query($con,$user_posts);
$posts=mysqli_num_rows($run_posts);
$user_ms="select*from messsages where receiver='$user_id'";
$run_ms=mysqli_query($con,$user_ms);
$sms=mysqli_num_rows($run_ms);
echo"<center><img src='user/user_images/$user_image 'width='200' height='200' /></center>

<p><strong> First Name:</strong> $f_name.<p/>
<p><strong>Last Name:</strong> $lname.<p/>
<p><strong>County:</strong> $user_county.<p/>
<p><strong>Last login:</strong> $last_login.<p/>
<p><strong>Member Since:</strong> $register_date.<p/>
<div id='user_mention'>
<p><a href='my_messages.php?u_id=$user_id'><strong><img src='images/messages.png 'width='30'height='30'/><font color='red'>($sms)</font></strong></a><p/>
<p><a href='my_posts.php?u_id=$user_id'><strong>My posts($posts)</strong></a><p/>
<p><a href='edit_profile.php?u_id=$user_id'><strong>Settings</a><p/>
<p><a href='logout.php'><strong>Logout</strong></a><p/>
</div>";

?>

</div>
</div>
    <div class="content_resize">
	<div id="content_timeline">
	
<form action="" method="Post" id="f" class="ff" enctype="multipart/form-data">

<table align="center" >
<tr><td colspan="6" align="center"> <h2>Edit your Profile: </h2></td></tr>
  <tr>
    <td align="right"> First Name:</td>
    <td><Input type="text" name="u_name"required="required" value="<?php echo $f_name ?>" /></td>
    
  </tr>
  <tr>
    <td align="right">Last Name:</td>
    <td><Input type="text" name="lname"required="required" value="<?php echo $lname ?>" /></td>
    
  </tr>
  <tr>
         <td align="right">Password:</td>
    <td><Input type="text" name="u_pass" required="required" value="<?php echo $user_pass ?>"/></td>
     </tr>
   <tr>
    <td align="right">Email:</td>
    <td><Input type="email" name="u_email" value="<?php echo $user_email ?>" required="required"  /></td>
    </tr>
   <tr>
    <td align="right" > </td>
    <td><select name="u_country" disabled="disabled" >
	<option>
<?php echo $user_county?>

	</option>
	<option> Kenya </option>
	<option> Burundi</option>
	<option> Ethiopia </option>
	<option>Uganda </option>
	<option>Rwanda </option>
	</select>
	</td>
   </tr>
   <tr>
    <td align="right">Gender:</td>
    <td><select name="u_gender"  disabled="disabled"  >
	<option>
	<?php echo $user_gender ?>
	</option>
	<option>Male </option>
	<option>Female</option>
	</select>
	</td>
   </tr>
   <tr>
    <td align="right">Photo:</td>
    <td><Input type="file" name="u_image" value="<?php echo $user_image?>" required="required" /></td>
    </tr>
  <tr>
 
  <tr>
    <td align="center" colspan="6" >
	<input type="submit" name="update" value="Update"></td>
  </tr> </table>

</form>
<?php 
if(isset($_POST['update']))
{
$f_name=$_POST['u_name'];
$lname=$_POST['lname'];
$u_pass=$_POST['u_pass'];
$u_email=$_POST['u_email'];
$u_image=$_FILES['u_image']['name'];
$image_tmp=$_FILES['u_image']['tmp_name'];
move_uploaded_file($image_tmp,"user/user_images/$u_image");
$update="update users set f_name='$f_name',lname='$lname',user_pass='$u_pass',user_email='$u_email',user_image='$u_image' where user_id='$user_id'";
$run=mysqli_query($con,$update);
if($run)
{
echo"<script> alert('your profile updated !')</script>";
echo"<script> window.open('home.php','_self')</script>";
}
}







?>


</div>
      
        
      </div>
      
      
    </div>
  </div>
  
      
      
      <div class="clr">
	  </div>
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
</body>
</html>
<?php } ?>
