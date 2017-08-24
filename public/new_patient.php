<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<!--doctor access only--> 
<?php confirm_logged_in(); ?>


<?php
if (isset($_POST['submit'])) {
    // Process the form
    // validations
    $required_fields = array("first_name", "last_name", "gender");
    validate_presences($required_fields);

    if (empty($errors)) {
        // Perform Create


        $first_name = mysql_prep($_POST["first_name"]);
        $last_name = mysql_prep($_POST["last_name"]);
        $gender = mysql_prep($_POST["gender"]);

        $query = "INSERT INTO patient_users (";
        $query .= "  first_name, last_name, gender";
        $query .= ") VALUES (";
        $query .= "  '{$first_name}', '{$last_name}','{$gender}' ";
        $query .= ")";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Success
            $_SESSION["message"] = "Patient created.";
            redirect_to("manage_patient.php");
        } else {
            // Failure
            $_SESSION["message"] = "Patient creation failed.";
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
    <h2>Create Patient</h2>
</div>
<form action="new_patient.php" method="post">
    <table>
        <tr>
            <td>
                First Name
            </td>
            <td>
                <input type="text" name="first_name" value="" />
            </td>
        </tr>
        <tr>
            <td>
                Last Name
            </td>
            <td>
                <input type="text" name="last_name" value="" />
            </td>
        </tr>
        <tr>
            <td>
                Gender
            </td>
            <td>
                <select name="gender">
                    <option value="0">female</option>
                    <option value="1">male</option>
                </select>
            </td>
        </tr>
    </table>
    <input class='btn' type="submit" name="submit" value="Create Patient" />
</form>
<br />
<a class='btn last onePage' href="manage_patient.php">Cancel</a>
</div>
</div>
<?php include("../includes/layout/admin_footer.php"); ?>