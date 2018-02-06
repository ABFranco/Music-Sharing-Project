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
				<li class="anchor" id="index"><a href="index.php"><button type="button" class="btn btn-primary">Music-Sharer</button></a></li>
				<?php  
					if (isset($_SESSION['u_id'])) {
						echo 

						'
						<!--li class = "anchor"><a href=music_rooms.php><button type="button" class="btn btn-primary">Music Rooms</button></a></li-->
						<li class = "anchor"><a href=my_music.php><button type="button" class="btn btn-primary">My Music</button></a></li>
						';
					}
				?>
			</ul>
			<div class="nav-login">
				<?php  
					if (isset($_SESSION['u_id'])) {
						echo 
						'<form action="includes/logout.inc.php" method="POST">
							<a href=account.php><button type="button" name="account">Account</button></a>
							<button type="submit" name="logout">Logout</button>

						</form>';
					} else {
						echo 
						'<form action="includes/login.inc.php" method="POST">
							<input type="text" name="uid" placeholder="Username/e-mail">
							<input type="password" name="pwd" placeholder="password">
							<button type="submit" name="login">Login</button>
							<a href="signup.php"><button type="button">Sign up</button></a>
						</form>
						'
						;
					}
				?>
				

				
			</div>
		</div>
	</nav>
</header>

<script type="text/javascript">
	function relocate(dest) {
		location.href = dest;
	}
</script>