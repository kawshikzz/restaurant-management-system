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
  
    //retrive promotions from the specials table
    $result=mysqli_query($conn,"SELECT * FROM food_details,categories WHERE food_details.food_category=categories.category_id")
    or die("There are no records to display ... \n" . mysqli_error()); 
?>
<?php
    //retrive categories from the categories table
    $categories=mysqli_query($conn,"SELECT * FROM categories")
    or die("There are no records to display ... \n" . mysqli_error()); 
?>

<!DOCTYPE htm>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Foods</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
<script src="js/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="js/datatables.min.js"></script>
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">

<?php include 'header.php';?>

<h1>Foods Management </h1>

</div>
<div id="container">
<table>
<h3>ADD A NEW FOOD</h3>
<form name="foodsForm" id="foodsForm" action="foods-exec.php" method="post" enctype="multipart/form-data">
<tr>
    <th>Name</th>
    <th>Description</th>
    <th>Price (Tk)</th>
    <th>Category</th>
    <!-- <th>Photo</th> -->
    <th>Action</th>
</tr>
<tr>
    <td><input type="text" name="name" id="name" class="form-control form-control-user" required></td>
    <td width="300"><textarea name="description" id="description" class="form-control form-control-user"></textarea></td>
    <td><input type="text" name="price" id="price" class="form-control form-control-user" required></td>
    <td><select name="category" class="btn btn-outline-dark dropdown-toggle" id="category" required>
    <option value="select"> Select Catagory
    <?php 
    //loop through categories table rows
    while ($row=mysqli_fetch_array($categories)){
    echo "<option value=$row[category_id]>$row[category_name]"; 
    }
    ?>
    </select></td>
<!--     <td><input type="file" name="photo" id="photo"/ class="form-control form-control-user" required></td> -->
    <td><input type="submit" name="Submit" value="Add" class="btn btn-primary btn-block" required></td>
</tr>
</form>
</table>
<hr>
<table id="alltables" class="table table-striped table-hover">
<h3>AVAILABLE FOODS</h3>
<tr>
<!-- <th>Food Photo</th> -->
<th>Food Name</th>
<th>Food Description</th>
<th>Food Price (Tk)</th>
<th>Food Category</th>
<th>Action</th>
</tr>

<?php
while ($row=mysqli_fetch_array($result)){
    ?>
<tr>
<!-- <td><img src=../images/'. $row['food_photo'] width="80" height="70"></td> -->
<td><?= $row['food_name'] ?></td>
<td><?= $row['food_description'] ?></td>
<td><?= $row['food_price'] ?></td>
<td><?= $row['category_name'] ?></td>
<td><a href="delete-food.php?id=<?= $row['food_id'] ?>">Remove Food</a></td>
</tr>
<?php 
}
?>
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
</table>
<hr>
</div>
<?php include 'footer.php'; ?>
</div>
<script src="js/script.js"></script>
</body>
</html>