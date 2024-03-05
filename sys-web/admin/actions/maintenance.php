<?php
include '../../config/functions.php';
LoggedInOnly();
AdminOnly();

$status = IsMaintenance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    SetMaintenance(!$status);

    header('Location: https://resi.fruitysys.com/admin/');

    echo 'Maintenance variable toggled.';
} else {
    echo 'Invalid request method.';
}
?>