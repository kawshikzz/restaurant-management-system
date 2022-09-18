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
  
  
//selecting all records from almost all tables. Return an error if there are no records in the tables
$result=mysqli_query($conn,"SELECT * FROM orders_details o inner join cart_details c on c.cart_id = o.cart_id inner join quantities q on q.quantity_id = c.quantity_id inner join members m on m.member_id = c.member_id inner join address_details a on a.address_id = o.address_id ") or die("There are no records to display ... \n" . mysqli_error()); 

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Orders</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/cook_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">

    <?php include 'header.php';?>

<h1>Orders Management </h1>

</div>
<div id="container">
  
<table border="0" width="970" align="center">
<h3>ORDERS LIST</h3>
<tr>

<th>Order ID</th>
<!-- <th>Customer Names</th> -->
<th>Food Name</th>
<th>Food Price</th>
<th>Quantity</th>
<!-- <th>Total Cost</th> -->
<th>Delivery Date</th>
<!-- <th>Delivery Address</th>
<th>Mobile No</th>
<th>Confirmation</th> -->
<th>Actions(s)</th>
</tr>

<?php
//loop through all tables rows
while ($row=mysqli_fetch_assoc($result)){
  $lt = $row['lt'];
  if($lt =='food'){
    $qry = "SELECT * FROM food_details f inner join categories c on c.category_id = f.food_category where food_id = {$row['food_id']}";
  }else{
    $qry = "SELECT * FROM specials where special_id = {$row['food_id']}";
  }
  // echo $qry.'\n';
  $res = mysqli_fetch_array(mysqli_query($conn,$qry));
echo "<tr>";
echo "<td>" . $row['order_id']."</td>";
// echo "<td>" . $row['firstname']."\t".$row['lastname']."</td>";
echo "<td>" . $res[$lt.'_name']."</td>";
echo "<td>" . $res[$lt.'_price']."</td>";
echo "<td>" . $row['quantity_value']."</td>";
// echo "<td>" . $row['total']."</td>";
echo "<td>" . $row['delivery_date']."</td>";
// echo "<td>" . $row['Street_Address']."</td>";
// echo "<td>" . $row['Mobile_No']."</td>";
// if($row['bill_info'] == "unpaid"){
// echo '<td><a href="confirm-order.php?id=' . $row['order_id'] . '">unpaid</a></td>';
// }else{
// echo "<td>" . $row['bill_info'] . "</td>";
// }
echo '<td><a href="cook-delete-order.php?id=' . $row['order_id'] . '">Remove Order</a></td>';
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