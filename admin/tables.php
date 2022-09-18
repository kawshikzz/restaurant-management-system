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
  
//retrieve tables from the tables table
$tables=mysqli_query($conn,"SELECT * FROM tables")
or die("Something is wrong ... \n" . mysqli_error());

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tables</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">

    <?php include 'header.php';?>

<h1>Tables </h1>

</div>
<div id="container">

<table align="center" width="910">
<h3>MANAGE TABLES</h3>
<tr>
<form name="tableForm" id="tableForm" action="tables-exec.php" method="post" onsubmit="return tablesValidate(this)">
<td>
  <table width="350" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Table Name/Number</td>
        <td><input type="text" name="name"  class="form-control form-control-user" /></td>
        <td><input type="submit" name="Insert" value="Add" class="btn btn-primary btn-user"  /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form name="tableForm" id="tableForm" action="delete-table.php" method="post" onsubmit="return tablesValidate(this)">
  <table width="350" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Table Name/Number</td>
        <td><select name="table" id="table" class="btn btn-outline-dark dropdown-toggle">
        <option value="select">- select table -
        <?php 
        //loop through tables table rows
        while ($row=mysqli_fetch_array($tables)){
        echo "<option value=$row[table_id]>$row[table_name]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Remove" class="btn btn-primary btn-user"  /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>


</div>
<?php
    include 'footer.php';
?>
</div>
</body>
</html>
