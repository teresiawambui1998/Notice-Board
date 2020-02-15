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
       <li class="active"><a href="home.php"><span>Home Page</span></a></li>
          <li><a href="members.php"><span>Members</span></a></li>
          <li><a href="county_bursary.php"><span>County Bursary</span></a></li>
		  <li><a href="report.php"><span>Report</span></a></li>
		  <li><a href="pesapay.php"><span>Pesa Pay</span></a></li>
		  <li><a href="tf_card.php"><span>Pay With Tokens</span></a></li>
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
$reg_no=$row['reg_no'];
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

<p><strong>First Name:</strong> $f_name.<p/>
<p><strong>Last Name:</strong> $lname.<p/>
<p><strong>County:</strong> $user_county.<p/>
<p><strong>Reg No:</strong> $reg_no.<p/>
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
	<fieldset><legend align="center">Help</legend>
	<p>(1)To pay with Tokens,enter top_up keys in the field below  then click pay  button to make payment .</p> </fieldset>


 

<fieldset><legend align="center"><H3>Pay School Fees With Tokens.</H3></legend>


   <form action="" method="Post" id="form3">

<table  align="center">

 <tr> <td  id="hdtd"colspan="2" bgcolor="#99CCFF" >Tertiary Finance Tokens</td></tr>
  <tr>
    <td align="right">Top_up_keys:</td>
    <td><Input type="text" name="topup" placeholder="Enter Tokens keys Here."required="required"  /></td>
    </tr><tr>
 
    <td align="right" colspan="6">
	<button name="credit" onclick='return leavepage()'>Pay</button></td>
  </tr> </table>
</form>
   </fieldset>
   

<script type="text/javascript">
        function PrintDiv(id) {
            var data=document.getElementById(id).innerHTML;
            var myWindow = window.open('', 'my div', 'height=400,width=600');
            myWindow.document.write('<html><head><title>Ksh 1000.00 TF cards </title>');
            /*optional stylesheet*/ //myWindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
            myWindow.document.write('</head><body >');
            myWindow.document.write(data);
            myWindow.document.write('</body></html>');
            myWindow.document.close(); // necessary for IE >= 10

            myWindow.onload=function(){ // necessary if the div contain images

                myWindow.focus(); // necessary for IE >= 10
                myWindow.print();
                myWindow.close();
            };
        }
    </script>
	
<?php
$get_sem="select * from transaction where user_id='$user_id' ORDER by 1 DESC LIMIT 100";
$run_sem=mysqli_query($con,$get_sem);
$check=mysqli_num_rows($run_sem);
if($check>=1){
echo"<h3 align='center'>Reported Semesters And Invoice Adjustments </h3>";
echo"<table width='100%' border='1'><tr><th width='25%' bgcolor='#99CCFF'>Description</th><th  width='25%' bgcolor='#99CCFF'>Semester</th><th  width='25%' bgcolor='#99CCFF'>Amount</th> <th  width='25%' bgcolor='#99CCFF'>Date reported</th></tr></table>";}
?>
<?php
// paying fee

if(isset($_POST['credit']))

