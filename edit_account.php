<?php
	include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>Edit Account</h2>

		<?php
			$uid = $_SESSION["u_id"];
			if (isset($_SESSION['u_id'])) {
				echo '
				<form class="account-form" action="includes/edit.inc.php" method="POST">
					<input type="hidden" name="uid" value=' . $uid .'>
					<input type="text" name="email" placeholder="New E-mail">
					<input type="text" name="username" placeholder="New Username">
					<input type="text" name="first" placeholder="New First Name">
					<input type="text" name="last" placeholder="New Last Name">
					<div id="pw_confirm">
						<input type="Password" name="pwd" placeholder="Confirm with Password">
					</div>
					<div id="edit">
						<button type="submit" class="btn btn-primary" name="account_edit">Confirm</button>
					</div>
				</form>

				<h3>Change Password</h3>
				<form class="account-form" action="includes/edit.inc.php" method="POST">
					<input type="hidden" name="uid" value=' . $uid .'>
					<input type="Password" name="pwd1" placeholder="New Password">
					<input type="Password" name="pwd2" placeholder="Retype New Password">
					<div id="pw_confirm">
						<input type="Password" name="pwd" placeholder="Confirm with Old Password">
					</div>
					<div id="edit">
						<button type="submit" class="btn btn-primary" name="password_edit">Confirm</button>
					</div>
				</form>
				';
			}
		?>
	</div>

</section>

<?php
	include_once 'footer.php';
?>
