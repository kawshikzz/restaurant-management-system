<?php
	require_once('auth.php');
?>
<?php
//checking connection and connecting to a database
require_once('connection/config.php');
//Connect to mysqli server
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
    if(!$conn) {
        die('Failed to connect to server: ' . mysqli_error());
    }
    
    
//get member id from session
$memberId=$_SESSION['SESS_MEMBER_ID'];
?>
<?php
    //retrieving all rows from the cart_details table based on flag=0
    $flag_0 = 0;
    $items=mysqli_query($conn,"SELECT * FROM cart_details WHERE member_id='$memberId' AND flag='$flag_0'")
    or die("Something is wrong ... \n" . mysqli_error()); 
    //get the number of rows
    $num_items = mysqli_num_rows($items);
?>
<?php
    //retrieving all rows from the messages table
    $messages=mysqli_query($conn,"SELECT * FROM messages")
    or die("Something is wrong ... \n" . mysqli_error()); 
    //get the number of rows
    $num_messages = mysqli_num_rows($messages);
?>
<?php
    //retrieving all rows from the cart_details table based on flag=0
    $flag_0 = 0;
    $items=mysqli_query($conn,"SELECT * FROM cart_details WHERE member_id='$memberId' AND flag='$flag_0'")
    or die("Something is wrong ... \n" . mysqli_error()); 
    //get the number of rows
    $num_items = mysqli_num_rows($items);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo APP_NAME ?>:My Profile</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="page">

  <?php include 'header.php'; ?>

<div id="center">
<h4>My Profile</h4>

<hr>
<table width="870">
<tr>
<form id="updateForm" name="updateForm" method="post" action="update-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return updateValidate(this)">
<td>
  <table width="350" align="center" border="0" cellpadding="2" cellspacing="0">
  <h3>Change Password</h3>
<!-- 	<tr>
		<td colspan="2" style="text-align:center;">Required fields</td>
	</tr> -->
    <tr>
      <th width="124">Old Password</th>
      <td width="168"><input name="opassword" type="password" class="form-control form-control-user" id="opassword" /></td>
    </tr>
    <tr>
      <th>New Password</th>
      <td><input name="npassword" type="password" class="form-control form-control-user" id="npassword" /></td>
    </tr>
    <tr>
      <th>Confirm New Password </th>
      <td><input name="cpassword" type="password" class="form-control form-control-user" id="cpassword" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Change" class="btn btn-primary btn-user btn-block" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form id="billingForm" name="billingForm" method="post" action="address-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return billingValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <h3>Add Delivery Address</h3>
<!-- 	<tr>
		<td colspan="2" style="text-align:center;">Required fields</td>
	</tr> -->
    <tr>
      <th>Street Address </th>
      <td><input name="sAddress" type="text" class="form-control form-control-user" id="sAddress" /></td>
    </tr>
	<tr>
      <th>P.O. Box No </th>
      <td><input name="box" type="text" class="form-control form-control-user" id="box" /></td>
    </tr>
    <tr>
      <th>City </th>
      <td><input name="city" type="text" class="form-control form-control-user" id="city" /></td>
    </tr>
    <tr>
      <th width="124">Mobile No</th>
      <td width="168"><input name="mNumber" type="text" class="form-control form-control-user" id="mNumber" /></td>
    </tr>
    <tr>
      <th>Landline No</th>
      <td><input name="lNumber" type="text" class="form-control form-control-user" id="lNumber" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Add" class="btn btn-primary btn-user btn-block" /></td>
    </tr>
  </table>
</td>
</form>
</tr>
</table>

<table border="0" width="350" align="center">
<tr><h3>User Info</h3></tr>
<tr>
  <th width="150">Full Name</th>
  <td>Kawshik Ghosh</td>
</tr>
<tr>
  <th>Email</th>
  <td>kawshikghosh@email.com</td>
</tr>
<tr>
  <th>Address</th>
  <td>Mirpur2, Dhaka</td>
</tr>
<tr>
  <th>Mobile</th>
  <td>0123654789</td>
</tr>
<tr>
  <th>Telephone</th>
  <td>+802154</td>
</tr>

</table>
<p>&nbsp;</p>



</div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>