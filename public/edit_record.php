<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
$record = find_record_by_id($_GET["id"]);
if (!$record) {

    $_SESSION['message'] = 'The selected record was not found in the database!';
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_patient.php");
} else {
    $patient = find_patient_by_id($record['patient_id']);
}
?>

<?php
if (isset($_POST['submit'])) {
    // Process the form
    // validations
    $required_fields = array("sugar_level", "note");
    validate_presences($required_fields);


    if (empty($errors)) {

        // Perform Update

        $id = $record["id"];
        $sugar_level = mysql_prep($_POST["sugar_level"]);
        $note = mysql_prep($_POST["note"]);

        $query = "UPDATE records SET ";
        $query .= "sugar_level = '{$sugar_level}', ";
        $query .= "note = '{$note}' ";
        $query .= "WHERE id = {$id} ";
//    $query .= "LIMIT 1";
        $result = mysqli_query($connection, $query);
        if ($result && mysqli_affected_rows($connection) == 1) {
            // Success
            $_SESSION["message"] = "Record updated.";
            redirect_to("manage_record.php?patient_id=" . $record["patient_id"]);
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
    <br><br>
    <h2>Edit patient recored: <?php echo htmlentities($patient["first_name"] . ' ' . $patient["last_name"]); ?></h2>
</div>
<form action="edit_record.php?id=<?php echo urlencode($record["id"]); ?>" method="post">
    <table>
        <tr>
            <td>Sugar level</td>
            <td>    
                <input type="text" name="sugar_level" value="<?php echo htmlentities($record["sugar_level"]); ?>" />
            </td>
        </tr>
        <tr>
            <td>
                Note
            </td>
            <td>
                <input type="text" name="note" value="<?php echo htmlentities($record["note"]); ?>" />
            </td>
        </tr>
    </table>
    <input class='btn' type="submit" name="submit" value="Edit Record" />
</form>
<br />

<a class="btn last onePage"href="manage_record.php?patient_id=<?= $patient['id'] ?>">Cancel</a>
<?php include("../includes/layout/admin_footer.php"); ?>
