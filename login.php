<?php
session_start();
require ('init.php');
?>
	
<!DOCTYPE html>
<html>
<head>

	<title>login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css"
		href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/loginstyle.css">
	<script src="assets/js/login.js"></script>
</head>

<body>
	<div class="login">
<div class="login_partCircle">
</div>
<div class="login_partsmcircle"></div>
</div>
<div class="container-fluid">
<div class="row">
<div class="col-lg-7 col-sm-12 image_hand"> 

	<img src="assets/images/logohand.png" class="img-fluid" style="opacity:.05;">
	
</div>
<div class="col-lg-5  col-sm-12">
<div class="login_box">
<div class="login_part">
<div class="loginInput">
	<center><img src="assets/images/gowebezlogo.png" class="img-fluid logo"></center>
		<img src="assets/images/logohand.png" class="img-fluid sm_image" style="opacity:.05;">
		<p align="center">LOGIN</p>
		<h5 align="center" class="login_error"><?php
if (isset($_SESSION['error_msg'])) {
 	$email_psw=$_SESSION['error_msg'];
 	echo  $email_psw;
 } 
  ?></h5>
	<form method="post" action="login_action_page.php" autocomplete="off">
<input type="email" placeholder="Email" id="email" name="email"
value="<?php if(isset($_COOKIE["eml"])) {echo $_COOKIE["eml"];} ?>" required>
<div id="email_error"></div>
<input type="password" placeholder="Password" name="password" id="password_value"  value="<?php if(isset($_COOKIE["pass"])) {echo $_COOKIE["pass"];} ?>" >

<i class="fa fa-eye-slash icon password_show" attrPassword="#password_value"></i>	
<div id="password_error"></div>

<input type="checkbox" name="remember_me" class="checkbox"
<?php if(isset($_COOKIE["pass"])) { ?> checked <?php }?>><span>Remember me</span>

<center><button id="submit" type="submit" name="submit">Submit</button></center>
</form>
</div> 
</div>
</div>


</div>

</div>



</div>

</body>

</html>
<?php
    unset($_SESSION["error_msg"]);
?>
