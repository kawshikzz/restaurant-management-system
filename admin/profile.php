<?php
	require_once('auth.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Profile</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
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
<table align="center">
<tr>
<form id="updateForm" name="updateForm" method="post" action="update-exec.php?id=<?php echo $_SESSION['SESS_ADMIN_ID'];?>" onsubmit="return updateValidate(this)">
<td>
  <table width="350" border="0" cellpadding="2" cellspacing="0">
<h3>CHANGE ADMIN PASSWORD</h3>

    <tr>
      <th width="124">Current Password <font color="#FF0000">* </font></th>
      <td width="168"><input name="opassword" type="password" class="form-control form-control-user" id="opassword" /></td>
    </tr>
    <tr>
      <th>New Password <font color="#FF0000">* </font></th>
      <td><input name="npassword" type="password" class="form-control form-control-user" id="npassword" /></td>
    </tr>
    <tr>
      <th>Confirm New Password <font color="#FF0000">* </font></th>
      <td><input name="cpassword" type="password" class="form-control form-control-user" id="cpassword" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Change" class="btn btn-primary btn-user" /></td>
    </tr>
  </table>
</td>
</form>

</form>
</tr>
</table>
<p>&nbsp;</p>
<hr>
</div>
<?php
  include 'footer.php';
?>
</div>
</body>
</html>
