<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php

if (isset($_GET['page'])) {
    $title = "Clinic - " . $_GET['page'];
} else {
    $title = "Life Care Clinic";
}
?>

<?php require_once '../includes/layout/header.php'; ?>
<div id="content">
    <!--  CONTENT -->
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        require_once strtolower($page) . '.php';
    } else {
        $page = "DATABASE";
        require_once 'database.php';
    }
    ?>

</div>
<?php require_once '../includes/layout/footer.php'; ?>