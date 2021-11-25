<?php
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$imageFileType = strrchr($_FILES["fileToUpload"]["name"], ".");

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

echo '<br>' . $imageFileType . '<br>';

// Allow certain file formats
if($imageFileType != ".jpg" && $imageFileType != ".png" && $imageFileType != ".jpeg"
&& $imageFileType != ".gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
	$filedainserire = basename($_FILES["fileToUpload"]["name"]);
	include 'connessione.php';
	session_start();
	$IdUtente=$_SESSION['Id'];
	$sql2 = "INSERT INTO Files (FileName, UserId) 
			VALUES ('$filedainserire', '$IdUtente')";
			
	//eseguo la query
	if($conn->query($sql2))
	{
		header("location:UploadFile.php");
	}
	else
	{
		print("<p> Errore nell'inserimento</p>");
	}
	//chiudo la connessione
			$conn->close();
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>