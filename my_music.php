<?php
	include_once 'header.php';
	include_once 'includes/dbh.inc.php';
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>My Music</h2>
		<?php
			$u_id = $_SESSION["u_id"];
			if (isset($_SESSION['u_id'])) {
				echo '
				<form action="upload.php" method="POST" enctype="multipart/form-data">
					<input type="file" name="file">
					<input type="text" name="song_name" placeholder="Song Name">
					<input type="text" name="artist" placeholder="Artist">
					<input type="text" name="album" placeholder="Album (optional)">
					<input type="text" name="genre" placeholder="Genre (optional)">
					<button type="submit" name="upload" class="btn btn-primary">Upload .mp3 file</button>

					<input type="hidden" name="u_id" value=' . $u_id .'>
				</form>
				';

				$sql = "SELECT * FROM music WHERE userid = '$u_id' ORDER BY creation_time DESC";
				$result = mysqli_query($conn, $sql);

				echo '
				<div class="container" id="music">
					<div class="row" id="music_table">
						<div class="col-xs-4" id="top">
							<p>Song Name</p>
						</div>
						<div class="col-xs-2" id="top">
							<p>Artist</p>
						</div>
						<div class="col-xs-2" id="top">
							<p>Album</p>
						</div>
						<div class="col-xs-2" id="top">
							<p>Genre</p>
						</div>
						<div class="col-xs-2" id="top">
							<p>Playback</p>
						</div>
					</div>
				';
				if (mysqli_num_rows($result) > 0) {
					// output data of each row
					while($row = mysqli_fetch_assoc($result)) {
						$uniqueid = $row["uniqueid"];
						$fileName = $uniqueid.".mp3";
						echo'
						<div class="row" id="music_table">
							<div class="col-xs-4">
								<p>' . $row["song_name"] . '</p>
							</div>
							<div class="col-xs-2">
								<p>' . $row["artist"] . '</p>
							</div>
							<div class="col-xs-2">
								<p>' . $row["album"] . '</p>
							</div>
							<div class="col-xs-2">
								<p>' . $row["genre"] . '</p>
							</div>
							<div class="col-xs-2">
								<button type="button" class="btn btn-primary">Play</button>
								<audio controls>
									<source src="uploaded_music/'. $fileName .'" type="audio/mpeg">
								</audio>
							</div>
						</div>
						';
					}
				}

				echo '</div>'; // end of container
				/*
				<div class="container" id="music">
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
		*/
			}
		?>

		

	</div>

</section>

<?php
	include_once 'footer.php';
?>
