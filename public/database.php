<!--LOGIN PAGE--> 

<?php require_once("../includes/validation_functions.php"); ?>
<!-- login process starts here-->
<?php

$username = "";
if (isset($_POST['login_submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  if (empty($errors)) {
    // Attempt Login

		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$found_doctor = attempt_login($username, $password);

    if ($found_doctor) {
      // Success
			// Mark user as logged in
			$_SESSION["admin_id"] = $found_doctor["id"];
			$_SESSION["username"] = $found_doctor["username"];
      redirect_to("doctor.php");
    } else {
      // Failure
      $_SESSION["message"] = "Username/password not found.";
    }
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>
<!-- login process ends here -->
<!--login form starts-->
<?php echo message(); ?>
<?php echo form_errors($errors); ?>
<?php if(logged_in()){
	redirect_to('doctor.php');
}
?>

<div id="loginPage">
	<form action="index.php?page=DATABASE" method="POST">
		<input type="text" name="username" placeholder="username"/>
		<input type="password" name="password" placeholder="password"/>
		<input type="submit" name ="login_submit" value="LOGIN" class="button" />
	</form>
</div>
<!--login form end-->