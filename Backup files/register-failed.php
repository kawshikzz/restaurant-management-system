<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <?php include 'connection/config.php'; ?>
<title><?php echo APP_NAME ?>:Registration Failed</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="page">

  <?php include 'header.php'; ?>

<div id="center">
<h3>Registration Failed!</h3>
  <div style="border:#5e2a04 solid 0px;padding:4px 6px 2px 6px">
<p>&nbsp;</p>

<p>You are seeing this page because your attempt to create a new account has failed. You have used an email address that is already in use. <br> <a href="login-register.php">Try Again</a> Or <a href="JavaScript: resetPassword()">Reset Your Password.</a></p>
</div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>