{
global $con;
global $user_id;
$credit=0;
$topup=$_POST['topup'];
$payment_type="TF_Card";
$get_id="select * from transaction  where user_id='$user_id' ";
$run_id=mysqli_query($con,$get_id);
$check5=mysqli_num_rows($run_id);
if($check5==0)
{ echo"<script> alert('please report first')</script>";
echo"<script>window.open('report.php','_self')</script>";
exit();
}
$get_key="select * from key_1000 where top_up_key='$topup'";
$run_key=mysqli_query($con,$get_key);
$check=mysqli_num_rows($run_key);
if($check==1)

{
$credit=1000;
$get_key="select * from transaction where top_up_key='$topup'";
$run_key=mysqli_query($con,$get_key);
$check=mysqli_num_rows($run_key);
if($check==1)
{
echo"<script> alert('The token you entered does not exist or have already been used please rechake your TF_card.')</script>";
$get_balance="select * from transaction where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$balance=$row['account'];
echo"Current Balance:<table border='1'><tr><td bgcolor='red'>Ksh $balance</td></tr></table>";
echo"<script>window.open('tf_card.php','_self')</script>";

exit();
}
//getting balance.
$get_balance="select * from transaction where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$balance=$row['account'];
$confo=$row['confirmation_id'];

$code="";
$coder="QA23SDER45VCGFHJKLP7945GFHY67BNNH89876UUHY878NMJKI9LKP98GFHV564TRVCFD53CXDZXASWE239CHCVBV";
$coderArray=str_split($coder);
for($i=0;$i<10;$i++){
$randItem=array_rand($coderArray);
$code.="".$coderArray[$randItem];

}

//updating current fee
$get_credit="select * from transaction where user_id='$user_id' ORDER by 1 DESC LIMIT 1 ";
$run_credit=mysqli_query($con,$get_credit);
$row=mysqli_fetch_array($run_credit);
$total_credit=$row['total_credit'];
$account=$row['account'];
$check=mysqli_num_rows($run_credit);
if($check==0)
{
$total_credit=$credit;
$new_credit=$total_credit;
}
else{

$new_credit=$total_credit+$credit;

}

 


$account_set=$account-$credit;
//invoice adjustment

$get_balance="select * from transaction where user_id='$user_id' and semester!=''ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$semester=$row['semester'];


$get_am="select * from  adjustment_account where semester='$semester'  ORDER by 1 DESC LIMIT 1";
$run_am=mysqli_query($con,$get_am);
$row=mysqli_fetch_array($run_am);
$located=$row['amount'];
$description=$row['description'];


$get_balance="select * from transaction where user_id='$user_id' and description='$description'";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$check=mysqli_num_rows($run_balance);
if($check==0)
{
$account_set=$account_set+$located;
//creating 1000 tokens
$result="";
$chars="AQW12VCBCY76DHFJD89DGDFCC67FDECDSCZCNVMVK9GDVSFSF3CXCZGFAF2VZBXBCUDUETGTQGG1MCNXCBXCVDGJUDUD897";
$charArray=str_split($chars);
for($i=0;$i<16;$i++){
$randItem=array_rand($charArray);
$result.="".$charArray[$randItem];
}

$TOKEN = "insert into key_1000 (top_up_key,status)
 values('$result','no')";
 $run = mysqli_query($con,$TOKEN);
 //getting reg_no
$get_reg="select * from users where user_id='$user_id'";
$run_reg=mysqli_query($con,$get_reg);
$row=mysqli_fetch_array($run_reg);
$reg_no=$row['reg_no'];
//updating school account.
$get_acc="select * from school_account   ORDER by 1 DESC LIMIT 1";
$run_acc=mysqli_query($con,$get_acc);
$row=mysqli_fetch_array($run_acc);
$acc_ttl=$row['total'];
$new_ttl=$acc_ttl+$credit;
$input = "insert into school_account (total,reg_no,credit,confirmation_id,top_up_key)
 values('$new_ttl','$reg_no','$credit','$code','$topup')";
 $run = mysqli_query($con,$input);

$insert = "insert into transaction (user_id,reg_no,top_up_key,credit,confirmation_id,payment_type,total_credit,account,semester,description,amount)
 values('$user_id','$reg_no','$topup','$credit','$code','$payment_type','$new_credit','$account_set','$semester','$description','$located')";

$run = mysqli_query($con,$insert);
//determining used keys
$get_key="select * from key_1000 where top_up_key='$topup'";
$run_key=mysqli_query($con,$get_key);
$check=mysqli_num_rows($run_key);
if($check==1)
{
$update="update key_1000 set status='yes' where top_up_key='$topup'";
$run_update=mysqli_query($con,$update);
}

if($run)
{
echo"<script> alert('Your account has been credited with Ksh 1000 ,thankyou for using Tertiary Finance(TF).')</script></h3>";
$get_balance="select * from transaction where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$balance=$row['account'];

echo"Current Balance:<table border='1'><tr><td bgcolor='red'>Ksh $balance</td></tr></table>";

echo"<script>window.open('tf_card.php','_self')</script>";


exit();
}}
//end

//creating 1000 tokens
$result="";
$chars="AWQEQWGVBCVNVIUTRJTORP7GDGD5GVDSVDTDC6WFDCCFW4ASDASA3VCVCBVCXB2VXVZXCXCV1BNDBD9NXNZVVZD6VBD8BDBDVD6SACS34ZXXC";
$charArray=str_split($chars);
for($i=0;$i<16;$i++){
$randItem=array_rand($charArray);
$result.="".$charArray[$randItem];

}
$TOKEN = "insert into key_1000 (top_up_key,status)
 values('$result','no')";
 $run = mysqli_query($con,$TOKEN);
 //getting reg_no
$get_reg="select * from users where user_id='$user_id'";
$run_reg=mysqli_query($con,$get_reg);
$row=mysqli_fetch_array($run_reg);
$reg_no=$row['reg_no'];
//updating school account.
$get_acc="select * from school_account   ORDER by 1 DESC LIMIT 1";
$run_acc=mysqli_query($con,$get_acc);
$row=mysqli_fetch_array($run_acc);
$acc_ttl=$row['total'];
$new_ttl=$acc_ttl+$credit;
$input = "insert into school_account (total,reg_no,credit,confirmation_id,top_up_key)
 values('$new_ttl','$reg_no','$credit','$code','$topup')";
 $run = mysqli_query($con,$input);

$insert = "insert into transaction (user_id,reg_no,top_up_key,credit,confirmation_id,payment_type,total_credit,account,semester)
 values('$user_id','$reg_no','$topup','$credit','$code','$payment_type','$new_credit','$account_set','$semester')";

$run = mysqli_query($con,$insert);
//determining used keys
$get_key="select * from key_1000 where top_up_key='$topup'";
$run_key=mysqli_query($con,$get_key);
$check=mysqli_num_rows($run_key);
if($check==1)
{
$update="update key_1000 set status='yes' where top_up_key='$topup'";
$run_update=mysqli_query($con,$update);
}

if($run)
{
echo"<script> alert('Your account has been credited with Ksh 1000 ,thankyou for using Tertiary Finance(TF).')</script></h3>";
$get_balance="select * from transaction where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$balance=$row['account'];

echo"Current Balance:<table border='1'><tr><td bgcolor='red'>Ksh $balance</td></tr></table>";


echo"<script>window.open('tf_card.php','_self')</script>";

exit();
}
} 
//second check
if($check==0)
{

$get_key="select * from key_500 where top_up_key='$topup'";
$run_key=mysqli_query($con,$get_key);
$check=mysqli_num_rows($run_key);
 if($check==1)

{
$credit=500;

$get_key="select * from transaction where top_up_key='$topup'";
$run_key=mysqli_query($con,$get_key);
$check=mysqli_num_rows($run_key);
if($check==1)
{
echo"<script> alert('The token you enterd does not exist please rechake your TF_card.')</script>";
$get_balance="select * from transaction where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$balance=$row['balance'];
echo"Current Balance:<table border='1'><tr><td bgcolor='red'>Ksh $balance</td></tr></table>";
echo"<script>window.open('tf_card.php','_self')</script>";

exit();
}
$get_debt="select * from transaction where user_id='$user_id' ";
$run_debt=mysqli_query($con,$get_debt);
$row=mysqli_fetch_array($run_debt);
$debt=$row['debt'];
$check=mysqli_num_rows($run_debt);
if($check==0)
{
$get_debt="select * from time_semester  ORDER by 1 DESC LIMIT 1";
$run_debt=mysqli_query($con,$get_debt);
$row=mysqli_fetch_array($run_debt);
$debt=$row['total'];
$confermation=$row['confirmation_id'];

$insert = "insert into transaction (user_id,debt,balance,confirmation_id)
 values('$user_id','$debt','$debt','$confermation')";
$run = mysqli_query($con,$insert);

}
//getting balance.
$get_balance="select * from transaction where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$balance=$row['account'];
$confo=$row['confirmation_id'];

$code="";
$coder="AVBYTWUIKMNGHRT6572DV9812BNMPLZXSWQ1345MNVBR65893ZXCDERTY5QA2345678MVBXURHDFXSFD";
$coderArray=str_split($coder);
for($i=0;$i<10;$i++){
$randItem=array_rand($coderArray);
$code.="".$coderArray[$randItem];
}
//updating current fee
$get_credit="select * from transaction where user_id='$user_id' ORDER by 1 DESC LIMIT 1 ";
$run_credit=mysqli_query($con,$get_credit);
$row=mysqli_fetch_array($run_credit);
$total_credit=$row['total_credit'];
$account=$row['account'];
$check=mysqli_num_rows($run_credit);
if($check==0)
{
$total_credit=$credit;
$new_credit=$total_credit;
}
else{

$new_credit=$total_credit+$credit;

}

 


$account_set=$account-$credit;
//invoice adjustment

$get_balance="select * from transaction where user_id='$user_id' and semester!=''ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$semester=$row['semester'];


$get_am="select * from  adjustment_account where semester='$semester' ORDER by 1 DESC LIMIT 1";
$run_am=mysqli_query($con,$get_am);
$row=mysqli_fetch_array($run_am);
$located=$row['amount'];
$description=$row['description'];


$get_balance="select * from transaction where user_id='$user_id' and description='$description'";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$check=mysqli_num_rows($run_balance);
if($check==0)
{
$account_set=$account_set+$located;
//creating 500 tokens
$result="";
$chars="AWQ7NMU6FGDVCB5ERETY2BVNVMV1BVNVN8JFHDGV6BDFND9BVCBSG2CVCBDXQAZ1";
$charArray=str_split($chars);
for($i=0;$i<16;$i++){
$randItem=array_rand($charArray);
$result.="".$charArray[$randItem];
}

$TOKEN = "insert into key_500 (top_up_key,status)
 values('$result','no')";
 $run = mysqli_query($con,$TOKEN);
 //getting reg_no
$get_reg="select * from users where user_id='$user_id'";
$run_reg=mysqli_query($con,$get_reg);
$row=mysqli_fetch_array($run_reg);
$reg_no=$row['reg_no'];
//updating school account.
$get_acc="select * from school_account   ORDER by 1 DESC LIMIT 1";
$run_acc=mysqli_query($con,$get_acc);
$row=mysqli_fetch_array($run_acc);
$acc_ttl=$row['total'];
$new_ttl=$acc_ttl+$credit;
$input = "insert into school_account (total,reg_no,credit,confirmation_id,top_up_key)
 values('$new_ttl','$reg_no','$credit','$code','$topup')";
 $run = mysqli_query($con,$input);

$insert = "insert into transaction (user_id,reg_no,top_up_key,credit,confirmation_id,payment_type,total_credit,account,semester,description,amount)
 values('$user_id','$reg_no','$topup','$credit','$code','$payment_type','$new_credit','$account_set','$semester','$description','$located')";

$run = mysqli_query($con,$insert);
//determining used keys
$get_key="select * from key_1000 where top_up_key='$topup'";
$run_key=mysqli_query($con,$get_key);
$check=mysqli_num_rows($run_key);
if($check==1)
{
$update="update key_500 set status='yes' where top_up_key='$topup'";
$run_update=mysqli_query($con,$update);
}

if($run)
{
echo"<script> alert('Your account has been credited with Ksh 500 ,thankyou for using Tertiary Finance(TF).')</script></h3>";
$get_balance="select * from transaction where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$balance=$row['account'];

echo"Current Balance:<table border='1'><tr><td bgcolor='red'>Ksh $balance</td></tr></table>";

echo"<script>window.open('tf_card.php','_self')</script>";


exit();
}}
//end

//creating 500 tokens
$result="";
$chars="AQWERCVXBNHKIULP5EFV4CASC3ASFA1VC3FKHNMASZCX84SVR5VDVDV6BFBNFHF7SHDGVD8GZCCXXMDCNDF9VCXCVXC3";
$charArray=str_split($chars);
for($i=0;$i<16;$i++){
$randItem=array_rand($charArray);
$result.="".$charArray[$randItem];

}
$TOKEN = "insert into key_500 (top_up_key,status)
 values('$result','no')";
 $run = mysqli_query($con,$TOKEN);

//getting reg_no
$get_reg="select * from users where user_id='$user_id'";
$run_reg=mysqli_query($con,$get_reg);
$row=mysqli_fetch_array($run_reg);
$reg_no=$row['reg_no'];
//updating school account.
$get_acc="select * from school_account   ORDER by 1 DESC LIMIT 1";
$run_acc=mysqli_query($con,$get_acc);
$row=mysqli_fetch_array($run_acc);
$acc_ttl=$row['total'];
$new_ttl=$acc_ttl+$credit;
$input = "insert into school_account (total,reg_no,credit,confirmation_id,top_up_key)
 values('$new_ttl','$reg_no','$credit','$code','$topup')";
 $run = mysqli_query($con,$input);

$insert = "insert into transaction (user_id,reg_no,top_up_key,credit,confirmation_id,payment_type,total_credit,account)
 values('$user_id','$reg_no','$topup','$credit','$code','$payment_type','$new_credit','$account_set')";

$run = mysqli_query($con,$insert);
//determining 500 used keys
$get_key="select * from key_500 where top_up_key='$topup'";
$run_key=mysqli_query($con,$get_key);
$check=mysqli_num_rows($run_key);
if($check==1)
{
$update="update key_500 set status='yes' where top_up_key='$topup'";
$run_update=mysqli_query($con,$update);
}
if($run)
{
echo"<script> alert('Your account has been credited with Ksh 500 ,thankyou for using Tertiary Finance(TF).')</script></h3>";
$get_balance="select * from transaction where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$balance=$row['balance'];
echo"Current Balance:<table border='1'><tr><td bgcolor='red'>Ksh $balance</td></tr></table>";

echo"<script>window.open('tf_card.php','_self')</script>";

exit();
}


} 

}
//third check
if($check==0)
{

$get_key="select * from key_100 where top_up_key='$topup'";
$run_key=mysqli_query($con,$get_key);
$check=mysqli_num_rows($run_key);
 if($check==1)

{
$credit=100;

$get_key="select * from transaction where top_up_key='$topup'";
$run_key=mysqli_query($con,$get_key);
$check=mysqli_num_rows($run_key);
if($check==1)
{
echo"<script> alert('The token you enterd does not exist please rechake your TF_card.')</script>";
$get_balance="select * from transaction where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$balance=$row['balance'];
echo"Current Balance:<table border='1'><tr><td bgcolor='red'>Ksh $balance</td></tr></table>";
echo"<script>window.open('tf_card.php','_self')</script>";

exit();
}
$get_debt="select * from transaction where user_id='$user_id' ";
$run_debt=mysqli_query($con,$get_debt);
$row=mysqli_fetch_array($run_debt);
$debt=$row['debt'];
$check=mysqli_num_rows($run_debt);
if($check==0)
{
$get_debt="select * from time_semester  ORDER by 1 DESC LIMIT 1";
$run_debt=mysqli_query($con,$get_debt);
$row=mysqli_fetch_array($run_debt);
$debt=$row['total'];
$confermation=$row['confirmation_id'];

$insert = "insert into transaction (user_id,debt,balance,confirmation_id)
 values('$user_id','$debt','$debt','$confermation')";
$run = mysqli_query($con,$insert);


}
//getting balance.
$get_balance="select * from transaction where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$balance=$row['account'];
$confo=$row['confirmation_id'];

$code="";
$coder="M1N2B3VC45XZ6ASD98DFGTRE45WQUY2P4KL7JHK9SZPKFGRTEYSCDVM45GDGVXVAV132";
$coderArray=str_split($coder);
for($i=0;$i<10;$i++){
$randItem=array_rand($coderArray);
$code.="".$coderArray[$randItem];

}

//updating current fee
$get_credit="select * from transaction where user_id='$user_id' ORDER by 1 DESC LIMIT 1 ";
$run_credit=mysqli_query($con,$get_credit);
$row=mysqli_fetch_array($run_credit);
$total_credit=$row['total_credit'];
$account=$row['account'];
$check=mysqli_num_rows($run_credit);
if($check==0)
{
$total_credit=$credit;
$new_credit=$total_credit;
}
else{

$new_credit=$total_credit+$credit;

}

 


$account_set=$account-$credit;
//invoice adjustment


$get_balance="select * from transaction where user_id='$user_id' and semester!=''ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$semester=$row['semester'];


$get_am="select * from  adjustment_account where semester='$semester' ORDER by 1 DESC LIMIT 1";
$run_am=mysqli_query($con,$get_am);
$row=mysqli_fetch_array($run_am);
$located=$row['amount'];
$description=$row['description'];


$get_balance="select * from transaction where user_id='$user_id' and description='$description'";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$check=mysqli_num_rows($run_balance);
if($check==0)
{
$account_set=$account_set+$located;
//creating 100 tokens
$result="";
$chars="ASWGFBNDF7UNRG8NGKEWJER9HSVCQW4CVD45DBNDNKXS1SDDSVD9VVFD5VVXCV1GTERT5DSDFC7VBVN8BBN9CCZCDS4923";
$charArray=str_split($chars);
for($i=0;$i<16;$i++){
$randItem=array_rand($charArray);
$result.="".$charArray[$randItem];
}

$TOKEN = "insert into key_100 (top_up_key,status)
 values('$result','no')";
 $run = mysqli_query($con,$TOKEN);
 //getting reg_no
$get_reg="select * from users where user_id='$user_id'";
$run_reg=mysqli_query($con,$get_reg);
$row=mysqli_fetch_array($run_reg);
$reg_no=$row['reg_no'];
//updating school account.
$get_acc="select * from school_account   ORDER by 1 DESC LIMIT 1";
$run_acc=mysqli_query($con,$get_acc);
$row=mysqli_fetch_array($run_acc);
$acc_ttl=$row['total'];
$new_ttl=$acc_ttl+$credit;
$input = "insert into school_account (total,reg_no,credit,confirmation_id,top_up_key)
 values('$new_ttl','$reg_no','$credit','$code','$topup')";
 $run = mysqli_query($con,$input);

$insert = "insert into transaction (user_id,reg_no,top_up_key,credit,confirmation_id,payment_type,total_credit,account,semester,description,amount)
 values('$user_id','$reg_no','$topup','$credit','$code','$payment_type','$new_credit','$account_set','$semester','$description','$located')";

$run = mysqli_query($con,$insert);
//determining used keys
$get_key="select * from key_100 where top_up_key='$topup'";
$run_key=mysqli_query($con,$get_key);
$check=mysqli_num_rows($run_key);
if($check==1)
{
$update="update key_100 set status='yes' where top_up_key='$topup'";
$run_update=mysqli_query($con,$update);
}

if($run)
{
echo"<script> alert('Your account has been credited with Ksh 100 ,thankyou for using Tertiary Finance(TF).')</script></h3>";
$get_balance="select * from transaction where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$balance=$row['account'];

echo"Current Balance:<table border='1'><tr><td bgcolor='red'>Ksh $balance</td></tr></table>";


echo"<script>window.open('tf_card.php','_self')</script>";

exit();
}}
//end

//creating 100 tokens
$result="";
$chars="AQW34ERDFDGXCZXVY56KFHFJCF7NCPLKMNCVXU8EHYERHJR9AXZCZC1SFDCFD5GFDGVFHFHJF8SFWDXZC45DFFFNVCI9";
$charArray=str_split($chars);
for($i=0;$i<16;$i++){
$randItem=array_rand($charArray);
$result.="".$charArray[$randItem];

}
$TOKEN = "insert into key_100 (top_up_key,status)
 values('$result','no')";
 $run = mysqli_query($con,$TOKEN);
//getting reg_no
$get_reg="select * from users where user_id='$user_id'";
$run_reg=mysqli_query($con,$get_reg);
$row=mysqli_fetch_array($run_reg);
$reg_no=$row['reg_no'];
//updating school account.
$get_acc="select * from school_account   ORDER by 1 DESC LIMIT 1";
$run_acc=mysqli_query($con,$get_acc);
$row=mysqli_fetch_array($run_acc);
$acc_ttl=$row['total'];
$new_ttl=$acc_ttl+$credit;
$input = "insert into school_account (total,reg_no,credit,confirmation_id,top_up_key)
 values('$new_ttl','$reg_no','$credit','$code','$topup')";
 $run = mysqli_query($con,$input);

$insert = "insert into transaction (user_id,reg_no,top_up_key,credit,confirmation_id,payment_type,total_credit,account)
 values('$user_id','$reg_no','$topup','$credit','$code','$payment_type','$new_credit','$account_set')";

$run = mysqli_query($con,$insert);

//determining 100 used keys
$get_key="select * from key_100 where top_up_key='$topup'";
$run_key=mysqli_query($con,$get_key);
$check=mysqli_num_rows($run_key);
if($check==1)
{
$update="update key_100 set status='yes' where top_up_key='$topup'";
$run_update=mysqli_query($con,$update);
}
if($run)
{
echo"<script> alert('Your account has been credited with Ksh 100 ,thankyou for using Tertiary Finance(TF).')</script></h3>";
$get_balance="select * from transaction where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$balance=$row['balance'];
echo"Current Balance:<table border='1'><tr><td bgcolor='red'>Ksh $balance</td></tr></table>";

echo"<script>window.open('tf_card.php','_self')</script>";

exit();
}
} 
}
{
echo"<script> alert('The token you entered does not exist,please recheck your  TF_card ')</script>";
$get_balance="select * from transaction where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$balance=$row['account'];
echo"Current Balance:<table border='1'><tr><td bgcolor='red'>Ksh $balance</td></tr></table>";
echo"<script>window.open('tf_card.php','_self')</script>";

exit();
}}

