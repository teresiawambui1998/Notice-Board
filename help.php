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
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
</head>
<body>
<div class="main">

  <div class="header">
    <div class="header_resize">
	<div class="menu_nav">
        <ul>
          <li class="active"><a href="help.php"><span>HELP</span></a></li> <li><a href="members.php"><span>Members</span></a></li><li><a href="county_bursary.php"><span>County Bursary</span></a></li>
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

<p><strong>Name:</strong> $f_name  $lname.<p/>
<p><strong>County:</strong> $user_county.<p/>
<p><strong>Last login:</strong> $last_login.<p/>
<p><strong>Member Since:</strong> $register_date.<p/>
<div id='user_mention'>
<p><a href='my_messages.php?u_id=$user_id'><strong><img src='images/messages.png 'width='30'height='30'/><font color='red'>($sms)</font></strong></a><p/>
<p><a href='my_posts.php?u_id=$user_id'><strong>My posts($posts)</strong></a><p/>
<p><a href='edit_profile.php?u_id=$user_id'><strong>Settings</a><p/>
</div>";

?>

</div>
</div>
    <div class="content_resize">
	<div id="content_timeline">

<form action="home.php?id=<?php echo $user_id;?>"method="post" id="f">
<fieldset ><legend align="center">HELP</legend>
<p><ul><ol>
  
    <li><strong>(1) AFTER LOGIN CLICK ON REPORT TAB TO  REPORT FOR THE SEMESTER FIRST </li><BR />
    <li>(2) AFTER REPORTING CLICK ON PAY WITH TOKENS TO INPUT THE TOKEN CODE THEN CLICK ON PAY BUTTON.</li><BR />
    <li>(3) AFTER PAYMENT HAS BEEN MADE SUCCESSFULLY CLICK ON FEE STATEMENT TAB TO VIEW AND PRINT YOUR FEES STATEMENT </li><BR />
    <li>(4) INCASE OF OTHER ASSISTANCE PLEASE LET US KNOW  BY POSTING IT IN THE DISCUSSION FORUM </li><BR />
    <li>(5) YOU CAN ALSO APPLY FOR BURSARY BY CLICKING ON THE BARSARY TAB AND INPUT YOUR DETAILS  </li><BR />
    <li>(6) TO UPDATE YOUR PROFILE YOU CAN CLICK ON SETTINGS LOCATED ON THE BOTTOM LEFT CORNE AND EDIT YOUR DETAILS EASILY.</li><BR />
    <li>(7) YOU CAN ALSO PAY WITH OTHER MEANS OF PAYMENTS EG PESAPAY BY CLICKING ON PESAPAY AND INPUT THE DETAILS </li><BR />
    <li>(8) THATS IT FEEL FREE TO EXPLORE THE SYSTEM.</li>
 
</ol>
</ul></p>
</fieldset>



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
      <p class="lf">Copyright &copy; <a href="#">David Mwangi </a>. All Rights Reserved</p>
      <p class="rf">Design by <a target="_blank" href="http://www.musyoka.com/">Administrator</a></p>
      <div style="clear:both;"></div>
    </div>
  </div>
</div>
</body>
</html>
<?php } ?>
