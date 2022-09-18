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
    
    //Select database
   
//selecting all records from the messages table. Return an error if there is a problem
$result=mysqli_query($conn,"SELECT * FROM messages")
or die("There are no records to display ... \n" . mysqli_error()); 
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Messages</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
  
    <?php include 'header.php';?>

<h1>Messages Management </h1>

</div>
<div id="container">
<form id="messageForm" name="messageForm" method="post" action="message-exec.php" onsubmit="return messageValidate(this)">
  <table width="540" border="0" cellpadding="2" cellspacing="0" align="center">
  <h3>SEND A MESSAGE</h3>
    <tr>
      <th width="200">Subject</th>
      <td width="168"><input type="text" name="subject" id="subject" class="form-control form-control-user" /></td>
    </tr>
    <tr>
      <th width="200">Message Box</th>
      <td width="168"><textarea name="txtmessage" class="form-control form-control-user" rows="5" cols="60"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><input type="submit" name="Submit" value="Send Message" class="btn btn-primary btn-user" />
	  <input type="reset" name="Reset" value="Clear Field" class="btn btn-outline-dark" /></td>
    </tr>
  </table>
</form>
<hr>
<table border="0" width="1000" align="center">
<h3>SENT MESSAGES</h3>
<tr>
<th>Message ID</th>
<th>Date Sent</th>
<th>Time Sent</th>
<th>Message Subject</th>
<th>Message Text</th>
<th>Action(s)</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['message_id']."</td>";
echo "<td>" . $row['message_date']."</td>";
echo "<td>" . $row['message_time']."</td>";
echo "<td>" . $row['message_subject']."</td>";
echo "<td width='300' align='left'>" . $row['message_text']."</td>";
echo '<td><a href="delete-message.php?id=' . $row['message_id'] . '">Remove Message</a></td>';
echo "</tr>";
}
mysqli_free_result($result);
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