?>



<?php 
//getting semester fee alocated
 
$get_sem="select * from transaction where user_id='$user_id' and description!='' ORDER by 1 DESC LIMIT 15";
$run_sem=mysqli_query($con,$get_sem);
while($row=mysqli_fetch_array($run_sem))

{
$sem_key=$row['transaction_id'];
$semester=$row['semester'];
$amount=$row['amount'];
$description=$row['description'];
$date=$row['date'];
echo"<table align='center' border='1' width='100%'>
<tr><td width='25%'>$description</td>
<td  width='25%'>$semester</td>
<td width='25%'>Ksh $amount.00</td>
<td >$date</td>
</tr></table>";
}
$get_sem="select * from transaction where user_id='$user_id'ORDER by 1 DESC LIMIT 100";
$run_sem=mysqli_query($con,$get_sem);
$check=mysqli_num_rows($run_sem);
if($check>=1)
{
echo"<h3 align='center'>My Transactions.</h3>";
echo"<table width='100%' border='1' align='left'> 
<tr><td width='25%' bgcolor='#99CCFF'>Credit</td><td width='25%' bgcolor='#99CCFF'>Balance</td> <td width='25%' bgcolor='#99CCFF'> Payment type</td> <td bgcolor='#99CCFF'>Date</td></tr></table>";
}
$get_payment="select * from transaction where user_id='$user_id' ";
$run_payment=mysqli_query($con,$get_payment);
$row=mysqli_fetch_array($run_payment);
while($row=mysqli_fetch_array($run_payment)){
$transaction_id=$row['transaction_id'];
$credit=$row['credit'];
$account=$row['account'];
$payment_type=$row['payment_type'];
$date=$row['date'];

echo"
<table border='1'align='left' width='100%'>
<tr>  <td width='25%'>Ksh$credit.00</td> <td width='25%'>Ksh $account.00</td> <td width='25%'>$payment_type</td><td >$date </td></tr>


</fieldset>
</table>";}
echo"
<fieldset> </fieldset>
<table border='1'align='left' width='100%'><tr><td width='25%'>Current Balance</td><td>Ksh $account.00</td></tr></table>";

 ?>

 
 

 
<?php 
if(isset($_POST['report']))

{
global $con;
global $user_id;

$semester=$_POST['semester'];
if($semester=="select semester")
{
echo"<script>alert(' please select semester')</script>";
exit();
}

$get_sem="select * from transaction where semester='$semester' and user_id='$user_id' ORDER by 1 DESC LIMIT 1";
$run_sem=mysqli_query($con,$get_sem);
$check=mysqli_num_rows($run_sem);
if($check>=1)
{
echo"<script> alert('Session report Exist')</script>";
exit();
}
if($check==0)

{
$get_sem="select * from time_semester  where semester='$semester'";
$run_sem=mysqli_query($con,$get_sem);
$row=mysqli_fetch_array($run_sem);
$amount=$row['amount'];
$confermation=$row['confirmation_id'];
$sem=$row['semester'];
//getting invoice adjustment

$get_am="select * from  adjustment_account where semester='$semester' ORDER by 1 DESC LIMIT 1";
$run_am=mysqli_query($con,$get_am);
$row=mysqli_fetch_array($run_am);
$located=$row['amount'];
$description=$row['description'];
$get_reg="select * from users where user_id='$user_id'";
$run_reg=mysqli_query($con,$get_reg);
$row=mysqli_fetch_array($run_reg);
$reg_no=$row['reg_no'];

$get_acc="select * from transaction  where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_acc=mysqli_query($con,$get_acc);
$row=mysqli_fetch_array($run_acc);
$accl=$row['account'];
$total_credit=$row['total_credit'];
$update=$accl+$amount;

$insert = "insert into transaction (reg_no,user_id,amount,semester,confirmation_id,account,description,total_credit)
 values('$reg_no','$user_id','$amount','$semester','$confermation','$update','Fee','$total_credit')";
$run = mysqli_query($con,$insert);
$update1=$located;
$update=$accl+$amount+$located;

$insert = "insert into transaction (reg_no,user_id,amount,semester,confirmation_id,account,description,total_credit)
 values('$reg_no','$user_id','$located','$semester','$confermation','$update','$description','$total_credit')";
$run = mysqli_query($con,$insert);
echo"<script> alert('session report was made successfuly!')</script>";
echo"<script>window.open('finance.php','_self')</script>";
exit();
}


}

?>
 
 


<?php //connection to pesa account
include("pesa/connection.php");
if(isset($_POST['token']))

{
global $conn;
global $user_id;
$account1=$_POST['account'];
$password1=$_POST['password'];
$amount=$_POST['amount'];
$get_user="select * from record where account_number='$account1'";
$run_user=mysqli_query($conn,$get_user);
$row=mysqli_fetch_array($run_user);
$check=mysqli_num_rows($run_user);
if($check==0)
{
echo"<script> alert('you are  not registered to Pesa Pay (PP) REGISTER first.')</script>";
exit();
}
if($check==1)
{
//security check 
$get_acci="select * from record where account_number='$account1'  ORDER by 1 DESC LIMIT 1";
$run_acci=mysqli_query($conn,$get_acci);
$row=mysqli_fetch_array($run_acci);
$password=$row['password'];
if($password!=$password1)
{
echo"<script> alert(' Pesa Pay(PP) account number  or password is incorect please correct. ')</script>";
exit();
}
//buying tokens
$my_id=$row['rec_id'];
$get_acci="select * from record where account_number='$account1'  ORDER by 1 DESC LIMIT 1";
$run_acci=mysqli_query($conn,$get_acci);
$row=mysqli_fetch_array($run_acci);
$rec_id=$row['rec_id'];

$get_acci="select * from balance_draw where account_number='$account1'  ORDER by 1 DESC LIMIT 1";
$run_acci=mysqli_query($conn,$get_acci);
$row=mysqli_fetch_array($run_acci);
$balance=$row['balance'];
$used=$row['user_id'];

if($balance<$amount)
{
echo"<script> alert('your balance is insufficient!')</script>";
exit();
}
$get_id="select * from transaction  where user_id='$user_id' ";
$run_id=mysqli_query($con,$get_id);
$check5=mysqli_num_rows($run_id);
if($check5==0)
{ echo"<script> alert('please report first')</script>";
exit();
}
//invoice start
$get_balance="select * from transaction where user_id='$user_id' and semester!=''ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$semester=$row['semester'];


$get_am="select * from  adjustment_account where semester='$semester'  ORDER by 1 DESC LIMIT 1";
$run_am=mysqli_query($con,$get_am);
$row=mysqli_fetch_array($run_am);
$located=$row['amount'];
$description=$row['description'];


$get_balance="select * from transaction where user_id='$user_id' and description='$description' ORDER by 1 DESC LIMIT 1";
$run_balance=mysqli_query($con,$get_balance);
$row=mysqli_fetch_array($run_balance);
$check=mysqli_num_rows($run_balance);
if($check==0)
{
$get_credit="select * from transaction where user_id='$user_id' ORDER by 1 DESC LIMIT 1 ";
$run_credit=mysqli_query($con,$get_credit);
$row=mysqli_fetch_array($run_credit);
$total_credit=$row['total_credit'];
$account=$row['account'];
$invoice=$account+$located;
//getting reg_no
$get_reg="select * from users where user_id='$user_id'";
$run_reg=mysqli_query($con,$get_reg);
$row=mysqli_fetch_array($run_reg);
$reg_no=$row['reg_no'];
//updating school account.
$get_acc="select * from school_account   ORDER by 1 DESC LIMIT 1";
$run_acc=mysqli_query($con,$get_acc);
$row=mysqli_fetch_array($run_acc);
$acc_ttl=$row['total'];
$new_ttl=$acc_ttl+$credit;

$input = "insert into school_account (total,reg_no,credit,confirmation_id,top_up_key)
 values('$new_ttl','$reg_no','$credit','$code','$topup')";
 $run = mysqli_query($con,$input);
 $talkpay="AZWERTTUYOIPLHKHJHFNVBCXVSCDFEGHLOP9785542312VCVBGFGGFFDKJH";

$code="";
$chars=$talkpay;
$charArray=str_split($chars);
for($i=0;$i<11;$i++){
$randItem=array_rand($charArray);
$code.="".$charArray[$randItem];
}


$insert = "insert into transaction (user_id,reg_no,confirmation_id,total_credit,account,semester,description,amount)
 values('$user_id','$reg_no','$code','$total_credit','$invoice','$semester','$description','$located')";
$run = mysqli_query($con,$insert);
}
//invoice ends
$talkpay="AQMKPYHGTY234567";

$result="";
$chars=$talkpay;
$charArray=str_split($chars);
for($i=0;$i<16;$i++){
$randItem=array_rand($charArray);
$result.="".$charArray[$randItem];
}

$get_reg="select * from users where user_id='$user_id'";
$run_reg=mysqli_query($con,$get_reg);
$row=mysqli_fetch_array($run_reg);
$reg_no=$row['reg_no'];

$get_acc="select * from transaction  where user_id='$user_id'  ORDER by 1 DESC LIMIT 1";
$run_acc=mysqli_query($con,$get_acc);
$row=mysqli_fetch_array($run_acc);
$accl=$row['account'];
$total_credit=$row['total_credit'];
$new_pay=$total_credit+$amount;
$update=$accl-$amount;

$insert = "insert into transaction (reg_no,user_id,top_up_key,account,total_credit,payment_type,credit)
 values('$reg_no','$user_id','$result','$update','$new_pay','Pesa Pay','$amount')";
$run = mysqli_query($con,$insert);
//sorting balance for pesa pay
$rec=$balance-$amount;

$insert = "insert into balance_draw (account_number,receiver_id,balance)
 values('$account1','$rec_id','$rec')";
$run = mysqli_query($conn,$insert);

//getting school Pay bill_number
$get_account="select * from  pesa_pay_account ORDER by 1 DESC LIMIT 1";
$run_account=mysqli_query($con,$get_account);
$row=mysqli_fetch_array($run_account);
$pay_bill_no=$row['pay_bill_no'];

$get_account="select * from  paybill_register where paybill_number='$pay_bill_no'";
$run_account=mysqli_query($conn,$get_account);
$row=mysqli_fetch_array($run_account);
$check=mysqli_num_rows($run_account);
if($check==0){
echo"<script>alert('We have a problem  of accessing school Pesa Pay(PP) account please try again laiter')</script>";
exit();}
if($check==1)
{
$get_acbl="select * from  paybill_balance where paybill_no='$pay_bill_no' ORDER by 1 DESC LIMIT 1";
$run_acbl=mysqli_query($conn,$get_acbl);
$row=mysqli_fetch_array($run_acbl);
$accountcheck=$row['balance'];
$newcheck=$accountcheck+$amount;
$insert = "insert into  paybill_balance (paybill_no,balance )
 values('$pay_bill_no','$newcheck')";
 $run = mysqli_query($conn,$insert);
 
  $code="";
$coder="QA23SDER4RKEWTERTKJASDFGSDN7848583RDBvXXQ232333TYY2CBVNCNVFADS5VCGFHJKLP7945GFHY67BNNH89876UUHY878NMJKI9LKP98GFHV564TRVCFD53CXDZXASWE239CHCVBV";
$coderArray=str_split($coder);
for($i=0;$i<10;$i++){
$randItem=array_rand($coderArray);
$code.="".$coderArray[$randItem];

}
$insert = "insert into  paybill_received (paybill_no,account_number,amount,original_balance,balance)
 values('$pay_bill_no','$account1','$amount','$accountcheck','$newcheck')";
 $run = mysqli_query($conn,$insert);
  
 
}


//account end

if($run){
echo"<script> alert('Payment was made successfully')</script>";
echo"<script>window.open('tf_card.php','_self')</script>";
exit();
}

//end

}



}

//connection ends
?>
<?php
if(isset($_POST['apply']))

{
global $con;
global $user_id;
$get_sem="select * from transaction where user_id='$user_id'";
$run_sem=mysqli_query($con,$get_sem);
$check=mysqli_num_rows($run_sem);
if($check==0)
{
echo"<script> alert('Please Report First')</script>";
exit();
}
else{

$county=$_POST['county'];
if($county=="select county")
{
echo"<script>alert('Select county')</script>";
exit();
}

$get_re="select * from users where user_id='$user_id'";
$run_re=mysqli_query($con,$get_re);
$row=mysqli_fetch_array($run_re);
$reg_no=$row['reg_no'];
$county=$row['user_county'];

$get_re="select * from time_semester where semester='$semester'";
$run_re=mysqli_query($con,$get_re);
$row=mysqli_fetch_array($run_re);
$year=$row['academic_year'];

$get_sem="select * from county_bursary where academic_year='$year' and reg_no='$reg_no'";
$run_sem=mysqli_query($con,$get_sem);
$check=mysqli_num_rows($run_sem);
if($check==1)
{
echo"<script> alert('You had already applied bursary for this year ')</script>";
exit();
}

else{
$insert = "insert into county_bursary (county_name,reg_no,semester,academic_year,status)
 values('$county','$reg_no','$semester','$year','no')";
$run = mysqli_query($con,$insert);
if($insert){
echo"<script>alert('Information send Successfully') </script>";}
}}}?>


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

