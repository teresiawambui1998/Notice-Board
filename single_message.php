<?php 
error_reporting(0);
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
		  <li><a href="report.php"><span>Report</span></a></li>
		  <li><a href="pesapay.php"><span>Pesa Pay</span></a></li>
		  <li><a href="tf_card.php"><span>Tertiary Finance Card(TF_CARD)</span></a></li>
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
$user_name=$row['user_name'];
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

<p><strong>Name:</strong> $user_name.<p/>
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
	

<?php
if(isset($_GET['msg_id'])){
global $con; 

$get_id=$_GET['msg_id'];
$get_posts="select * from messsages where msg_id='$get_id'";
$run_posts=mysqli_query($con,$get_posts);
$row_posts=mysqli_fetch_array($run_posts);
$msg_id=$row_posts['msg_id'];
$sender=$row_posts['sender'];
$msg_sub=$row_posts['msg_sub'];
$msg_topic=$row_posts['msg_topic'];
$msg_date=$row_posts['msg_date'];
//getting the user who has posted 
$user="select * from users where user_id='$sender'";
$run_user =mysqli_query($con,$user);
$row_user=mysqli_fetch_array($run_user);
$f_name=$row_user['f_name'];
$lname=$row_user['lname'];
$user_image=$row_user['user_image'];
//getting the user session
$user_com = $_SESSION['user_email'];
$get_com="select * from users where user_email='$user_com'";
$run_com=mysqli_query($con,$get_com);
$row_com=mysqli_fetch_array($run_com);
$user_com_id = $row_com['user_id'];
$user_com_name = $row_com['user_name'];
// displaying all at once
echo"<div id='posts'> 
<p><img src='user/user_images/$user_image' width='50' height='50'></p>
<h3> <a href='user_profile.php?user_id=$user_id'>$f_name $lname</a></h3>
<h3>$msg_sub</h3>
<p>$msg_date</p>
<p>$msg_topic</p>
</div>";
include("messages_reply.php");
echo"

<form action='' method='post' id='reply'>
<textarea cols='50' rows='5'name='comment' placeholder='Write Your Reply'></textarea>
<input type='submit' name='reply'value='Reply'/>
</form>";
if(isset($_POST['reply']))
{
$comment=$_POST['comment'];
$insert="insert into messsage_reply 
(msg_id,reply,user_id,sender_name)
values ('$msg_id','$comment','$sender','$user_com_name')";
$run_insert=mysqli_query($con,$insert);
echo"<h2>Your Reply Was Posted</h2>";
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
