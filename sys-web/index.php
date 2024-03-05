<?php
session_start();
include_once './config/functions.php';

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    header('Location: ./home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./css/style.css"> 
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/90d534048f.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection</title>
</head>

<body class="bg-dark">
    <form action="./actions/login.php" method="post">
        <h2>Connexion</h2>

        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_GET['error']; ?>
            </div>
        <?php } ?>
        
        <?php if (IsMaintenance()) { ?>
            <div class="alert alert-warning mt-4 me-4" role="alert">
                Connexion impossible, le site est en maintenance.
            </div>
        <?php } ?>

        

        <i class="fa-solid fa-user" style="color: #808080;"></i>
        <label>Utilisateur</label>
        <input type="text" name="uname" placeholder="Utilisateur"><br>

        <i class="fa-solid fa-key" style="color: #808080;"></i>
        <label>Mot de passe</label>
        <input type="password" name="password" placeholder="Mot de passe"><br>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary me-4 <?php if(IsMaintenance() && !IsAdmin()) { ?> disabled <?php } ?>">Connexion</button>
        </div>

    </form>
</body>

</html>