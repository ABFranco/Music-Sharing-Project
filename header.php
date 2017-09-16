<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css?ts=<?=time()?>&quot;" />
	
</head>
<body>

<header>
	<nav>
		<div class="main-wrapper">
			<ul>
				<li><a href="index.php">Home</a></li>

			</ul>
			<div class="nav-login">
				<?php  
					if (isset($_SESSION['u_id'])) {
						echo 
						'<form action="includes/logout.inc.php" method="POST">
							<button type="button" name="account">Account</button>
							<button type="submit" name="logout">Logout</button>

						</form>';
					} else {
						echo 
						'<form action="includes/login.inc.php" method="POST">
							<input type="text" name="uid" placeholder="Username/e-mail">
							<input type="password" name="pwd" placeholder="password">
							<button type="submit" name="login">Login</button>
						</form>
						<a href="signup.php">Sign up</a>';
					}
				?>
				

				
			</div>
		</div>
	</nav>
</header>