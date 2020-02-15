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

<p><strong>Name:</strong> $f_name $lname.<p/>
<p><strong>Reg_no:</strong> $reg_no.<p/>
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
<?Php
$get_re="select * from county_bursary where  reg_no='$reg_no'";
$run_re=mysqli_query($con,$get_re);
$row=mysqli_fetch_array($run_re);
$residence=$row['residence'];
$subcounty=$row['subcounty'];
$ward=$row['ward'];
$village=$row['village'];
$father_name=$row['father_name'];
$mother_name=$row['mother_name'];
$parent_no=$row['parent_no'];
$father_occupation=$row['father_occupation'];
$mother_occupation=$row['mother_occupation'];
$gurdian_name=$row['gurdian_name'];
$gurdian_occupation=$row['gurdian_occupation'];
$gurdian_phone=$row['gurdian_phone'];
$parent_status=$row['parent_status'];
$supporting_document=$row['supporting_document'];
$disability=$row['disability'];
$disability_disc=$row['disability_disc'];
$id_no=$row['id_no'];
$id_photo=$row['id_photo'];
?>

</div>
</div>
    <div class="content_resize">
	<div id="content_timeline">
<form action="" method="Post" enctype="multipart/form-data" name="form3" class="ff" id="form3">
<fieldset><legend align="center">
<H3>BACKGROUND OF APPLICANT</H3></legend>

<table  align="center">

 <tr>
  <td width="50"><tr><td>Residence:</td>
    <td align="right"><input type="text" name="residence" placeholder="enter residence." required="required"  value="<?php echo $residence?>"></td> </td>
	<td width="50"><td>Name Of father:</td>
    <td align="right"><Input type="text" name="father"   placeholder="enter father name." required="required" value="<?php echo $father_name?>"/></td>
     </tr>
	 <tr>
  <td width="50"><tr><td>Subcounty:</td>
    <td align="right"><input type="text" name="subcounty" placeholder="enter subcounty." required="required"  value="<?php echo $subcounty?>"></td> 
	 <td width="50"><td>Name Of mother:</td>
  <td align="right"><Input type="text" name="mother" placeholder="enter mother name." required="required" value="<?php echo $mother_name?>"/></td>
     </tr>
	 <tr>
  <td width="50"><tr><td>Ward:</td>
    <td align="right"><input type="text" name="ward" placeholder="enter ward." required="required"  value="<?php echo $ward?>"></td>

  <td width="50"><td>Father  occupation:</td>
    <td align="right"><input type="text" name="father_op" placeholder="enter father's occupation." required="required"  value="<?php echo $father_occupation?>"></td>
     </tr>
	 
	 <tr>
  <td width="50"><tr><td>Village:</td>
    <td align="right"><input type="text" name="village" placeholder="enter village." required="required"  value="<?php echo $village?>">
	</td>
	<td width="50"><td>Mother occupation:</td>
    <td align="right"><input type="text" name="mother_op" placeholder="enter mother's occupation." required="required"  value="<?php echo $mother_occupation?>"></td>
     </tr>
	 
	
	 <tr><td></td><td>Guardian details<td></tr>
	<tr>
  <td width="50"><tr><td>Name of gurdian:</td>
    <td align="right"><input type="text" name="gurdian_name" placeholder="enter gurdian name." required="required"  value="<?php echo $gurdian_name?>"></td>
	<td width="50"><td>Mother/Father phone no:</td>
   <td align="right"><Input type="text" name="parent_no"   placeholder="enter parent phone no." required="required" value="<?php echo $parent_no?>"/></td>
     </tr>
	 <tr>
  <td width="50"><tr><td>Gurdian occupation:</td>
    <td align="right"><input type="text" name="gurdian_occ" placeholder="enter gurdian_occupation." required="required" value="<?php echo $gurdian_occupation?>"></td>
	<td width="50"><td>Your status :</td>
  <td align="right"><select name="status" required="required" />
	<option>
	<?php echo $parent_status?> 
	</option>
	
	<?php global $con;
$get_sem="select * from state_of_applicant";
$run_sem=mysqli_query($con,$get_sem);
while($row=mysqli_fetch_array($run_sem))

