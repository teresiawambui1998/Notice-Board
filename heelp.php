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
  <h2 align="right">

  <button>Forgot Password ?</button></td>

<td><a href="index.php"role="button" data-toggle="modal">
<i class="icon-list-alt icon-large"></i>&nbsp;<strong>HOME</strong>
									<div class="pull-left">
														<i class="icon-double-angle-right icon-large"></i>
													</div> 
												</a></li></td></tr>
</table>
</div>

  </div>

  <div class="content">
  <img src="images/join.png"height="400"width="500" style="float:left;margin-left:-40px;">
   
	<fieldset ><legend align="center">HELP</legend>
	<li><strong>(1) NEW MEMBER  REGISTER BY FILLING THE REGISTER FORM  THEN LOGIN BY  EMAIL AND PASSWORD </li><BR />
    <li>(2) THATS IT FEEL FREE TO EXPLORE THE SYSTEM.</li></strong>
</fieldset>
    
      
      
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
