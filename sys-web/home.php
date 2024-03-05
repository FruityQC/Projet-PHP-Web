<?php
include_once './config/functions.php';

LoggedInOnly();
CheckReset();
$rooms = display_rooms();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <script src="https://kit.fontawesome.com/90d534048f.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maisonnée D'Antan</title>
</head>

<body class="bg-dark">

    <?php echo GetNavBar(); ?>
    
    <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-warning mt-4 ms-4 me-4" role="alert">
            <?php echo $_GET['error']; ?>
        </div>
    <?php } ?>

    <?php if (isset($_GET['msg'])) { ?>
        <div class="alert alert-success mt-4 ms-4 me-4" role="alert">
            <?php echo $_GET['msg']; ?>

        </div>
    <?php } ?>

    <!-- CHAMBRE 1 -->


    <div class="row row-cols-1 row-cols-md-3 m-3 g-4"> <!--Container -->
        <?php while ($room = mysqli_fetch_assoc($rooms)) {
            $id = $room['id'];
            $displayid = $room['displayid'];
        ?>

            <div class="col" style="width: 15rem">
                <div class="card h-100">
                    <img src="./img/bg.JPG" class="card-img-top" alt="...">
                    <div class="card-body">
                        <?php
                        if (GetRoom($id)['status'] == "NORM") {
                            echo '<span class="badge rounded-pill text-bg-info mb-1"><i class="fa-solid fa-home me-1"></i>Normal</span>';
                        } elseif (GetRoom($id)['status'] == "RDV") {
                            echo '<span class="badge rounded-pill text-bg-dark text-white mb-1"><i class="fa-solid fa-people-group me-1"></i>Rendez-Vous</span>';
                        } elseif (GetRoom($id)['status'] == "HOS") {
                            echo '<span class="badge rounded-pill text-bg-danger mb-1"><i class="fa-solid fa-star-of-life me-1"></i>Hôpital</span>';
                        } elseif (GetRoom($id)['status'] == "SORT") {
                            echo '<span class="badge rounded-pill text-bg-warning mb-1"><i class="fa-solid fa-car-side me-1"></i>En Sortie</span>';
                        } elseif (GetRoom($id)['status'] == "OTH") {
                            echo '<span class="badge rounded-pill text-bg-success mb-1">Autre</span>';
                        }

                        ?>

                        <h5 class="card-title">Chambre <?php echo $displayid ?></h5>
                        <h6 class="text-muted"><?php echo GetRoom($id)['nom'] ?></h6>

                        <h6 class="card-text"><i class="fa-solid fa-baby-carriage me-2"></i><?php echo GetRoom($id)['dob'] ?></h6>
                        <h6 class="card-text"><i class="fa-solid fa-address-card me-2"></i><?php echo GetRoom($id)['ass'] ?></h6>

                        <div class="d-grid gap-2 mt-3">
                            <a href="./view.php?id=<?php echo $id ?>" class="btn btn-primary">Ouvrir</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>

</html>