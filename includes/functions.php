<?php

	function redirect_to($new_location) {

	  header("Location: " . $new_location);
	  exit;

	}

	function mysql_prep($string) {
		global $connection;
		
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}
	
	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}

	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}
	
	function find_all_patients() {
		global $connection;
		$query  = "SELECT * ";
		$query .= "FROM patient_users ";
		$query .= "ORDER BY first_name ASC";
		$patient_set = mysqli_query($connection, $query);
		confirm_query($patient_set);
		return $patient_set;
	}
	
	function find_records_for_patient($patient_id) {
		global $connection;
		
		$safe_patient_id = mysqli_real_escape_string($connection, $patient_id);
		
		$query  = "SELECT * ";
		$query .= "FROM records ";
		$query .= "WHERE patient_id = {$safe_patient_id} ";
		$query .= "ORDER BY id ASC";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);
		return $record_set;
	}
	
	function find_all_doctors() {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM doctor_users ";
		$query .= "ORDER BY username ASC";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		return $admin_set;
	}
	
	function find_patient_by_id($patient_id) {
		global $connection;
		
		$safe_patient_id = mysqli_real_escape_string($connection, $patient_id);
		
		$query  = "SELECT * ";
		$query .= "FROM patient_users ";
		$query .= "WHERE id = {$safe_patient_id} ";
		$query .= "LIMIT 1";
		$patient_set = mysqli_query($connection, $query);
		confirm_query($patient_set);
		if($patient = mysqli_fetch_assoc($patient_set)) {
			return $patient;
		} else {
			return null;
		}
	}

	function find_record_by_id($record_id) {
		global $connection;
		
		$safe_record_id = mysqli_real_escape_string($connection, $record_id);
		
		$query  = "SELECT * ";
		$query .= "FROM records ";
		$query .= "WHERE id = {$safe_record_id} ";
		$query .= "LIMIT 1";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);
		if($record = mysqli_fetch_assoc($record_set)) {
			return $record;
		} else {
			return null;
		}
	}
	
	function find_doctor_by_id($admin_id) {
		global $connection;
		
		$safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
		
		$query  = "SELECT * ";
		$query .= "FROM doctor_users ";
		$query .= "WHERE id = {$safe_admin_id} ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}

	function find_doctor_by_username($username) {
		global $connection;
		
		$safe_username = mysqli_real_escape_string($connection, $username);
		
		$query  = "SELECT * ";
		$query .= "FROM doctor_users ";
		$query .= "WHERE username = '{$safe_username}' ";
		$query .= "LIMIT 1";
		$doctor_set = mysqli_query($connection, $query);
		confirm_query($doctor_set);
		if($doctor = mysqli_fetch_assoc($doctor_set)) {
			return $doctor;
		} else {
			return null;
		}
	}



	function password_encrypt($password) {
          $hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	  $salt_length = 22; 					// Blowfish salts should be 22-characters or more
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
		return $hash;
	}
	
	function generate_salt($length) {
	  // Not 100% unique, not 100% random, but good enough for a salt
	  // MD5 returns 32 characters
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  
		// Valid characters for a salt are [a-zA-Z0-9./]
	  $base64_string = base64_encode($unique_random_string);
	  
		// But not '+' which is valid in base64 encoding
	  $modified_base64_string = str_replace('+', '.', $base64_string);
	  
		// Truncate string to the correct length
	  $salt = substr($modified_base64_string, 0, $length);
	  
		return $salt;
	}
	
	function password_check($password, $existing_hash) {
		// existing hash contains format and salt at start
	  $hash = crypt($password, $existing_hash);
	  if ($hash === $existing_hash) {
	    return true;
	  } else {
	    return false;
	  }
	}

	function attempt_login($username, $password) {
		$admin = find_doctor_by_username($username);
		if ($admin) {
			// found admin, now check password
			if (password_check($password, $admin["hashed_password"])) {
				// password matches
				return $admin;
			} else {
				// password does not match
				return false;
			}
		} else {
			// admin not found
			return false;
		}
	}

	function logged_in() {
		return isset($_SESSION['admin_id']);
	}
	
	function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to("index.php?page=DATABASE");
		}
	}

?>

