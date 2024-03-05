<?php

function GetNavBar() {
    ob_start(); // Start output buffering
    ?>

    <!-- NAVBAR -->
    <nav class='navbar navbar-expand-lg bg-body-tertiary' data-bs-theme='dark'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='http://localhost/sys-web/'>Maisonnée D'Antan</a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarCollapse'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarCollapse'>
                <ul class='navbar-nav me-auto mb-2 mb-lg-0'>

                    <li class='nav-item'>
                        <a class='nav-link' aria-current='page' href='http://localhost/sys-web/home.php'><u>Menu Principale</u></a>
                    </li>

                    <?php if (IsAdmin()) { ?>
                        <li class='nav-item'>
                            <a class='nav-link' href='http://localhost/sys-web/admin'><u>Menu Administratif</u></a>
                        </li>
                    <?php } ?>

                    <li class='nav-item'>
                        <a class='nav-link' aria-current='page' href='http://localhost/sys-web/whatsnew.php'><u>Quoi de neuf ?</u></a>
                    </li>
                </ul>
                <span class='navbar-text me-4 fs-6'>Bonjour, <?php echo $_SESSION['username']; ?> </span>
                <a class='btn btn-outline-danger me-2' type='button' href='http://localhost/sys-web/config/logout.php'>Déconnexion</a>
            </div>
        </div>
    </nav>

    <?php if (IsMaintenance()) { ?>
        <div class="alert alert-warning mt-4 ms-4 me-4" role="alert">
            Mode Maintenance 
        </div>
    <?php } ?>
    <!-- NAVBAR END-->

    
    <?php
    $html = ob_get_clean(); // Get the output and clear the buffer
    return $html;
}
?>