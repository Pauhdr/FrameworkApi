<?php

use core\auth\Auth;
//include("core/MVC/Session.php");
?>
<div class="menu">
    <a href=<?= $GLOBALS["config"]["site"]["root"] ?>>
        <div class="opcionMenu">Inicio</div>
    </a>
    <a href=<?= $GLOBALS["config"]["site"]["root"] . ds . "historia" ?>>
        <div class="opcionMenu">Historia</div>
    </a>
    <a href=<?= $GLOBALS["config"]["site"]["root"] . ds . "jugadores" ?>>
        <div class="opcionMenu">Equipo</div>
    </a>

    <?php
    if (Auth::check()) {
        ?>
        <div class='session'>
            <a href=<?= $GLOBALS['config']['site']['root'] .ds. 'logout' ?>>
                <div class='btnLogout'>Log Out</div>
            </a>

            <div class="usuario">
                <div class="user"><?= $_SESSION["usuario"] ?></div>
                <img class="avatar" src=<?=$GLOBALS['config']['site']['root'].ds."public/images/avatares/".$_SESSION['avatar'] ?>>
            </div>

        </div>
    <?php
    } else {
        ?>
        <div class='session'>
            <a href=<?= $GLOBALS['config']['site']['root'] .ds. 'login' ?>>
                <div class='btnLogin'>Log In</div>
            </a>
            <a href=<?= $GLOBALS['config']['site']['root'] .ds. 'register' ?>>
                <div class='btnRegister'>Register</div>
            </a>
        </div>
    <?php
    }
    ?>

</div>