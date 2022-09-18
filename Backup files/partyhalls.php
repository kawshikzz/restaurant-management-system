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
    //retrieve partyhalls from the partyhalls table
    $partyhalls=mysqli_query($conn,"SELECT * FROM partyhalls")
    or die("Something is wrong ... \n" . mysqli_error());
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo APP_NAME ?>:Party Halls</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="page">

  <?php include 'header.php'; ?>

<div id="center">
<h4>Reserve Party Hall(s)</h4>

<hr>
<form name="partyhallForm" id="partyhallForm" method="post" action="reserve-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return partyhallValidate(this)">
    <table align="center" width="320">
        <h3>Reserve A Partyhall</h3>
        <tr>
            <td><b>PartyHall Name/Number:</b></td>
            <td>
            <select name="partyhall" id="partyhall" class="btn btn-outline-dark dropdown-toggle">
            <option value="select"> select partyhall </option>
            <?php 
            //loop through partyhalls table rows
            while ($row=mysqli_fetch_array($partyhalls)){
            echo "<option value=$row[partyhall_id]>$row[partyhall_name]</option>"; 
            }
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td><b>Date:</b></td><td><input type="date" placeholder="yyyy-mm-dd" name="date" id="date" class="btn btn-outline-dark" /></td></tr>
        <tr>
            <td><b>Time:</b></td><td><input type="time" name="time" id="time" class="btn btn-outline-dark" />
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right"><input type="submit" value="Reserve" class="btn btn-primary btn-user"></td>
        </tr>
    </table>
</form>
</div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>