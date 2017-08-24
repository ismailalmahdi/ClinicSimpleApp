<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
if (isset($_GET['patient_id'])) {
    $patient = find_patient_by_id($_GET['patient_id']);
    if (!isset($patient)) {
        $_SESSION["message"] = "Please select patient first!";
        redirect_to("manage_patient.php");
    }
} else {
    $_SESSION["message"] = "Please select patient first!";
    redirect_to("manage_patient.php");
}

$record_set = find_records_for_patient($patient['id']);
?>
<?php $_SESSION['page_name'] = 'record'; ?>
<?php include("../includes/layout/admin_header.php"); ?>
<?php include'../includes/nav.php'; ?>
<div id="main">
    <div id="navigation">
        <a href="manage_patient.php">&laquo;</a><br />
        <br/>
        <h2>Manage Records For Patient: <?= $patient['first_name']." ".$patient['last_name'] ?></h2>
    </div>
    <div id="page">
        <?php echo message(); ?>
        
        <table>
            <tr>
                <th style="text-align: left; width: 200px;">Sugar Level</th>
                <th style="text-align: left; width: 200px;">Note</th>
                <th style="text-align: left; width: 200px;">Indication</th>
                <th colspan="2" style="text-align: left;">Actions</th>
            </tr>
            <?php while ($record = mysqli_fetch_assoc($record_set)) { ?>
                <tr>
                    <td><?php echo htmlentities($record["sugar_level"]); ?></td>
                    <td><?php echo htmlentities($record["note"]); ?></td>
                    <td>
                        <!--logic here--> 
                        <?php if ($record['sugar_level'] >= 1.0 && $record['sugar_level'] < 7.0): ?>
                            <!--low-->
                            <div class='low_sugar_level'></div>
                        <?php elseif ($record['sugar_level'] >= 7.0 && $record['sugar_level'] < 8.0): ?>
                            <!--m-->
                            <div class='med_sugar_level'></div>
                        <?php elseif ($record['sugar_level'] >= 8.0 && $record['sugar_level'] < 15.0): ?>
                            <!--h-->
                            <div class='high_sugar_level'></div>
                        <?php elseif ($record['sugar_level'] >= 15.0): ?>
                            <!--v h-->
                            <div class='v_high_sugar_level'></div>
                        <?php endif; ?>
                    </td>
                    <td><a  href="edit_record.php?id=<?php echo urlencode($record["id"]); ?>">Edit</a></td>
                    <td><a  href="delete_record.php?id=<?php echo urlencode($record["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
                </tr>
            <?php } ?>
        </table>
        <br />
        <a  class='btn last' href="new_record.php?patient_id=<?php echo urlencode($patient["id"]); ?>">Add new record</a>
    </div>
</div>
<?php include("../includes/layout/admin_footer.php"); ?>
