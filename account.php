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
				echo "You are logged in!";
				echo $u_id;
				echo $username;
				echo $row['email'];

				
				
			}
		?>
	</div>

</section>

<?php
	include_once 'footer.php';
?>
