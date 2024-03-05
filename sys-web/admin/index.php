<?php
require_once '../config/functions.php';

$users = display_users();
$rooms = display_rooms();


//session_start();

LoggedInOnly();
AdminOnly();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.js"></script>
    <title>Administration</title>
</head>

<body class="bg-dark">
    <?php echo GetNavBar(); ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center">Administration Maisonnée D'Antan</h2>
                        <form action="./actions/maintenance.php" method="post">
                            <?php if (IsMaintenance()) { ?>
                                <button type="submit" class="btn btn-success" name="toggleButton">Mode Maintenance Activé</button>
                            <?php } else { ?>
                                <button type="submit" class="btn btn-danger" name="toggleButton">Mode Maintenance Désactivé</button>
                            <?php } ?>
                             
                        </form>
                    </div>
                    
                    <div class="card-body">

                        <?php if (isset($_GET['msg'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_GET['msg']; ?>
                            </div>
                        <?php } ?>

                        <div class="d-grid gap-2 mb-1">
                            <a href="./actions/add_new.php" class="btn btn-success fw-semibold">Ajouter un employee</a>
                        </div>
                        <!-- <div class="d-grid gap-2 mb-3"> ITS UGLY
                            <a href="../home.php" class="btn btn-danger">Retour</a> 
                        </div> -->
                        <table class="table tablet-bordered text-center">
                            <tr class="bg-dark text-white">
                                <td>Nom d'utilisateur</td>
                                <td>Permission</td>
                                <td>Mot de passe</td>
                                <td>Supprimer</td>
                            </tr>
                            <tr>

                                <?php
                                while ($row = mysqli_fetch_assoc($users)) {
                                ?>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $row['titre'] ?></td>
                                    <td><a href="./actions/resetpassword.php?userid=<?php echo $row["id"] ?>">
                                            <button type="submit" class="btn btn-secondary">Reinitialiser</button>
                                        </a>
                                    </td>
                                    

                                    <td>
                                        <!-- No delete technician / Self-->
                                        <?php 
                                        if ($row['titre'] == 'Technicien' || $row['id'] == $_SESSION['id']) { ?>
                                            <button type="submit" class="btn btn-danger" disabled>Supprimer</button>
                                        <?php } else {  ?>
                                            <a href="./actions/delete.php?id=<?php echo $row["id"] ?>">
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </a>
                                        <?php } ?>


                                    </td>
                            </tr>

                        <?php
                                }
                        ?>

                        </table>
                    </div>
                </div>


                <div class="card mt-5 mb-5 p-3">
                    <div class="d-grid gap-2 mb-1">
                      <a href="./actions/add_new_room.php" class="btn btn-success fw-semibold">Ajouter une chambre</a>
                    </div>

                    <table class="table tablet-bordered text-center">
                            <tr class="bg-dark text-white">
                                <td>Numero</td>
                                <td>Occupant</td>
                                <td>Supprimer</td>
                            </tr>
                            <tr>

                                <?php
                                while ($row = mysqli_fetch_assoc($rooms)) {
                                ?>
                                    <td><?php echo $row['displayid'] ?></td>
                                    <td><?php if ($row['nom'] == NULL) {
                                        echo 'Non occupé';
                                    } else {
                                        echo $row['nom'];

                                    } ?>
                                
                                    </td>

                                    <td>
                                        <a href="./actions/deleteroom.php?id=<?php echo $row["id"] ?>">
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </a>
                                    </td>
                            </tr>

                        <?php
                                }
                        ?>

                        </table>
                </div>

                <!-- LOGS -->
                <div class="card mt-5 mb-5 p-3"> 
                    <p class="fw-bold"> <?php GetLog(); ?> </p>
                    <div class="d-grid gap-2 mb-1">
                        <a href="./actions/resetLogs.php" class="btn btn-warning fw-semibold disabled">Réinitialiser</a>
                    </div>
                </div>

            </div>
        </div>
    </div>


</body>

</html>