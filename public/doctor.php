<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$username = $_SESSION['username'];
?>
<?php require_once '../includes/layout/admin_header.php'; ?>
<?php include '../includes/nav.php'; ?>

<div id="main">
    <div id="navigation">
        <br/><br/>
        <h2 id="welcome"> Welcome <?php echo $username; ?>, you have Access to the database!</h2>
                <br/><br/>
        <h2 id="welcome">please select any item from the sidebar</h2>
    </div>

</div>


<?php require_once '../includes/layout/admin_footer.php'; ?>