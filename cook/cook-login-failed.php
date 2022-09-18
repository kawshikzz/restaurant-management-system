<?php
	require_once('connection/config.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Failed</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/cook_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Login Failed </h1>
<p align="center">&nbsp;</p>
</div>
<h4 align="center" class="err">Login Failed!</h4>
<p align="center">Please check your username and password and <a href="index.php" style="text-decoration: underline;">Try Again</a></p>
<?php include 'footer.php'; ?>
</div>
</body>
</html>
