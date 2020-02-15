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
$sel_msg="select * from messsages where receiver='$user_id' or sender='$user_id'";
$run_msg= mysqli_query($con,$sel_msg);
$count_msg = mysqli_num_rows($run_msg);
while($row_msg = mysqli_fetch_array($run_msg))
{
$msg_id=$row_msg['msg_id'];
$msg_receiver =$row_msg['receiver'];
$msg_sender=$row_msg['sender'];
$msg_sub=$row_msg['msg_sub'];
$msg_topic=$row_msg['msg_topic'];
$msg_date=$row_msg['msg_date'];
$get_sender="select * from users where user_id='$msg_sender'";
$run_sender=mysqli_query($con,$get_sender);
$row=mysqli_fetch_array($run_sender);
$user_id=$row['user_id'];
$sender_name=$row['user_name'];
$use_image=$row['user_image'];
// displaying all at once
echo"<div id='text'> 
<p><img src='user/user_images/$use_image' width='50' height='50'></p>
<h3> <a href='user_profile.php?user_id=$user_id'>$sender_name</a></h3>
<p>$msg_topic</p>


<a href='single_message.php?msg_id=$msg_id'style='float:right;'><button>Chats</button></a></div>";

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
