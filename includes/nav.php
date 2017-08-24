<div class="sidebar">
    <img class='small_logo' src="img/logo.png">
    <ul>
        <?php if (isset($_SESSION['page_name'])): ?>
            <?php if ($_SESSION['page_name'] == 'patient'): ?>
                <li><a href="manage_doctors.php"><img src="img/doctor_button.jpg"></a></li>
                <li><a href="manage_patient.php"><img src="img/patient_icon.jpg"></a></li>
                <li><a href="manage_record.php"><img src="img/record_button.jpg"></a></li>
            <?php elseif ($_SESSION['page_name'] == 'doctor'): ?>
                <li><a href="manage_doctors.php"><img src="img/doctor_icon.png"></a></li>
                <li><a href="manage_patient.php"><img src="img/patient_button.jpg"></a></li>
                <li><a href="manage_record.php"><img src="img/record_button.jpg"></a></li>
            <?php else: ?>
                <li><a href="manage_doctors.php"><img src="img/doctor_button.jpg"></a></li>
                <li><a href="manage_patient.php"><img src="img/patient_button.jpg"></a></li>
                <li><a href="manage_record.php"><img src="img/record_button.jpg"></a></li>

            <?php endif; ?>
        <?php else: ?>
            <li><a href="manage_doctors.php"><img src="img/doctor_button.jpg"></a></li>
            <li><a href="manage_patient.php"><img src="img/patient_button.jpg"></a></li>
            <li><a href="manage_record.php"><img src="img/record_button.jpg"></a></li>
        <?php endif; ?>
        <li><a href="logout.php">logout</a></li>

    </ul>
</div>