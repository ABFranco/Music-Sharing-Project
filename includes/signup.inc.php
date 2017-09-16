<?php

if (isset($_POST['signup'])) {

	include_once 'dbh.inc.php';

	// makes sure people can't send in code with mysql_real....
	$email = mysqli_real_escape_string($conn, $_POST['email']); 
	$uid = mysqli_real_escape_string($conn, $_POST['uid']); 
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']); 
	$first = mysqli_real_escape_string($conn, $_POST['first']); 
	$last = mysqli_real_escape_string($conn, $_POST['last']); 

	// error handlers
	// check for empty fields
	if (empty($email) || empty($uid) || empty($pwd)) {
		header("Location: ../signup.php?signup=empty");
		exit();
	} else {
		// check if input characters are valid
		if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
			header("Location: ../signup.php?signup=invalid");
			exit();
		} else {
			// check if email is valid
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../signup.php?signup=email");
				exit();
			} else {
				// check if username already taken
				$sql = "SELECT * FROM users WHERE username='$uid'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0) {
					header("Location: ../signup.php?signup=usertaken");
					exit();
				} else {
					// hashing the password
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					// insert the user into the database
					$sql = "INSERT INTO users (email, username, password, first_name, last_name) VALUES ('$email', '$uid', '$hashedPwd', '$first', '$last');";
					mysqli_query($conn, $sql);
					header("Location: ../account_created.php"); 
					exit();
				}
			}
		}
	}

} else {
	header("Location: ../signup.php");
	exit();
}