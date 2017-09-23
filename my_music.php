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

				// music player
				echo '
				<div class="audio">
					<audio src="" controls id="audioPlayer">
						html5 audio player not supported!
					</audio>
				</div>
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
							<p>Options</p>
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
								<a href="uploaded_music/'. $fileName .'"><button type="button" class="btn btn-primary">Play</button></a>
							</div>
						</div>
						';
					}
				}

				echo '</div>'; // end of container
			}
		?>

	</div>

</section>

<script src="https://code.jquery.com/jquery-2.2.0.js"></script>

<script>
	audioPlayer();
	function audioPlayer() {
		var currentSong = 0;
		//$("#audioPlayer")[0].src = $("#music a")[0];
		$("#music a").click(function(e) {
			e.preventDefault();
			$("#audioPlayer")[0].src = this;
			$("#audioPlayer")[0].play();

			//currentSong = $(this).parent();
			$("#music a").removeClass("currentSong");
			$(this).addClass("currentSong");
		});
	}
</script>

<?php
	include_once 'footer.php';
?>
