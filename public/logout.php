<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	// v1: simple logout
	// session_start();
        $username = $_SESSION["username"];
	$_SESSION["admin_id"] = null;
	$_SESSION["username"] = null;
        $_SESSION["message"]  = "logged out successfully, see you again " . $username;
	redirect_to("index.php");
?>