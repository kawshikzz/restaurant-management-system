<?php
session_start();
ob_start();
//error_reporting(0);
  require_once('connection/config.php');
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
    if(!$conn) {
        die('Failed to connect to server: ' . mysqli_error());
    }
    if(!isset($_SESSION['Cook_login']) || (trim($_SESSION['Cook_login']) == '')) {
        //header("location: index.php");




?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cook Login Form</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/cook_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>

<div id="page">
<div id="header">
<p align="center">&nbsp;</p>
</div>
<?php
if(isset($_POST["btnlog"]) && $_POST["btnlog"]){
    $getuser = $_POST["login"];
    $getpass = $_POST["password"];
    $sql = "SELECT * FROM cafe_cook WHERE cook_user = '$getuser' AND cook_pass = '$getpass'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);   
    if(mysqli_num_rows($res) > 0){
        $_SESSION['Cook_login'] = $row["cook_id"];
        header("Location:cook-orders.php");
    }else{
        header("Location:cook-login-failed.php");
        // $msg = "Wrong Username or Password!";
    }
}
?>
<form id="loginForm" name="loginForm" method="post" action="index.php">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="logo_cafe">Cafe Bistro</div>

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"><img src="../images/alt1a.png" alt="logo" width="400" height="300"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-base-900 mb-4">Cook Login</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group my-1">
                                            <input name="login" type="text" class="form-control form-control-user" id="login" placeholder="Username" />
                                        </div>
                                        <div class="form-group my-1">
                                            <input name="password" type="password" class="form-control form-control-user" id="password" placeholder="Password" />
                                        </div>
                                        <div class="form-group my-1">
                                            <span><?= $msg ?? "" ?></span>
                                        </div>
                                        
                                        <div class="d-grid gap-2 col-12 mx-auto">
                                            <input type="submit" name="btnlog" class="btn btn-primary" value="Login" />
                                        </div>
                                        <hr>
                                        <div class="d-grid gap-2 d-md-block">
                                            <p align="right">
                                                <button class="btn btn-primary btn-user" type="button"><a class="one" href="../index.php"> Back</a></button>
                                            </p>
                                        </div>
                                    </form>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </table>
</form>
<?php include 'footer.php'; ?>
</div>
</body>
</html>
<?php 
    }else{
        header("location: cook-orders.php");
    }
ob_end_flush(); 
?>
