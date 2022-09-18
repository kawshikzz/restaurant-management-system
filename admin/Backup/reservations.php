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
	
	
//selecting all records from the reservations_details table based on table ids. Return an error if there are no records in the table
$tables=mysqli_query($conn,"SELECT members.firstname, members.lastname, reservations_details.ReservationID, reservations_details.table_id, reservations_details.Reserve_Date, reservations_details.Reserve_Time, tables.table_id, tables.table_name FROM members, reservations_details, tables WHERE members.member_id = reservations_details.member_id AND tables.table_id=reservations_details.table_id")
or die("There are no records to display ... \n" . mysqli_error()); 


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Reservations</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">

    <?php include 'header.php';?>

<h1>Reservations Management </h1>

</div>
<div id="container">

<table width="300">
	<h3>Reserve a Table</h3>
<tr>
		<td align="left">
			<div class="btn btn-primary"><a class="one" href="book_table.php"> Table Booking </a></div>
		</td>
	</tr>
</table>

<table border="0" width="900" align="center">
<h3>Reservation List</h3>
<tr>
<th>Reservation ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Table Name</th>
<th>Reserved Date</th>
<th>Reserved Time</th>
<th>Action(s)</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($tables)){
echo "<tr>";
echo "<td>" . $row['ReservationID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['table_name']."</td>";
echo "<td>" . $row['Reserve_Date']."</td>";
echo "<td>" . $row['Reserve_Time']."</td>";
echo '<td><a href="delete-reservation.php?id=' . $row['ReservationID'] . '">Delete Reservation</a></td>';
echo "</tr>";
}
mysqli_free_result($tables);
mysqli_close($conn);
?>
</table>
<hr>
</div>
<?php
	include 'footer.php';
?>
</div>
</body>
</html>