<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
if (!isset($_GET['patient_id'])) {
    $_SESSION['message'] = 'Please Select A Patient First';
    redirect_to('manage_patient.php');
}

$patient = find_patient_by_id($_GET['patient_id']);
?>
<?php
if (isset($_POST['submit'])) {
    // Process the form
    // validations
    $required_fields = array("sugar_level", "note");
    validate_presences($required_fields);


    if (empty($errors)) {

        // Perform Update
        $sugar_level = mysql_prep($_POST["sugar_level"]);
        $note = mysql_prep($_POST["note"]);

        $query = "INSERT INTO records (";
        $query .= " patient_id ,sugar_level, note ";
        $query .= ") VALUES (";
        $query .= " {$patient['id']},{$sugar_level},'{$note}' ";
        $query .= ")";

        $result = mysqli_query($connection, $query);
        if ($result && mysqli_affected_rows($connection) == 1) {
            // Success
            $_SESSION["message"] = "Record updated.";
            redirect_to("manage_record.php?patient_id=" . $patient["id"]);
        } else {
            // Failure
            $_SESSION["message"] = "Record update failed.";
        }
    }
} else {
    // This is probably a GET request
} // end: if (isset($_POST['submit']))
?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layout/admin_header.php"); ?>

<?php echo message(); ?>
<?php echo form_errors($errors); ?>
<div id="navigation">
    <br/><br/>
    
    <h2>create new patient recored for <?php echo htmlentities($patient["first_name"] . ' ' . $patient["last_name"]); ?></h2>
</div>
<form action="new_record.php?patient_id=<?php echo urlencode($patient["id"]); ?>" method="post">
    <table>
        <tr>
            <td>Sugar level</td>
            <td>
                <input type="text" name="sugar_level" value="" />
            </td>
        </tr>
        <tr>
            <td>
                Note
            </td>
            <td>
                <input type="text" name="note" value="" />
            </td>
        </tr>
    </table>
    <input class='btn' type="submit" name="submit" value="Create Record" />
</form>
<br />

<a class='btn last onePage' href="manage_record.php?patient_id=<?php echo urlencode($patient["id"]); ?>">Cancel</a>
<?php include("../includes/layout/admin_footer.php"); ?>
