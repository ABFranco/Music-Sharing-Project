<?php
	include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>My Account</h2>
		<?php
			
			if (isset($_SESSION['u_id'])) {
				include 'includes/dbh.inc.php';
				$u_id = $_SESSION['u_id'];
				$sql = "SELECT * FROM users WHERE id = '$u_id'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$username = $row['username'];
				$email = $row['email'];
				$firstname = $row['first_name'];
				$lastname = $row['last_name'];


				echo '
				<div class="container" id="account">
					<div class="row" id="account_table">
						<div class="col-xs-6" id="account_table_right">
							<div class="col-xs-5">
								<p>Username</p>
							</div>
							<div class="col-xs-7">
								<p id="account_info">' . $username . '</p>
							</div>
						</div>
						<div class="col-xs-6" id="account_table_left">
							<div class="col-xs-5">
								<p>E-mail</p>
							</div>
							<div class="col-xs-7">
								<p id="account_info">' . $email . '</p>
							</div>
						</div>
					</div>
					<div class="row" id="account_table">
						<div class="col-xs-6" id="account_table_right">
							<div class="col-xs-5">
								<p>First Name</p>
							</div>
							<div class="col-xs-7">
								<p id="account_info">' . $firstname . '</p>
							</div>
						</div>
						<div class="col-xs-6" id="account_table_left">
							<div class="col-xs-5">
								<p>Last Name</p>
							</div>
							<div class="col-xs-7">
								<p id="account_info">' . $lastname . '</p>
							</div>
						</div>

					</div>

					
				</div>
				
				<div id="edit">
					<a href="edit_account.php" class="anchor"><button type="button" class="btn btn-primary">Edit Account</button></a>
				<div>
				';
				
			}
		?>
	</div>

</section>

<?php
	include_once 'footer.php';
?>
