<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<!--Doctor Access Only--> 
<?php confirm_logged_in(); ?>

<?php

  $record = find_record_by_id($_GET["id"]);
  if (!$record) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    $_SESSION['message'] = "Something went wrong!";
    redirect_to("manage_patient.php");
  }
  
  $id = $record["id"];
  $query = "DELETE FROM records WHERE id = {$id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Record deleted.";
    redirect_to("manage_record.php?patient_id=".$record['patient_id']);
  } else {
    // Failure
    $_SESSION["message"] = "record deletion failed.";
    redirect_to("manage_record.php?patient_id=".$record['patient_id']);
  }
  
?>