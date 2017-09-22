<?php
	include_once 'header.php';
?>

<div class="parallax">
	<h1 class="hello">Play music with your friends.</h1>
</div>



<section class="main-container">
	<div class="main-wrapper">
		<div style="height:500px;font-size:36px">
			<h2>
				Sharing music is easy, but how about playing it with friends across devices?
			</h2>
			<p>
				Synco-Share is the solution to play music with your peers in a "DJ" like setting. <br>
				Import music, create playlists, and take turns in playing your songs for others. 
			</p>
		</div>
		<?php
			if (isset($_SESSION['u_id'])) {
				echo "You are logged in!";
			}
		?>
	</div>

</section>

<?php
	include_once 'footer.php';
?>
