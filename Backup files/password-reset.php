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
        //get email
        $email = clean($_POST['email']);
        
        //selecting a specific record from the members table. Return an error if there are no records in the table
        $result=mysqli_query($conn,"SELECT * FROM members WHERE login='$email'")
        or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
    }
?>
<?php
    if(isset($_POST['Change'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
global $conn;
            $str = @trim($str);
            if(get_magic_quotes_gpc()) {
                $str = stripslashes($str);
            }
            return mysqli_real_escape_string($conn,$str);
        }
        if(trim($_SESSION['member_id']) != ''){
            $member_id=$_SESSION['member_id']; //gets member id from session
            //get answer and new password from form
            $answer = clean($_POST['answer']);
            $new_password = clean($_POST['new_password']);
            
         // update the entry
         $result = mysqli_query($conn,"UPDATE members SET passwd='".md5($_POST['new_password'])."' WHERE member_id='$member_id' AND answer='".md5($_POST['answer'])."'")
         or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours. \n");  
         
         if($result){
                unset($_SESSION['member_id']);
                header("Location: reset-success.php"); //redirect to reset success page         
         }
         else{
                unset($_SESSION['member_id']);
                header("Location: reset-failed.php"); //redirect to reset failed page
         }
            }
            else{
                unset($_SESSION['member_id']);
                header("Location: reset-failed.php"); //redirect to reset failed page
            }
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo APP_NAME ?>:Password Reset</title>
<link href="css/bootstrap.min.css"  rel="stylesheet" type="text/css">
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="reset">
  <div style="border:#5e2a04 solid 0px;padding:4px 6px 2px 6px">
  <form name="passwordResetForm" id="passwordResetForm" method="post" action="password-reset.php" onsubmit="return passwordResetValidate(this)">
     <table width="360" style="text-align:center;">
     <tr>
        <th>Account Email</th>
        <td width="168"><input name="email" type="text" class="form-control form-control-user" id="email" /></td>
        <td><input type="submit" name="Submit" value="Check" class="btn btn-primary btn-user" /></td>
     </tr>
     </table>
 </form>
  <?php
    if(isset($_POST['Submit'])){
        $row=mysqli_fetch_assoc($result);
        $_SESSION['member_id']=$row['member_id']; //creates a member id session
        session_write_close(); //closes session
        $question_id=$row['question_id'];
        
        //get question text based on question_id
        $question=mysqli_query($conn,"SELECT * FROM questions WHERE question_id='$question_id'")
        or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours.");
        
        $question_row=mysqli_fetch_assoc($question);
        $question=$question_row['question_text'];
        if($question!=""){
            echo "<b>Your Member ID:</b> ".$_SESSION['member_id']."<br>";
            echo "<b>Your Security Question:</b> ".$question;
        }
        else{
            echo "<b>Your Security Question:</b> THIS ACCOUNT DOES NOT EXIST! PLEASE CHECK YOUR EMAIL AND TRY AGAIN.";
        }
    }
  ?>
  <hr>
  <form name="passwordResetForm" id="passwordResetForm" method="post" action="password-reset.php" onsubmit="return passwordResetValidate_2(this)">
     <table width="360" style="text-align:center;">
<!--      <tr>
        <td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
     </tr> -->
     <tr>
        <th>Your Security Answer <font color="#FF0000">* </font></th>
        <td width="168"><input name="answer" type="text" class="form-control form-control-user" id="answer" /></td>
     </tr>
     <tr>
        <th>New Password <font color="#FF0000">* </font></th>
        <td width="168"><input name="new_password" type="password" class="form-control form-control-user" id="new_password" /></td>
     </tr>
     <tr>
        <th>Confirm New Password <font color="#FF0000">* </font></th>
        <td width="168"><input name="confirm_new_password" type="password" class="form-control form-control-user" id="confirm_new_password" /></td>
     </tr>
     <tr>
        <td colspan="2"><input type="reset" name="Reset" value="Clear Fields" class="btn btn-outline-dark" /> &nbsp
        <input type="submit" name="Change" value="Change Password" class="btn btn-primary btn-user" /></td>
     </tr>
     </table>
 </form>
  </div>
  </div>
</body>
</html>