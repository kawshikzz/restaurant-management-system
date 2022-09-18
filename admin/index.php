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
	
    
    //define default value for flag
    $flag_1 = 1;
    
    //defining global variables
    $qry="";
    $excellent_qry="";
    $good_qry="";
    $average_qry="";
    $bad_qry="";
    $worse_qry="";
    
//count the number of records in the orders, tables, food_details and staff tables

$orders=mysqli_query($conn,"SELECT * FROM orders")
or die("There are no records to count ... \n" . mysqli_error());


$tables=mysqli_query($conn,"SELECT * FROM tables")
or die("There are no records to count ... \n" . mysqli_error());


$menu=mysqli_query($conn,"SELECT * FROM food_details")
or die("There are no records to count ... \n" . mysqli_error());


$staff=mysqli_query($conn,"SELECT * FROM staff")
or die("There are no records to count ... \n" . mysqli_error());

//get food names and ids from food_details table
$foods=mysqli_query($conn,"SELECT * FROM food_details")
or die("Something is wrong ... \n" . mysqli_error());
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin Index</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />

<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">

    <?php include 'header.php';?>

<h1>Overview</h1>


</div>
<div id="container">
<table width="1000" align="center" style="text-align:center">


<?php
        
        $result1=mysqli_num_rows($orders); //total orders
        $result2=mysqli_num_rows($menu); //total menu items
        $result3=mysqli_num_rows($tables); //total tables
        $result4=mysqli_num_rows($staff); //total staffs
  
?>
<div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <a href="orders.php">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success mb-1">Order Placed</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $result1 ?></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <a href="foods.php">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success mb-1">Total Menu Items</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $result2 ?></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <a href="booking.php">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success mb-1">Total Tables</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $result3 ?></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <a href="staff.php">    
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success mb-1">Total Staffs</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $result4 ?></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

</div>




</table>

</div>
<?php include 'footer.php'; ?>
</div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
