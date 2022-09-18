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

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Staff</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
<script src="js/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="js/datatables.min.js"></script>
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Staff Management </h1>
<?php include 'header.php';?>
</div>
<div id="container">
<table align="center">
<tr>
<h3>ADD NEW STAFF</h3>
<td>
<form id="staffForm" name="staffForm" method="post" action="staff-exec.php">
  <table width="500" border="0" align="center" cellpadding="2" cellspacing="0"> 
    
    <tr>
      <th>First Name <font color="#FF0000">* </font></th>
      <td><input name="fName" type="text" class="form-control form-control-user" id="fName" required></td>
    </tr>
  <tr>
      <th>Last Name <font color="#FF0000">* </font></th>
      <td><input name="lName" type="text" class="form-control form-control-user" id="lName" required></td>
    </tr>
  <tr>
      <th>Job Title <font color="#FF0000">* </font></th>
      <td><input name="role" type="text" class="form-control form-control-user" id="role" required></td>
  </tr>
   <tr>
      <th>Street Address <font color="#FF0000">* </font></th>
      <td><input name="sAddress" type="text" class="form-control form-control-user" id="sAddress" required></td>
    </tr>
    <tr>
      <th>Mobile/Tel <font color="#FF0000">* </font></th>
      <td><input name="mobile" type="text" class="form-control form-control-user" id="mobile" required></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Add Staff" class="btn btn-primary btn-user btn-block" /></td>
    </tr>
  </table>
</td>
</form>



<table id="alltables" class="table table-striped table-hover">
<h3>STAFF LIST</h3>
<tr>
<th>#</th>
<th>Role</th>
<th>First Name</th>
<th>Last Name</th>
<th>Street Address</th>
<th>Mobile/Tel</th>
<th>Action</th>
</tr>

<?php 
$i = 1;
$sql = "SELECT * FROM staff";
$staff=mysqli_query($conn, $sql);
if(mysqli_num_rows($staff) > 0){
while ($row=mysqli_fetch_assoc($staff)){
?>

<tr>
<th scope="row"><?= $i++ ?></th>
<td><?= $row["staff_role"] ?></td>
<td><?= $row['firstname'] ?></td>
<td><?= $row['lastname'] ?></td>
<td><?= $row['Street_Address'] ?></td>
<td><?= $row['Mobile_Tel'] ?></td>
<td><a href="delete-staff.php?id=<?= $row["StaffID"] ?>">Remove Staff</a></td>

<?php 
  } 
?>
</tr>
<?php
}
mysqli_free_result($staff);
mysqli_close($conn);
?>

<?php
  require_once('auth.php');
?>


</div>
</tr>
</table>
<p>&nbsp;</p>

</div>
<?php include 'footer.php'; ?>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>