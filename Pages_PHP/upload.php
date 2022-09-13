<?php
session_start();
ini_set ('display_errors', 1);
ini_set ('display_startup_errors', 1);
error_reporting (E_ALL);
$target_dir = "upload/";
$uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$imageFileType = $_FILES['fileToUpload']['type']; // strrchr($_FILES["fileToUpload"]["name"], ".");

// Check if image file is a actual image or fake image
$file = $_FILES["fileToUpload"]["tmp_name"];
$target_file = $target_dir . basename($file);
if(isset($_POST["submit"])) {
  /*
  $check = getimagesize($file);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
  */
} else {
  $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

echo '<br>' . $imageFileType . '<br>';

// Allow certain file formats

if($imageFileType != "image/jpg" && $imageFileType != "image/png" && $imageFileType != "image/jpeg" && $imageFileType != "image/gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

  if (rename($file, $target_dir . basename($_FILES["fileToUpload"]["name"]))) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        $filedainserire = basename($_FILES["fileToUpload"]["name"]);
        require_once 'connessione.php';
        $IdUtente=1;
//$_SESSION['id'];
        $sql2 = "INSERT INTO files (file_name, user_id)
                        VALUES ('$filedainserire', '$IdUtente')";

        //eseguo la query
        if($conn->query($sql2))
        {
                header("location:uploadfile.php");
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
