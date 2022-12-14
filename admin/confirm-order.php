<?php
    //Start session
    session_start();
    
	//checking connection and connecting to a database
	require_once('connection/config.php');
	//Connect to mysqli server
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
	if(!$conn) {
		die('Failed to connect to server: ' . mysqli_error());
	}
	
	
 
     // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
         // get id value
         $id = $_GET['id'];
         
         // update the entry
         $upsql = "UPDATE orders SET   payment_status = '1' WHERE id = '$id'";
         $result = mysqli_query($conn, $upsql)
         or die("There was a problem while deleting the order ... \n" . mysqli_error()); 
         
         // redirect back to the orders
         header("Location: orders.php");
     }
     else
        // if id isn't set, redirect back to the orders
     {
        header("Location: orders.php");
     }
 
?>