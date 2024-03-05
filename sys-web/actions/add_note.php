<?php
include '../config/functions.php';

LoggedInOnly();


$target_dir = "../img/notes";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if (isset($_POST['submit']) && isset($_GET['id'])) {
    $room = $_GET['id'];
    $user = $_SESSION['username'];
    $note = $_POST['note'];

    $imgadded = false;
    
    // Check if image file is a actual image or fake image
    if($_FILES["fileToUpload"]["name"] != NULL) {
        $imgadded = true;
        $img = $_FILES["fileToUpload"]["name"];
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        } else {
        echo "File is not an image.";
        $uploadOk = 0;
        }
    }

    if ($imgadded == true) {
        $sql = "INSERT INTO notes(roomid, user, note, image) VALUES ($room, '$user', '$note', '$img')";
    } else {
        $sql = "INSERT INTO notes(roomid, user, note) VALUES ($room, '$user', '$note')";
    }
   

    $result = mysqli_query($conn, $sql);

    // Checks

    if ($result) {
        header("Location: ../view.php?id=$room&msg=Note ajoutée avec succès");
        LogAction($_SESSION['username'] . ' a ajouter une note a la chambre numero ' . $room);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      }

} else {
    header("Location: ../home.php?error=Erreur lors de la modification de la note");
}


?>