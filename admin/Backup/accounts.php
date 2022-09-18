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
	
	
//selecting all records from the members table. Return an error if there are no records in the tables
$result=mysqli_query($conn,"SELECT * FROM members")
or die("There are no records to display ... \n" . mysqli_error()); 
?>
<!DOCTYPE html>
<html>
<head style="background-color: #ffffff">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Members</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>

<body style="background-color: #ffffff">
<div id="page">	
	<?php include 'header.php';?>
<div id="header">

<h1>Members Management </h1>

</div>
<div id="container">
<table border="0" width="620" align="center">

<tr>
<th>Member ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['member_id']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['login']."</td>";
echo '<td><a href="delete-member.php?id=' . $row['member_id'] . '">Remove Member</a></td>';
echo "</tr>";
}
mysqli_free_result($result);
mysqli_close($conn);
?>
</table>
<hr>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>