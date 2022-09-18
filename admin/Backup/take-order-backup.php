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
	
	

//selecting all records from the food_details table. Return an error if there are no records in the table
$result=mysqli_query($conn,"SELECT * FROM food_details,categories WHERE food_details.food_category=categories.category_id ")
or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<?php
    //retrive categories from the categories table
    $categories=mysqli_query($conn,"SELECT * FROM categories")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=mysqli_query($conn,"SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<?php
    if(isset($_POST['Submit'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
          global $conn;
            $str = @trim($str);
            if(get_magic_quotes_gpc()) {
               $str = stripslashes($str);
            }
            return mysqli_real_escape_string($conn,$str);
        }
        //get category id
        $id = clean($_POST['category']);
        
        //selecting all records from the food_details and categories tables based on category id. Return an error if there are no records in the table
        if($id > 0){
        $result=mysqli_query($conn,"SELECT * FROM food_details,categories WHERE food_category='$id' AND food_details.food_category=categories.category_id ")
        or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
      }elseif($id == 0){
        $result=mysqli_query($conn,"SELECT * FROM specials WHERE '".date('Y-m-d')."' BETWEEN date(special_start_date) and date(special_end_date) ")
        or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
      }
    }

?> 


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Take Orders</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">

    <?php include 'header.php';?>

<h1>Take New Orders </h1>
 <h6 align="center">Note: Filter the food zone by selecting a category below:</h6>
 <form name="categoryForm" id="categoryForm" method="post" action="foodzone.php" onsubmit="return categoriesValidate(this)">
     <table width="360" align="right">
     <tr>
        <td>Category</td>
        <td width="168"><select name="category" id="category" class="btn btn-outline-dark dropdown-toggle">
        <option value="select"> select category 
        <?php 
        //loop through categories table rows
        while ($row=mysqli_fetch_array($categories)){
        echo "<option value='{$row[category_id]}' ".($id == $row['category_id'] ? "selected" : "").">$row[category_name]</option>"; 
        }
        ?>
        <!--<option value="0" <?php echo isset($id) &&  $id == 0 ? "selected" : "" ?>>Special Deals</option> -->
        </select></td>
        <td><input type="submit" name="Submit" value="Show Foods" class="btn btn-primary btn-user" /></td>
     </tr>
     </table>
 </form>
  <div style="border:#5e2a04 solid 0px;padding:4px 6px 2px 6px">
      <table width="860" height="auto" style="text-align:center;">
        <tr>
                <th>Food Photo</th>
                <th>Food Name</th>
                <th>Food Description</th>
                <th>Food Category</th>
                <th>Food Price</th>
                <th>Quantities</th>
                <th>Action(s)</th>
        </tr>
        <?php
            $count = mysqli_num_rows($result);
            if(isset($_POST['Submit']) && $count < 1){
                echo "<html><script language='JavaScript'>alert('There are no foods under the selected category at the moment. Please check back later.')</script></html>";
            }
            else{
                //loop through all table rows
                //$counter = 3;
                $symbol=mysqli_fetch_assoc($currencies); //gets active currency
                if(isset($id) && $id == 0)
                  $lt = "special";
                else
                  $lt = "food";
                while ($row=mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo '<td><a href=../images/'. $row[$lt.'_photo']. ' alt="click to view full image" target="_blank"><img src=../images/'. $row[$lt.'_photo']. ' width="80" height="80"></a></td>';
                    echo "<td>" . $row[$lt.'_name']."</td>";
                    echo "<td>" . $row[$lt.'_description']."</td>";
                    echo "<td>" . ($lt == 'food'?$row['category_name']:'SPECIAL DEALS')."</td>";
                    echo "<td>" . $symbol['currency_symbol']. "" . $row[$lt.'_price']."</td>";
                    echo "<td><select class='form-select' name='quan' aria-label='Select quan'>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                            <option value='3'>3</option>
                          </select></td>";
                    echo '<td><a href="take-order.php?id=' . $row[$lt.'_id'] . '&lt='.$lt.'">Place Order</a></td>';
                    echo "</td>";
                    echo "</tr>";
                    }      
                }
            mysqli_free_result($result);
            //mysqli_close($conn);
        ?>
      </table>
  </div>
</div>
<?php
  
if(isset($_GET['id']) && $_GET['id']){
  $getid = $_GET['id'];
  $sql = "SELECT * FROM food_details WHERE food_id = '$getid'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  echo $row["food_id"];
  echo $_POST["quan"];
         /* $qry = "INSERT INTO cart_details(food_id, quantity_id, total, flag,lt) VALUES('$member_id','$food_id','$quantity_id','$total','$flag_0','$lt')";
        $result = @mysqli_query($conn,$qry);
            $qry_create = "INSERT INTO orders_details(member_id,address_id,cart_id,delivery_date,staffID,flag,time_stamp) VALUES('$member_id','$address_id','$id','$delivery_date','$staff','$flag_0','$time_stamp')";
          mysqli_query($conn,$qry_create);*/
}
	include 'footer.php';

?>
</div>
</body>
</html>