<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_ADMIN_ID']);
	unset($_SESSION['SESS_ADMIN_NAME']);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Logged Out</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Logout </h1>
<p align="center">&nbsp;</p>
</div>
<h4 align="center" class="err">You have been logged out.</h4>

<div align="center">
	<div class="col-lg-6">
<p align="center" class="btn btn-primary btn-user btn-block"><a class="navbar-nav ms-auto one" href="login-form.php">Click Here to Login</a></p>
</div>
</div>
<?php
	include 'footer.php';
?>
</div>
</body>
</html>
