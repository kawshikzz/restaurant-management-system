<?php require_once('connection/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo APP_NAME ?>:Registration Failed</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<!-- <script language="JavaScript" src="validation/user.js"> -->
</script>
</head>
<body>
<div id="page">
 
  <?php include 'header.php'; ?>

<div id="center">
<h1>Registration Failed!</h1>
  <div style="border:#5e2a04 solid 0px;padding:4px 6px 2px 6px">
<p>&nbsp;</p>

<p align="center">You are seeing this page because this table has been booked already. <a href="reservations.php">Click Here</a> to try again.</p>
</div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>