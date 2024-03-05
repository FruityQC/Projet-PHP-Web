<?php
    //Database
    $ip = "localhost";
    $uname = "root";
    $password = "";

    $db_name = "resi";

    try {
        $conn = mysqli_connect($ip, $uname, $password, $db_name);
    } catch (Exception $e) {
        die("Erreur Database - Veuillez contacter votre administrateur");
    }
    
    return $conn;
?>