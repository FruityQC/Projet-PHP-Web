<?php
include_once "../../config/functions.php";

LoggedInOnly();
AdminOnly();

$userid = $_GET['userid'];
$sql = "UPDATE users SET reset = 1 WHERE users.id = $userid";

$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location: ../index.php?msg=Mot de passe reinitialiser avec succès");
    LogAction($_SESSION['username'] . " a reinitialiser un utilisateur");
}
?>