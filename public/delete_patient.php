<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<!--Doctor Access Only--> 
<?php confirm_logged_in(); ?>

<?php

  $patient = find_patient_by_id($_GET["id"]);
  if (!$patient) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_patient.php");
  }
  
  $id = $patient["id"];
  $query = "DELETE FROM patient_users WHERE id = {$id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Patient deleted.";
    redirect_to("manage_patient.php");
  } else {
    // Failure
    $_SESSION["message"] = "Patient deletion failed.";
    redirect_to("manage_patient.php");
  }
  
?>