<?php
include '../config/functions.php';

LoggedInOnly();


if (isset($_POST['submit']) && isset($_GET['id'])) {
    $room = $_GET['id'];
    $status = $_POST['status'];
    $nom = $_POST['username'];
    $dob = $_POST['dob'];
    $ass = $_POST['ass'];
    $phone = $_POST['phone'];

    $sql = "UPDATE rooms SET status='$status', nom='$nom', dob='$dob', ass='$ass', phone='$phone' WHERE id=$room";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../home.php?msg=Chambre $room modifiée avec succès");
        LogAction($_SESSION['username'] . ' a modifier la chambre numero ' . $room);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

} else {
    header("Location: ./home.php?msg=Erreur lors de la modification de la chambre $room");
}

?>