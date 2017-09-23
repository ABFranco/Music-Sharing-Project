<?php

if (isset($_POST['account_edit'])) {

	include_once 'dbh.inc.php';

	// makes sure people can't send in code with mysql_real....
	$email = mysqli_real_escape_string($conn, $_POST['email']); 
	$username = mysqli_real_escape_string($conn, $_POST['username']); 
	$first = mysqli_real_escape_string($conn, $_POST['first']); 
	$last = mysqli_real_escape_string($conn, $_POST['last']); 
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

	$u_id = $_POST['uid'];

	// error handlers
	// check for empty fields
	if (empty($email) && empty($username) && empty($first) && empty($last) || empty($pwd)) {
		header("Location: ../edit_account.php?edit=empty");
		exit();
	} else {
		// check if input characters are valid
		if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
			header("Location: ../edit_account.php?edit=invalid");
			exit();
		} else {
			
			// check if username already taken
			$sql = "SELECT * FROM users WHERE id='$username'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);

			if ($resultCheck > 0) {
				header("Location: ../edit_account.php?edit=usertaken");
				exit();
			} else {
				$sql = "SELECT * FROM users WHERE id = '$u_id'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				// checking password
				$hashedPwdCheck = password_verify($pwd, $row['password']);
				if ($hashedPwdCheck == false) {
					header("Location: ../edit_account.php?password=incorrect");
					exit();
				} elseif ($hashedPwdCheck == true) {
					// update database depending on which fields weren't empty

					// email
					if (!empty($email)){
						// check if email is valid
						if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
							header("Location: ../edit_account.php?edit=email");
							exit();
						} else {
							$sql = "UPDATE users SET email = '$email' WHERE id = '$u_id';";
							mysqli_query($conn, $sql);
						}
					}

					// names
					if (!empty($username)){
						$sql = "UPDATE users SET username = '$username' WHERE id = '$u_id';";
						mysqli_query($conn, $sql);
					}
					if (!empty($first)){
						$sql = "UPDATE users SET first_name = '$first' WHERE id = '$u_id';";
						mysqli_query($conn, $sql);
					}
					if (!empty($last)){
						$sql = "UPDATE users SET last_name = '$last' WHERE id = '$u_id';";
						mysqli_query($conn, $sql);
					}
					

					header("Location: ../account_updated.php"); 
					exit();
				} else {
					header("Location: ../edit_account.php?password=incorrect");
					exit();
				}
			}
		}
	}

} 

// for changing the password

if (isset($_POST['password_edit'])) {

	include_once 'dbh.inc.php';

	// makes sure people can't send in code with mysql_real....
	$pwd1 = mysqli_real_escape_string($conn, $_POST['pwd1']); 
	$pwd2 = mysqli_real_escape_string($conn, $_POST['pwd2']); 

	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

	$u_id = $_POST['uid'];

	// error handlers
	// check for empty fields
	if (empty($pwd1) || empty($pwd2)  || empty($pwd)) {
		header("Location: ../edit_account.php?edit=pw_empty");
		exit();
	} else {
			
		// check if passwords match
		if (strcmp($pwd1, $pwd2) != 0) {
			header("Location: ../edit_account.php?edit=!pw_match");
			exit();
		} else {
			$sql = "SELECT * FROM users WHERE id = '$u_id'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			// checking password
			$hashedPwdCheck = password_verify($pwd, $row['password']);
			if ($hashedPwdCheck == false) {
				header("Location: ../edit_account.php?password=incorrect");
				exit();
			} elseif ($hashedPwdCheck == true) {
				// update password
				$hashedPwd = password_hash($pwd1, PASSWORD_DEFAULT);
				$sql = "UPDATE users SET password = '$hashedPwd' WHERE id = '$u_id';";
				mysqli_query($conn, $sql);

				header("Location: ../account_updated.php"); 
				exit();
			} else {
				header("Location: ../edit_account.php?password=incorrect");
				exit();
			}
		}
	}

} else {
	header("Location: ../edit_account.php");
	exit();
}