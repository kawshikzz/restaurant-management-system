<?php require_once('connection/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <?php include 'connection/config.php'; ?>
<title><?php echo APP_NAME ?>:Login Failed</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
 
<!--   <?php include 'header.php'; ?>
 -->
<div id="center">
  <img src="images/bistro.png" alt="logo" height="25" width="25" class="center" style="padding: 0 0 10px 0">
  <h3>Login Failed!</h3>
  <div style="border:#bd6f2f solid 0px;padding:4px 6px 2px 6px">
<p>&nbsp;</p>

  <p>Please check your email and password. <a href="index.php">Click Here</a> to try again.</p>
  </div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>