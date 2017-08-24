<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
  $patient_set = find_all_patients();
?>
<?php $_SESSION['page_name'] = 'patient'; ?>
<?php include("../includes/layout/admin_header.php"); ?>
<?php include'../includes/nav.php'; ?>
<div id="main">
  <div id="navigation">
		<br/>
                <a href="doctor.php">&laquo;</a><br />
                <h2>Manage Patients</h2>
  </div>
  <div id="page">
    <?php echo message(); ?>
    
    <table>
      <tr>
        <th style="text-align: left; width: 200px;">First Name</th>
        <th style="text-align: left; width: 200px;">Last Name</th>
        <th style="text-align: left; width: 200px;">Gender</th>
        <th colspan="3" style="text-align: left;">Actions</th>
      </tr>
    <?php while($patient = mysqli_fetch_assoc($patient_set)) { ?>
      <tr>
        <td><?php echo htmlentities($patient["first_name"]); ?></td>
        <td><?php echo htmlentities($patient["last_name"]); ?></td>
        <td><?= $patient["gender"]?"Male":"Female"; ?></td>
        <td><a href="manage_record.php?patient_id=<?php echo urlencode($patient["id"]); ?>">Records</a></td>
        <td><a href="edit_patient.php?id=<?php echo urlencode($patient["id"]); ?>">Edit</a></td>
        <td><a href="delete_patient.php?id=<?php echo urlencode($patient["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
      </tr>
    <?php } ?>
    </table>
    <br />
    <a class='btn last' href="new_patient.php">Add new patient</a>
  </div>
</div>
<?php include("../includes/layout/admin_footer.php"); ?>
