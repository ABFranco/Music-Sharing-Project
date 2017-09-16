<?php

session_start();

if (isset($_POST['login'])) {
	
	include 'dbh.inc.php';

	// even though called uid, you can also login with your email
	$uid = mysqli_real_escape_string($conn, $_POST['uid']); 
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

	// error handlers
	// check if inputs are empty
	if (empty($uid) || empty($pwd)) {
		header("Location: ../index.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE username = '$uid' OR email='$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			// no user found
			header("Location: ../index.php?login=error");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				// de-hashing password aka check if password matches the hashed version in DB
				$hashedPwdCheck = password_verify($pwd, $row['password']);
				if ($hashedPwdCheck == false) {
					header("Location: ../index.php?login=error");
					exit();
				} elseif ($hashedPwdCheck == true) {
					// log in the user
					$_SESSION['u_id'] = $row['id'];
					$_SESSION['u_email'] = $row['email'];
					$_SESSION['u_uid'] = $row['username'];
					header("Location: ../index.php?login=success");
					exit();
				}
			}
		}
	}

} else {
	header("Location: ../index.php?login=error");
	exit();
}