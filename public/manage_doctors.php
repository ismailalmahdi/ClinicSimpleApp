<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
  $doctor_set = find_all_doctors();
?>
<?php $_SESSION['page_name'] = 'doctor'; ?>
<?php include'../includes/nav.php'; ?>

<?php $layout_context = "Doctor"; ?>
<?php include("../includes/layout/admin_header.php"); ?>
<div id="main">
    
  <div id="navigation">
		<br/>
                <a href="doctor.php">&laquo;</a><br />
                <h2>Manage Doctors</h2>
  </div>
  <div id="page">
    <?php echo message(); ?>
    
    <table>
      <tr>
        <th style="text-align: left; width: 200px;">First Name</th>
        <th style="text-align: left; width: 200px;">Last Name</th>
        <th style="text-align: left; width: 200px;">Username</th>
        <th colspan="2" style="text-align: left;">Actions</th>
      </tr>
    <?php while($doctor = mysqli_fetch_assoc($doctor_set)) { ?>
      <tr>
        <td><?php echo htmlentities($doctor["first_name"]); ?></td>
        <td><?php echo htmlentities($doctor["last_name"]); ?></td>
        <td><?php echo htmlentities($doctor["username"]); ?></td>
        <td><a href="edit_doctor.php?id=<?php echo urlencode($doctor["id"]); ?>">Edit</a></td>
        <td><a href="delete_doctor.php?id=<?php echo urlencode($doctor["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
      </tr>
    <?php } ?>
    </table>
    <br />
    <a class="btn last" href="new_doctor.php">Add new doctors</a>
  </div>
</div>
<?php include("../includes/layout/admin_footer.php"); ?>
