<?php
require_once './config/functions.php';

$users = display_users();


//session_start();

LoggedInOnly();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.js"></script>
    <title>Administration</title>
</head>

<body class="bg-dark">
    <?php echo GetNavBar(); ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col">

                <div class="card m-5 p-3 fs-5 fw-semibold"> <!-- ICI ################################################################################### -->

                    <p class="fs-5 fw-bold">A venir dans la version 1.2 🔮</p>
                    <p class="fs-2 fw-bold text-decoration-underline">Planification</p>
                    ❓ Système de suggestions a partir du site <br>
                    ❓ Possibilité de supprimer/ajouter des photos sur les chambres et les notes par vous meme<br>
                </div>

                <div class="card m-5 p-3 fs-5 fw-semibold"> <!-- ICI ################################################################################### -->

                    <p class="fs-5 fw-bold">Version 1.1 - 8 Octobre 2023</p>
                    <p class="fs-2 fw-bold text-decoration-underline">Nouveautés 🤯</p>
                    ✅ Possibilité d'ajouter/supprimer des chambres <br>
                    ✅ Nouveau système de maintenance <br>
                </div>

                
                <div class="card m-5 p-3 fs-5 fw-semibold"> <!-- ICI ################################################################################### -->

                    <p class="fs-5 fw-bold">Version 1.0 - 15 Novembre 2023</p>
                    <p class="fs-2 fw-bold text-decoration-underline">Nouveautés 🤯</p>
                    ✅ Nouveau système de connexion <br>
                    ✅ Nouveau système de logs pour les administrateur <br>
                    ✅ Nouvelle page d'info quoi de neuf (elle en ce moment) <br>

                   
                    <br><br><p class="fs-2 fw-bold text-decoration-underline">Modifications 🔨</p>
                    🔐 Sécurité augmenter <br>
                    ✏️ Modification de la page d'administration <br>
                    ✏️ Corrections erreurs de frappe / traduction <br>
                </div>
            </div>
        </div>
    </div>


</body>

</html>