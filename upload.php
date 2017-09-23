<?php

if (isset($_POST['upload'])) {
	include_once 'includes/dbh.inc.php';
	$file = $_FILES['file'];
	$u_id = $_POST['u_id'];

	$song_name = mysqli_real_escape_string($conn, $_POST['song_name']);
	$artist = mysqli_real_escape_string($conn, $_POST['artist']);
	$album = mysqli_real_escape_string($conn, $_POST['album']);
	$genre = mysqli_real_escape_string($conn, $_POST['genre']);

	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type'];

	$fileEx = explode('.', $fileName);
	$fileExt = strtolower(end($fileEx)); //get file extension 
	
	$allowed = array('mp3');

	if (in_array($fileExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 25000000) {
				$uniqueid = uniqid('', true);
				$fileNameNew = $uniqueid.".".$fileExt;

				date_default_timezone_set('America/Los_Angeles');
				$timezone = date_default_timezone_get();
				$date = date('Y-m-d H:i:s');
				$sql = "INSERT INTO music (userid, uniqueid, song_name, artist, album, genre, creation_time) 
						VALUES ('$u_id', '$uniqueid', '$song_name', '$artist', '$album', '$genre', '$date');";
				mysqli_query($conn, $sql);

				$fileDest = 'uploaded_music/' . $fileNameNew;
				move_uploaded_file($fileTmpName, $fileDest);
				header("Location: my_music.php?uploadsuccess");
			} else {
				echo "Your file is too large.";
			}
		} else {
			echo "There was an error uploading your file.";
		} 
	} else {
		echo "You can only upload .mp3 files.";
	}

}