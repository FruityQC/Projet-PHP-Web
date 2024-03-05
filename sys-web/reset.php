<?php
include_once './config/functions.php';

LoggedInOnly();
if (!CanReset()) {
    header("Location: ./index.php?error=Vous ne pouvez pas réinitialiser votre mot de passe");
}

function CanReset(){
    global $conn;

    $sql = "SELECT reset FROM users WHERE id = " . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row['reset'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['password1'] != $_POST['password2']) {
        header("Location: ./reset.php?error=Les mots de passe ne correspondent pas");
        exit();
    }


    global $conn;

    $password = $_POST['password2'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $userid = $_SESSION['id'];
    $sql = "UPDATE users SET password = '$password', reset = 0 WHERE users.id = $userid";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        Logout("Mot de passe reinitialiser avec succès");
        // header("Location: https://resi.fruitysys.com/config/logout.php?msg=Mot de passe reinitialiser avec succès");
        
    }
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
    <title>Réinitialisation mot de passe</title>
</head>

<body class="bg-dark">
    <form action="" method="post">
        <p class="fs-2">Réinitialisation mot de passe</p>
        <p class="fs-6">Vous devez réinitialiser votre mot de passe avant de continuer</p>

        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_GET['error']; ?>
            </div>
        <?php } ?>
        

        

        <i class="fa-solid fa-key" style="color: #808080;"></i>
        <label>Mot de passe</label>
        <input type="text" name="password1" placeholder="Mot de passe"><br>

        <i class="fa-solid fa-key" style="color: #808080;"></i>
        <label>Refaire Mot de passe</label>
        <input type="password" name="password2" placeholder="Mot de passe"><br>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary me-4">Réinitialiser</button>
        </div>

    </form>
</body>

</html>