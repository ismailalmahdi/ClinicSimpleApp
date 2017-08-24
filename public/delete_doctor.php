<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<!--Doctor Access Only--> 
<?php confirm_logged_in(); ?>

<?php
  $doctor = find_doctor_by_id($_GET["id"]);
  if (!$doctor) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_doctors.php");
  }
  
  $id = $doctor["id"];
  $query = "DELETE FROM doctor_users WHERE id = {$id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Doctor deleted.";
    redirect_to("manage_doctors.php");
  } else {
    // Failure
    $_SESSION["message"] = "Doctor deletion failed.";
    redirect_to("manage_doctors.php");
  }
  
?>