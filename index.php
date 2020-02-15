<?php
 include("functions/functions.php");
error_reporting(0);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Integrated Tertiary finance system </title>
<meta name="description" content="KIBU NOTICE Manager" />
	<meta name="author" content="Codrops" />
<link rel="shortcut icon" href="../favicon.ico"> 
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<link rel="stylesheet" type="text/css" href="css/style3.css" />
<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
<link rel="stylesheet" type="text/css" href="../vendors/fullcaledar.print.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/coin-slider.css" />

<script type="text/javascript">  
function validate()
{
      if(form2.account_no.length<10) {
          alert("Error: Input is empty!");
          form2.account_no.focus();
          return false;
        }
}
</script>
<script type="text/javascript">

  function checkForm(form)
  {
    if(sign.f_name.value == "") {
      alert("Error: First_Name cannot be blank!");
      sign.f_name.focus();
      return false;
    }
    re = /^\w+$/;
    if(!re.test(sign.f_name.value)) {
      alert("Error: First_Name must contain only letters, numbers and underscores!");
      sign.f_name.focus();
      return false;
    }
	
    if(sign.lname.value == "") {
      alert("Error: Surname cannot be blank!");
      sign.lname.focus();
      return false;
    }
	re = /^\w+$/;
    if(!re.test(sign.lname.value)) {
      alert("Error: Surname must contain only letters, numbers and underscores!");
      sign.lname.focus();
      return false;
    }
	if(sign.reg_no.value == "") {
      alert("Error: reg_no cannot be blank!");
      sign.reg_no.focus();
      return false;
    }
    re = ^\w+$/;
    if(!re.test(sign.reg_no.value)) {
      alert("Error: reg_no must contain only letters, numbers and underscores!");
      sign.reg_no.focus();
      return false;
    }
	
   
	 

    if(sign.password.value != "" && sign.password.value == sign.confirm_pass.value) {
      if(sign.password.value.length < 6) {
        alert("Error: Password must contain at least six characters!");
        sign.password.focus();
        return false;
      }
      if(sign.password.value == sign.f_name.value) {
        alert("Error: Password must be different from Username!");
        sign.password.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(sign.password.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        sign.password.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(sign.password.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        sign.password.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(sign.password.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        sign.password.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      sign.password.focus();
      return false;
    }

    alert("You entered a valid password: " + sign.password.value);
    return true;
  }

</script>
</div>
<div class="header">
  <img src="images/kevo.PNG"style="float:left; padding:5px;" height="100" width="100" />
<form id="form1" name="form1" method="post" action="">

  <table align="right" width="100%">
  <tr><td><strong>Email:</strong><input type="email" name="email"  placeholder="Email" required="required"/></td>
 
  <td><strong>Password:</strong><input type="password" name="pass" placeholder="*****" required="required" /></td></tr>
  <tr><td><b>Login:</b><button name="login" >Login</button></td></tr>
  </label>
  </table>
 
</form>
    <div class="header_resize">
      
      <div class="logo">
        <h1>Tertiary Finance System </h1>
      </div>
      <div class="clr"></div>

	  
<div id="form2">

<table align="right" ><tr><td><a href="forgotpass.php">
  <h2 align="center">

  <button>Forgot Password ?</button></td>

<td><a href="heelp.php"role="button" data-toggle="modal">
<i class="icon-list-alt icon-large"></i>&nbsp;<strong>HELP</strong>
									<div class="pull-right">
														<i class="icon-double-angle-right icon-large"></i>
													</div> 
												</a></li></td></tr>
</table>
<form action="" method="Post" name="sign" id="sign" ... onsubmit="return checkForm(this);">
<h2 align="left"> <strong>New Student Register HERE</strong></h2>
<table >
 <tr>
         <td align="right">First_Name:</td>
    <td><Input type="text" name="f_name" placeholder="Enter Your first_name." onkeypress="validate()"/></td>
     </tr>
   <tr>
    <tr>
         <td align="right">Last_name:</td>
         <td><Input type="text" name="lname" placeholder="Enter Your surname."  /></td>
     </tr>
   <tr>
    <td align="right" required="required">Gender:</td>
    <td><select name="gender"  >
	<option value="-1 Selected">Select Gender	</option>
	<option>Male </option>
	<option>Female</option>
	</select>
	</td>
   </tr>
	 <tr>
    <td align="right">RegNo:</td>
    <td><Input type="text" name="reg_no" placeholder="Enter Your reg_no."required="required"  /></td>
    </tr>
	 <tr>
    <td align="right">Email:</td>
    <td><Input type="email" name="email" placeholder="Enter Your Mail."required="required"  /></td>
    </tr>
	 <tr>
    <td align="right" required="required">County:</td>
    <td><select name="u_country">
	<option value="-1 Selected">
	select county
	</option>
	
	<?php global $con;
$get_sem="select * from counties ORDER BY county_name ASC";
$run_sem=mysqli_query($con,$get_sem);
while($row=mysqli_fetch_array($run_sem))

{

$sem=$row['county_name'];

echo"<option>$sem</option>";

} ?></option>
	
	</select>
	</td>
   </tr>
    <tr>
    <td align="right">Birthday:</td>
    <td><Input type="date" name="u_birthday" /></td>
    </tr>
	 <tr>
    <td align="right">Password:</td>
    <td><Input type="password" name="password" placeholder="Enter password minimum 8 characters"required="required"  /></td>
    </tr>
	 <tr>
    <td align="right"> Confirm Password:</td>
    <td><Input type="password" name="confirm_pass" placeholder="confirm  password "required="required"  /></td>
    </tr>
	
   
  
 
    <td align="right" colspan="6">
	<button name="sign_up" onclick="validate()">Sign Up</button></td>
  </tr> </table>


</form>

</div>

  </div>

  <div class="content">
  <img src="images/join.png"height="400"width="500" style="float:left;margin-left:-40px;">
    <div class="content_resize">
	<fieldset><legend align="center"><strong>THE SYSTEM FACILITATES FEES PAYMENT USING TOKENS</strong></legend></fieldset>
	
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
      <p class="rf">Design by <a target="_blank" href="http://www.manicure.com/">administrator </a></p>
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
<?php
include("help.php");
?>
