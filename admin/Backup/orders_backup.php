	<table width="300" align="right">
     <tr>
        <td>Filter by Year</td>
        <td width="150" align="right"><select name="year" id="year" class="btn btn-outline-dark dropdown-toggle">
        <option value="select">- select Year -
        <?php 
        //loop through categories table rows
        while ($row=mysqli_fetch_array($orders_details)){
        echo "<option value='{$row[delivery_date]}' ".($id == $row['delivery_date'] ? "selected" : "").">$row[delivery_date]</option>"; 
        }
        ?>
        
        </select></td>
        <td><input type="submit" name="Submit" value="Filter" class="btn btn-primary btn-user btn-block" /></td>
     </tr>
     </table>
<table border="0" width="970" align="center">
<h3>ORDERS LIST</h3>
<tr>

<th>Order ID</th>
<th>Customer Names</th>
<th>Food Name</th>
<th>Food Price</th>
<th>Quantity</th>
<th>Total Cost</th>
<th>Delivery Date</th>
<th>Delivery Address</th>
<th>Mobile No</th>
<th>Confirmation</th>
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
echo "<td>" . $row['firstname']."\t".$row['lastname']."</td>";
echo "<td>" . $res[$lt.'_name']."</td>";
echo "<td>" . $res[$lt.'_price']."</td>";
echo "<td>" . $row['quantity_value']."</td>";
echo "<td>" . $row['total']."</td>";
echo "<td>" . $row['delivery_date']."</td>";
echo "<td>" . $row['Street_Address']."</td>";
echo "<td>" . $row['Mobile_No']."</td>";
if($row['bill_info'] == "unpaid"){
echo '<td><a href="confirm-order.php?id=' . $row['order_id'] . '">unpaid</a></td>';
}else{
echo "<td>" . $row['bill_info'] . "</td>";
}
echo '<td><a href="delete-order.php?id=' . $row['order_id'] . '">Remove Order</a></td>';
echo "</tr>";
}
mysqli_free_result($result);
//mysqli_close($conn);
?>
</table>

<hr>