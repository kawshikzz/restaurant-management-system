<?php
//checking connection and connecting to a database
require_once('connection/config.php');
//Connect to mysqli server
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
	if(!$conn) {
		die('Failed to connect to server: ' . mysqli_error());
	}
	
	
//retrive promotions from the specials table
$result=mysqli_query($conn,"SELECT * FROM specials")
or die("There are no records to display ... \n" . mysqli_error()); 
?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=mysqli_query($conn,"SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo APP_NAME; ?>:Specials</title>
<script type="text/javascript" src="swf/swfobject.js"></script>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="page">



<div id="center">
  <?php include 'header.php'; ?>
  <h4>Special Offers</h4>
  <hr>
  <h6 align="center">Check out our special deals below. These are for a limited time only. Make your decision now.</h6>

  <div style="border:#5e2a04 solid 0px;padding:4px 6px 2px 6px">
<table width="850" align="center">
<h3>Special Offers</h3>
        <tr>
                <th>Promo Photo</th>
                <th>Promo Name</th>
                <th>Promo Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Promo Price</th>
        </tr>
        <?php
                $symbol=mysqli_fetch_assoc($currencies); //gets active currency
                while ($row=mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo '<td><a href=images/'. $row['special_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $row['special_photo']. ' width="80" height="70"></a></td>';
                    echo "<td>" . $row['special_name']."</td>";
                    echo "<td width='250' align='left'>" . $row['special_description']."</td>";
                    echo "<td>" . $row['special_start_date']."</td>";
                    echo "<td>" . $row['special_end_date']."</td>";
                    echo "<td>" . $symbol['currency_symbol']. "" . $row['special_price']."</td>";
                    echo "</td>";
                    echo "</tr>";
                    }
            mysqli_free_result($result);
            mysqli_close($conn);
?>
</table>
  </div>
</div>
<?php include 'footer.php'; ?>
</div>

</body>
</html>
