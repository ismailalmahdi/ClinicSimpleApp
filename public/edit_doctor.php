<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
$doctor = find_doctor_by_id($_GET["id"]);

if (!$doctor) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_doctors.php");
}
?>

<?php
if (isset($_POST['submit'])) {
    // Process the form
    // validations
    $required_fields = array("first_name", "last_name", "username", "password");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("username" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if (empty($errors)) {

        // Perform Update

        $id = $doctor["id"];
        $first_name = mysql_prep($_POST["first_name"]);
        $last_name = mysql_prep($_POST["last_name"]);
        $username = mysql_prep($_POST["username"]);
        $hashed_password = password_encrypt($_POST["password"]);

        $query = "UPDATE doctor_users SET ";
        $query .= "first_name = '{$first_name}', ";
        $query .= "last_name = '{$last_name}', ";
        $query .= "hashed_password = '{$hashed_password}' ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_affected_rows($connection) == 1) {
            // Success
            $_SESSION["message"] = "Doctor updated.";
            redirect_to("manage_doctors.php");
        } else {
            // Failure
            $_SESSION["message"] = "Doctor update failed.";
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
    <h2>Edit Doctor: <?php echo htmlentities($doctor["username"]); ?></h2>
</div>
<form action="edit_doctor.php?id=<?php echo urlencode($doctor["id"]); ?>" method="post">
    <table>

        <tr>
            <td>First Name</td>
            <td>
                <input type="text" name="first_name" value="<?php echo htmlentities($doctor["first_name"]); ?>" />
            </td>
        </tr>
        <tr>
            <td>
                Last Name
            </td>
            <td>
                <input type="text" name="last_name" value="<?php echo htmlentities($doctor["last_name"]); ?>" />
            </td>
        </tr>
        <tr>
            <td>
                Username
            </td>
            <td>
                <input type="text" name="username" value="<?php echo htmlentities($doctor["username"]); ?>" />
            </td>
        </tr>
        <tr>
            <td>
                Password
            </td>
            <td>
                <input type="password" name="password" value="" />
            </td>
        </tr>
    </table>
    <input class="btn" type="submit" name="submit" value="Edit Doctor" />
</form>
<br />
<a class='btn last onePage' href="manage_doctors.php">Cancel</a>
</div>
</div>

<?php include("../includes/layout/admin_footer.php"); ?>
