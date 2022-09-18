<?php
session_start();
//checking connection and connecting to a database
require_once('connection/config.php');
//Connect to mysqli server
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
  if(!$conn) {
    die('Failed to connect to server: ' . mysqli_error());
  }
if(!isset($_SESSION['Cook_login']) || (trim($_SESSION['Cook_login']) == '')) {
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cook Profile</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/cook_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">

    <?php include 'header.php';?>

<h1>Profile </h1>

</div>
<div id="container">
<div class="row g-3 align-items-center">
  <form action="cook-profile.php" method="POST">
  <div class="col-6">
    <label for="oldPassword" class="col-form-label"><h3>Current Password</h3></label>
    <input type="password" id="oldPassword" class="form-control" name="inold" required>
  </div>
  <div class="col-6">
    <label for="newPassword" class="col-form-label"><h3>New Password</h3></label>
    <input type="password" id="newPassword" class="form-control" name="innew" required>
  </div>
  <div class="col-6">
    <label for="conPassword" class="col-form-label"><h3>Confirm New Password</h3></label>
    <input type="password" id="conPassword" class="form-control" name="incon" required>
  </div>
  <p></p>
  <div class="col-6">
    <input type="submit" name="cngpwd" class="btn btn-primary" value="Change">
  </div>
  </form>
</div>

<?php
if(isset($_POST["cngpwd"]) && $_POST["cngpwd"]){
  $cid = $_SESSION['Cook_login'];
  $ppwd = $_POST["inold"];
  $npwd = $_POST["innew"];
  $cpwd = $_POST["incon"];
  $sql = "SELECT * FROM cafe_cook WHERE cook_id = '$cid' AND cook_pass = '$ppwd'";
  $res =  mysqli_query($conn, $sql);
  if(mysqli_num_rows($res)){
    if($npwd === $cpwd){
        $sqlup = "UPDATE cafe_cook SET cook_pass = '$cpwd' WHERE cook_id = '$cid'";
        mysqli_query($conn, $sqlup);
        echo "Successfully changed.";
    }else{
      echo "Password not matched!";
    }
  }else{
    echo "Wrong password!";
  }
}
  include 'footer.php';
?>
</div>
</body>
</html>
