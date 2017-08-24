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
    $required_fields = array("username", "password");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("username" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if (empty($errors)) {
        // Perform Create

        $username = mysql_prep($_POST["username"]);
        $hashed_password = password_encrypt($_POST["password"]);
        $first_name = mysql_prep($_POST["first_name"]);
        $last_name = mysql_prep($_POST["last_name"]);

        $query = "INSERT INTO doctor_users (";
        $query .= "  first_name, last_name, username, hashed_password";
        $query .= ") VALUES (";
        $query .= "  '{$first_name}', '{$last_name}', '{$username}', '{$hashed_password}'";
        $query .= ")";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Success
            $_SESSION["message"] = "Doctor created.";
            redirect_to("manage_doctors.php");
        } else {
            // Failure
            $_SESSION["message"] = "Doctor creation failed.";
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
    <h2>Create Doctor</h2>
</div>
<form action="new_doctor.php" method="post">
    <table>
        <tr>
            <td>First Name:</td>
            <td>
                <input type="text" name="first_name" value="" />
            </td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td>
                <input type="text" name="last_name" value="" />
            </td>
        </tr>
        <tr>
            <td>Username </td>
            <td>
                <input type="text" name="username" value="" />
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td>
                <input type="password" name="password" value="" />
            </td>
        </tr>
    </table>
    <input class='btn' type="submit" name="submit" value="Create Doctor" />

</form>
<br />
<a class='btn last onePage' href="manage_doctors.php">Cancel</a>
</div>
</div>
<?php include("../includes/layout/admin_footer.php"); ?>