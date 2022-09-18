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
<title>Orders</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
<script src="js/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="js/datatables.min.js"></script>
</head>
<body>
<div id="page">
<div id="header">

    <?php include 'header.php';?>

<h1>Orders Management </h1>

</div>
<div id="container">
<table align="right">
<tr><td>
<form action="orders.php" method="POST">
      <select name="year" id="year" class="btn btn-outline-dark dropdown-toggle">
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2023">2024</option>
        <option value="2023">2025</option>
      </select>
      <input type="submit" name="filter" value="Filter" class="btn btn-primary btn-user btn-block" />
</form>
</td>
<td>
  <a href="orders.php" class="btn btn-outline-dark">Clear</a>
</td>
</tr></table>
<table id="alltables" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Food name</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Total price</th>
      <th>Order time</th>
      <th>Order date</th>
      <th>Delivery Status</th>
      <th>Payment</th>
      <th>Action(s)</th>
    </tr>
  </thead>
  <tobdy>
<?php
if(isset($_POST["filter"]) && $_POST["filter"]){
  $getyear = $_POST["year"];
  $sql = "SELECT * FROM orders WHERE filter_year = '$getyear'";
  $config = mysqli_query($conn, $sql);
  if(mysqli_num_rows($config) > 0){
    $i = 1;
    while($row = mysqli_fetch_assoc($config)){
  ?>
  <tr>
      <td><?= $i++ ?></td>
      <td><?= $row["item_name"] ?></td>
      <td><?= $row["quantity"] ?></td>
      <td><?= $row["item_price"] ?></td>
      <td><?= $row["total_price"] ?></td>
      <td><?= substr($row["date_time"],10) ?></td>
      <td><?= substr($row["date_time"],0, 10) ?></td>
      <?php
      if($row['delivery_status'] == 0){
        echo '<td><a href="cook-confirm-order.php?id=' . $row['id'] . '">Not Delivered</a></td>';
        }else{
        echo "<td>Delivered</td>";
        }
        ?>
      <?php
      if($row['payment_status'] == 0){
        echo '<td><a href="confirm-order.php?id=' . $row['id'] . '">unpaid</a></td>';
        }else{
        echo "<td>paid</td>";
        }
      ?>
      <td><a href="delete-order.php?id=<?= $row['id'] ?>">Remove Order</a></td>
    </tr>

  <?php
    }
  }else{
    //
  }  

}else{ 
$sql = "SELECT * FROM orders";
$config = mysqli_query($conn, $sql);
if(mysqli_num_rows($config) > 0){
  $i = 1;
  while($row = mysqli_fetch_assoc($config)){  
?>
    <tr>
      <td><?= $i++ ?></td>
      <td><?= $row["item_name"] ?></td>
      <td><?= $row["quantity"] ?></td>
      <td><?= $row["item_price"] ?></td>
      <td><?= $row["total_price"] ?></td>
      <td><?= substr($row["date_time"],10) ?></td>
      <td><?= substr($row["date_time"],0, 10) ?></td>
       <?php
      if($row['delivery_status'] == 0){
        echo '<td>Not Delivered</td>';
        }else{
        echo "<td>Delivered</td>";
        }
        ?>
      <?php
      if($row['payment_status'] == 0){
        echo '<td><a href="confirm-order.php?id=' . $row['id'] . '">unpaid</a></td>';
        }else{
        echo "<td>paid</td>";
        }
      ?>
      <td><a href="delete-order.php?id=<?= $row['id'] ?>">Remove Order</a></td>
    </tr>
<?php
  }
}else{
  echo "No result found!";
}
}
?>
  </tbody>
<!--   <tfoot>
    <tr>
      <th>#</th>
      <th>Food name</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Total price</th>
      <th>Order time</th>
      <th>Order date</th>
      <th>Payment</th>
      <th>Action(s)</th>
    </tr>
  </tfoot> -->
</table>


</div>
<?php
	include 'footer.php';
?>
</div>
<script src="js/script.js"></script>
</body>
</html>