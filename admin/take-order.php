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
	

    //retrive categories from the categories table
    $categories=mysqli_query($conn,"SELECT * FROM categories")
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
<?php
if(isset($_POST["place"]) && $_POST["place"]){
    $plpid = $_POST["pname"];
    $sql = "SELECT * FROM food_details WHERE food_id = '$plpid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row["food_id"];
    $name = $row["food_name"];
    $price = $row["food_price"];
    $quant = $_POST["quan"];
    $total = $price*$quant;
?>
<div class="container">
<form action="take-order.php" method="POST">
  <div class="row">
    <div class="col-sm">
        <p>Select Item</p>
        <select class="form-select" name="pname" aria-label="Select product" required>
             <option value="<?= $name ?>" selected><?= $name ?></option>
        </select>
    </div>
    <div class="col-sm">
        <p>Quantity</p>
        <input type="text" class="form-control" name="quan" value="<?= $quant ?>" readonly="readonly" placeholder="Quantities" required>
    </div>
    <div class="col-sm">
        <p>Price (Tk)</p>
        <input type="text" class="form-control" name="rate" value ="<?= $price ?>" readonly="readonly" placeholder="Rate">
    </div>
    <div class="col-sm mb-2">
        <p>Total Price (Tk)</p>
        <input type="text" class="form-control" name="total" value="<?= $total ?>" readonly="readonly" placeholder="Total">
    </div>
    <div class="float-end mb-2">
        <input type="submit" class="btn btn-success" name="confirm" value="Confirm">
        <a href="take-order.php" class="btn btn-primary">Cancel</a>
    </div>
    </div>
    </form>
  </div>
<?php
}else if(isset($_POST["confirm"]) && $_POST["confirm"]){
   $inname = $_POST["pname"];
   $inquan = $_POST["quan"];
   $inprice = $_POST["rate"];
   $intotal = $_POST["total"];
   $sql = "INSERT INTO orders(item_name, quantity, item_price, total_price) VALUES ('$inname', '$inquan', '$inprice', '$intotal')";
   mysqli_query($conn, $sql);
   header("Location:take-order.php");
}else{
?>
<div class="container">
<form action="take-order.php" method="POST">
  <div class="row">
    <div class="col-sm">
        <p>Select Item</p>
        <select class="form-select" name="pname" aria-label="Select product" required>
        <?php 
          $sql = "SELECT * FROM food_details";
          $result = mysqli_query($conn, $sql);   
          while($row = mysqli_fetch_assoc($result)){
            $fid = $row['food_id'];
            $fname = $row['food_name'];
            echo "<option value='$fid'>$fname</option>";
           }
          ?>
        </select>
    </div>
    <div class="col-sm">
        <p>Quantity</p>
        <input type="text" class="form-control" name="quan"  placeholder="Quantities" required>
    </div>
    <div class="col-sm">
        <p>Price (Tk)</p>
        <input type="text" class="form-control" name="rate" value ="Price" placeholder="Rate" disabled>
    </div>
    <div class="col-sm mb-2">
        <p>Total Price (Tk)</p>
        <input type="text" class="form-control" name="total" value="Total Price"  placeholder="Total" disabled>
    </div>
    <div class="float-end mb-2">
        <input type="submit" class="btn btn-primary" name="place" value="place order">
    </div>
    </div>
    </form>
  </div>
<?php
}
?>

</div>
<?php
  /*$sql = "SELECT * FROM food_details WHERE food_id = '$getid'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  echo $row["food_id"];*/

	include 'footer.php';
?>

</div>
</body>
</html>