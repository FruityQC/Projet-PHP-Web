<?php
include_once '../../config/functions.php';

LoggedInOnly();
AdminOnly();


if (isset($_POST['submit'])) {
    $displayid = $_POST['displayid'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $ass = $_POST['ass'];
    $phone = $_POST['phone'];


    $sql = "INSERT INTO `rooms`(`id`, `displayid`, `status`, `nom`, `dob`, `ass`, `phone`) VALUES (NULL,'$displayid', 'NORM', '$name', '$dob', '$ass', '$phone')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../index.php?msg=Chambre $displayid créé avec succès");
        LogAction($_SESSION['username'] . " a créé la chambre $displayid");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5 bg-dark text-white">Administration Maisonnée D'Antan</nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Ajouter une nouvelle chambre</h3>
            <div class="text-muted">Veuillez remplir ci-dessous</div>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">

                    <div class="col">
                        <label class="form-label">Numero de chambre:</label>
                        <input type="text" class="form-control" name="displayid" placeholder="45">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prenom et nom:</label>
                    <input type="text" class="form-control" name="name" placeholder="Albert Walker">
                </div>

                <div class="mb-3">
                    <label class="form-label">Date de naissance:</label>
                    <input type="text" class="form-control" name="dob" placeholder="13 Juin 1975">
                </div>

                <div class="mb-3">
                    <label class="form-label">Numero assurance social:</label>
                    <input type="text" class="form-control" name="ass" placeholder="123456789">
                </div>

                <div class="mb-3">
                    <label class="form-label">Telephone:</label>
                    <input type="text" class="form-control" name="phone" placeholder="(111)-222-3333">
                </div>

    

                

                <button  type="submit" class="btn btn-success" name="submit">Sauvegarder</button >
                <a href="../index.php" class="btn btn-danger">Annuler</a>
            </form>
        </div>
    </div>
</body>
</html>