<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
$patient = find_patient_by_id($_GET["id"]);

if (!$patient) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_patient.php");
}
?>

<?php
if (isset($_POST['submit'])) {
    // Process the form
    // validations
    $required_fields = array("first_name", "last_name");
    validate_presences($required_fields);


    if (empty($errors)) {

        // Perform Update

        $id = $patient["id"];
        $first_name = mysql_prep($_POST["first_name"]);
        $last_name = mysql_prep($_POST["last_name"]);
        $gender = mysql_prep($_POST["gender"]);

        $query = "UPDATE patient_users SET ";
        $query .= "first_name = '{$first_name}', ";
        $query .= "last_name = '{$last_name}', ";
        $query .= "gender = '{$gender}' ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_affected_rows($connection) == 1) {
            // Success
            $_SESSION["message"] = "Patient updated.";
            redirect_to("manage_patient.php");
        } else {
            // Failure
            $_SESSION["message"] = "Patient update failed.";
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
    <h2>Edit patient: <?php echo htmlentities($patient["first_name"] . ' ' . $patient["last_name"]); ?></h2>
</div>

<form action="edit_patient.php?id=<?php echo urlencode($patient["id"]); ?>" method="post">
    <table>

        <tr> <td>First Name</td>
            <td>
                <input type="text" name="first_name" value="<?php echo htmlentities($patient["first_name"]); ?>" />
            </td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td>
                <input type="text" name="last_name" value="<?php echo htmlentities($patient["last_name"]); ?>" />
            </td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>
                <select name="gender">
                    <?php if ($patient["gender"] == 0): ?>
                        <option value="0"selected>female</option>
                        <option value="1">male</option>
                    <?php elseif ($patient["gender"] == 1): ?>
                        <option value="0" >female</option>
                        <option value="1" selected>male</option>
                    <?php else: ?>
                        <option value="0">female</option>
                        <option value="1">male</option>
                    <?php endif; ?>

                </select>
            </td>
        </tr>
    </table>
    <input class="btn" type="submit" name="submit" value="Edit Patient" />
</form>
<br />
<a class="btn last onePage"href="manage_patient.php">Cancel</a>
</div>
</div>

<?php include("../includes/layout/admin_footer.php"); ?>
