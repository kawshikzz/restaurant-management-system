<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cafe Bistro:Logged Out</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
 

<!-- <div id="header">

		<nav class="navbar navbar-expand-lg navbar-light  bg-light fixed-top" id="mainNav">
            <div class="container px-4">
                <a class="navbar-brand" href="foodzone.php">Cafe Bistro</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="foodzone.php">Food Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="member-index.php">My Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="tables.php">Book Table</a></li>
                        <li class="nav-item"><a class="nav-link" href="partyhalls.php">Book Hall</a></li>
                        <li class="nav-item"><a class="nav-link" href="inbox.php">Inbox</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                        <li class="nav-item"><a class="nav-link" href="contactus.php">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="member-profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>

                    </ul>
                </div>
            </div>
        </nav>
</div> -->

  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
  <div id="company_name">Cafe Bistro</div>
</div>
<div id="center">
<h3>Logged Out </h3>
  <div style="border:#5e2a04 solid 0px;padding:4px 6px 2px 6px">
<p>&nbsp;</p>

<p><a href="login-register.php">Click Here</a> to Login again</p>
</div>
</div>
<div id="footer">
    <div class="bottom_menu"><a href="index.php">Home Page</a>  |  <a href="aboutus.php">About Us</a>  |  <a href="foodzone.php">Food Menu</a>  |  <br>
  | <a href="admin/admin/login-form.php" target="_blank">Administrator</a> |  <a href="cook/index.php" target="_blank">Cook</a> |</div>
  
  <div class="bottom_addr">&copy; 2022 Cafe Bistro. All Rights Reserved</div>
</div>
</div>
</body>
</html>
