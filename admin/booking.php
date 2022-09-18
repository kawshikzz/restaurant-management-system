<?php
ob_start();
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
<title><?php echo APP_NAME ?>:Tables</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
<script src="js/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="js/datatables.min.js"></script>

</head>
<body>
<div id="page">
<div id="header">
  <?php include 'header.php'; ?>
  <div id="center">
<h1 class="text-center">Book Table(s)</h1>

</div>
<!-- Button trigger modal -->
<div id="container">
    <div class="rb"><button class="btn btn-primary"><a class="one" href="tables.php"> Add New Table</a></button></div>
    &nbsp;
    <div class="center">
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reserveModal">
            Reserve A Table</button>
        </div>
<!-- Modal -->
<div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="reserveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reserveModalLabel">Book Table</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="booking.php" method="POST">
        <div class="container">
          <div class="row">
            <div class="col-sm">
                <label for="select-table">Select Table</label>
                <select class="form-select" aria-label="Select table" name="tblname" required>
                <?php
                    $sql = "SELECT * FROM tables";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                  <option value="<?= $row["table_name"] ?>"><?= $row["table_name"] ?></option>
                <?php
                        }
                      }else{
                        echo "<option>Nothing</option>";
                    }
                  ?>
                </select>
            </div>
            <div class="col-sm">
                <label for="set-hour">Set Hour</label>
                <input type="number" class="form-control mb-2" name="puthr" placeholder="Enter hour" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm">
                <label for="select-date">Select Date</label>
                <input type="date" class="form-control mb-2" name="pickdate" required>
            </div>
            <div class="col-sm">             
                <label for="select-time">Choose Time</label>
                <input type="time" class="form-control mb-2" name="picktime" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm">
                <label for="customer-name">Customer Name</label>
                <input type="text" class="form-control mb-2" name="fullname" placeholder="Enter full name" required>            </div>
            <div class="col-sm">
                <label for="customer-number">Customer Number</label>
                <input type="tel" class="form-control mb-2" name="validnum" placeholder="Enter mobile number" required>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="passdt" value="Confirm">
      </div>
      </form>
    </div>
  </div>
</div>

</div>
<table id="alltables" class="table table-striped">
                 <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Customer Name</th>
                      <th scope="col">Customer Mobile</th>
                      <th scope="col">Table Name</th>
                      <th scope="col">Booking Placed</th>
                      <th scope="col">Booking Date</th>
                      <th scope="col">Booking Time</th>
                      <th scope="col">Hours</th>
                      <th scope="col">Current Status</th>
                      <th scope="col">Action</th>
                    </tr>
                </thead>
             <tbody>
    <?php
        $i = 1;
        $sql = "SELECT * FROM booking";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                      <th scope="row"><?= $i++ ?></th>
                      <td><?= $row["customer_name"] ?></td>
                      <td><?= $row["customer_mobile"] ?></td>
                      <td><?= $row["table_number"] ?></td>
                      <td><?= $row["current_date_time"] ?></td>
                      <td><?= $row["booking_date"] ?></td>
                      <td><?= date('h:i a', strtotime($row["booking_time"])) ?> to <?= date('h:i a', strtotime($row["end_time"])) ?></td>
                      <td><?= $row["spend_hour"] ?></td>
                      <?php 
                        if($row["booking_status"] == 1){
                        ?>
                      <td><a href="Booking.php?close=<?= $row["id"] ?>" class="btn btn-outline-warning">Done</a></td>
                      <td><a href="Booking.php?cancel=<?= $row["id"] ?>" class="btn btn-outline-danger">Cancel</a></td>
                      <?php
                        }else{
                        ?>
                      <td>Booking Expired</td>
                      <td><input type="submit" class="btn btn-outline-dark" value="Cancel" disabled></td>
                        <?php
                        }
                        ?>
                    </tr>
               <?php
            }
        }else{
            echo "No records found!";
        }
    ?> 
  </tbody>

<!--   <tfoot>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Customer Mobile</th>
      <th scope="col">Table Name</th>
      <th scope="col">Booking Placed</th>
      <th scope="col">Booking Date</th>
      <th scope="col">Booking Time</th>
      <th scope="col">Hours</th>
      <th scope="col">Current Status</th>
      <th scope="col">Action</th>
    </tr>
  </tfoot> -->
</table>

</div>
<?php
if(isset($_POST["passdt"]) && $_POST["passdt"]){
    $tableNum = $_POST["tblname"];
    $bookDate = $_POST["pickdate"];
    $bookTime = $_POST["picktime"];
    $cstmrNam = $_POST["fullname"];
    $cstmrNum = $_POST["validnum"];
    $spntHour = $_POST["puthr"];
    $endTime = date('H:i', strtotime($bookTime.'+'.$spntHour.' hour'));
   $sql = "INSERT INTO booking(customer_name, customer_mobile, table_number, booking_date, booking_time, end_time, spend_hour) VALUES('$cstmrNam', '$cstmrNum', '$tableNum', '$bookDate', '$bookTime', '$endTime', '$spntHour')";
    mysqli_query($conn, $sql);
    header("Location:booking.php");
}else if(isset($_GET["close"]) && $_GET["close"]){
    $bkid = $_GET["close"];
    $sql = "UPDATE booking SET booking_status = '0' WHERE id = $bkid";
    mysqli_query($conn, $sql);
    header("Location:booking.php");
}else if(isset($_GET["cancel"]) && $_GET["cancel"]){
    $bkid = $_GET["cancel"];
    $sql = "DELETE FROM booking WHERE id = $bkid";
    mysqli_query($conn, $sql);
    header("Location:booking.php");
}

?>
</div>
</div>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
<?php     include 'footer.php'; ?>
</html>
<?php ob_end_flush(); ?>