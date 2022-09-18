<?php
//checking connection and connecting to a database
require_once('connection/config.php');
error_reporting(1);
//Connect to mysqli server
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
    if(!$conn) {
        die('Failed to connect to server: ' . mysqli_error());
    }
    
  
    
//retrieve questions from the questions table
$questions=mysqli_query($conn,"SELECT * FROM questions")
or die("Something is wrong ... \n" . mysqli_error());
?>
<?php
//setting-up a remember me cookie
    if (isset($_POST['Submit'])){
        //setting up a remember me cookie
        if($_POST['remember']) {
            $year = time() + 31536000;
            setcookie('remember_me', $_POST['login'], $year);
        }
        else if(!$_POST['remember']) {
            if(isset($_COOKIE['remember_me'])) {
                $past = time() - 100;
                setcookie(remember_me, gone, $past);
            }
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo APP_NAME; ?>:Home</title>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/user_styles.css"  rel="stylesheet" type="text/css">


<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="page">

 <!--  <?php include 'header.php'; ?> -->

<div id="center">
  <img src="images/bistro.png" alt="logo" height="25" width="25" class="center" style="padding:0 0 10px 0">
  <h3><center>Welcome To Cafe Bistro Management System!</center></h3>

<table align="center" width="100%">
    <tr align="center">
        <td style="text-align:center;">
            <div style="border:#5e2a04 solid 0px;padding:4px 6px 2px 6px">
            <form id="loginForm" name="loginForm" method="post" action="login-exec.php" onsubmit="return loginValidate(this)">
              <table width="290" border="0" align="center" cellpadding="2" cellspacing="0">
                <!--<tr>
                    <td colspan="2" style="text-align:center;"><font color="#5e2a04">* </font>Required fields</td>
                </tr>-->
                <tr><h3>Login</h3></tr> &nbsp;
                <tr>
                  <div class="form-group">
                                            <input name="login" type="text" class="form-control form-control-user" id="login" placeholder="Email Address" />
                                        </div>
                </tr>
                <tr>
                  <div class="form-group my-1">
                                            <input name="password" type="password" class="form-control form-control-user" id="password" placeholder="Password" />
                                        </div>
                </tr>
                <tr>
                      <td><input name="remember" type="checkbox" class="" id="remember" value="1" onselect="cookie()" <?php if(isset($_COOKIE['remember_me'])) {
                        echo 'checked="checked"';
                    }
                    else {
                        echo '';
                    }
                    ?>/>Remember me</td>
                      <td><a href="JavaScript: resetPassword()">Forgot password?</a></td>
                </tr>
                <tr>
                    <td><input type="reset" value="Clear Fields" class="btn btn-outline-dark" />
                  <td><input type="submit" name="Submit" class="btn btn-primary btn-user btn-block" value="Login" /></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
              </table>
            </form>
            </div>
        </td>
        <hr>
        <td style="text-align:center;">
            <div style="border:#5e2a04 solid 0px;padding:4px 6px 2px 6px;">
            <form id="loginForm" name="loginForm" method="post" action="register-exec.php" onsubmit="return registerValidate(this)">
              <table width="450" border="0" align="center" cellpadding="2" cellspacing="0">
                <!--<tr>
                    <td colspan="2" style="text-align:center;"><font color="#5e2a04">* </font>Required fields</td>
                </tr>-->
                <tr><h3>Register</h3></tr> &nbsp;
                <tr>
                <tr>
                  <th>First Name </th>
                  <td><input name="fname" type="text" class="form-control form-control-user" id="fname" /></td>
                </tr>
                <tr>
                  <th>Last Name </th>
                  <td><input name="lname" type="text" class="form-control form-control-user" id="lname" /></td>
                </tr>
                <tr>
                  <th width="124">Email</th>
                  <td width="168"><input name="login" type="text" class="form-control form-control-user" id="login" /></td>
                </tr>
                <tr>
                  <th>Password</th>
                  <td><input name="password" type="password" class="form-control form-control-user" id="password" /></td>
                </tr>
                <tr>
                  <th>Confirm Password </th>
                  <td><input name="cpassword" type="password" class="form-control form-control-user" id="cpassword" /></td>
                </tr>
                <tr>
                  <th>Security Question </th>
                    <td><select name="question" id="question" class="form-control">
                    <option value="select">- select question -
                    <?php 
                    //loop through quantities table rows
                    while ($row=mysqli_fetch_array($questions)){
                    echo "<option value=$row[question_id]>$row[question_text]"; 
                    }
                    ?>
                    </select></td>
                </tr>
                <tr>
                  <th>Security Answer</th>
                  <td><input name="answer" type="text" class="form-control form-control-user" id="answer" /></td>
                </tr>
                <tr>
                <td><input type="reset" value="Clear Fields" class="btn btn-outline-dark" />
                <td><input type="submit" name="Submit" class="btn btn-primary btn-user btn-block" value="Register" /></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
              </table>
            </form>
            </div>
        </td>
    </tr>
</table>
<hr>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>
