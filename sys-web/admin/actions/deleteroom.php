<?php
include_once "../../config/functions.php";

LoggedInOnly();
AdminOnly();

$id = $_GET['id'];
$sql = "DELETE FROM rooms WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location: ../index.php?msg=Chambre supprimer avec succès");
    LogAction($_SESSION['username'] . " a supprimer une chambre");
}
?>