{

$sem=$row['status'];

echo"<option>$sem</option>";

} ?></option>
	
	</select>
	</td>
     </tr>
	  <tr>
  <td width="50"><tr><td>Gurdian phone_no:</td>
    <td align="right"><input type="text" name="gurdian_pho" placeholder="enter gurdian_phone no." required="required" value="<?php echo $gurdian_phone?>"></td>
	 <td width="50"><td>Supporting document:</td>
    <td align="right"><Input type="file" name="document_photo" value="<?php echo $supporting_document?>" /></td>
     </tr>
   <tr>
    <td align="right">Id no:</td>
    <td align="right"><Input type="text" name="id_no" placeholder="enter identification no." value="<?php echo $id_no?>" required="required"/></td>
	<td width="50"><td>Any disability:</td>
    <td align="right"><select name="disability"  >
	<option>
	<?php echo $disability?>
	</option>
	<option>Yes </option>
	<option>No</option>
	</select>
	</td>
    </tr>
	<tr>
    <td align="right">National id scanned photo:</td>
    <td align="right"><Input type="file" name="id_photo" value="<?php echo $id_photo?>" required="required" /></td>
	<td width="50"><td>Disability discription:</td>
<td><textarea cols="30" rows="4" name="disability_disc" placeholder="Write Discription..." value="<?php echo $disability_disc?>"></textarea></td>
    </tr>
   <tr>
  
</td>
</tr>
<tr>
 
    <td align="right" colspan="6">
	<button name="apply" onclick='return apbursary()'>Apply</button>
	</td>
	</tr>
  
    </table>
  

</form>
<?php
if(isset($_POST['apply']))

{
global $con;
global $user_id;
$residence=$_POST['residence'];
$subcounty=$_POST['subcounty'];
$ward=$_POST['ward'];
$village=$_POST['village'];
$father=$_POST['father'];
$mother=$_POST['mother'];
$father_op=$_POST['father_op'];
$mother_op=$_POST['mother_op'];
$gurdian_name=$_POST['gurdian_name'];
$gurdian_oc=$_POST['gurdian_occ'];
$gurdian_pho=$_POST['gurdian_pho'];
$father=$_POST['father'];
$mother=$_POST['mother'];
$parent=$_POST['parent_no'];
$status=$_POST['status'];
$disability=$_POST['disability'];
$disability_desc=$_POST['disability_disc'];
$id=$_POST['id_no'];
$id_photo=$_FILES['id_photo']['name'];
$image_tmp=$_FILES['id_photo']['tmp_name'];
move_uploaded_file($image_tmp,"user/id_photos/$id_photo");
$support_doc=$_FILES['document_photo']['name'];
$image_tmp=$_FILES['document_photo']['tmp_name'];
move_uploaded_file($image_tmp,"user/sup_document/$support_doc");


$get_sem="select * from transaction where user_id='$user_id'";
$run_sem=mysqli_query($con,$get_sem);
$check=mysqli_num_rows($run_sem);
if($check==0)
{
echo"<script> alert('Please Report First')</script>";
echo"<script>window.open('report.php','_self')</script>";
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
$get_re="select * from transaction where user_id='$user_id'  and semester !=''ORDER by 1 DESC LIMIT 1";
$run_re=mysqli_query($con,$get_re);
$row=mysqli_fetch_array($run_re);
$semester=$row['semester'];

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
$insert = "insert into county_bursary (county_name,reg_no,semester,academic_year,residence,subcounty,ward,village,father_name,mother_name,parent_no,father_occupation,
mother_occupation,gurdian_name,gurdian_occupation,gurdian_phone,parent_status,supporting_document,disability,
disability_disc,id_no,id_photo,commette_dec,status)
 values('$county','$reg_no','$semester','$year','$residence','$subcounty','$ward','$village','$father','$mother','$parent','$father_op','$mother_op','$gurdian_name','$gurdian_oc','$gurdian_pho','$status','$support_doc','$disability','$disability_desc','$id','$id_photo','unaproved','no')";
$run = mysqli_query($con,$insert);
if($insert){
echo"<script>alert('Information send Successfully.') </script>";}
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

