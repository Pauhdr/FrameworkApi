<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Jugador</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../../public/css/main.css" />
</head>

<body>
    <?php

use core\auth\Auth;
use app\models\UserModel;

include "menu.php";
    ?>
    <div class="content">
        <?php
        //$data=$data[0];
        
        echo $data["jugador"]->Nombre . "<br>" . $data["jugador"]->Posicion . "<br>" . $data["jugador"]->Peso;
        ?>
        <div class="comentarios">
        <h3>Comentarios</h2><hr>
        <?php
        if(Auth::check()){
        ?>
        <form action= "<?= $GLOBALS['config']['site']['root']?>/insertComment" method="post" class="commForm">
            <textarea name="comment" cols="50" rows="5" placeholder="Deja aquí tu comentario..."></textarea>
            <input type="hidden" name="codigoJugador" value= <?=$data["jugador"]->codigo?>>
            <button type="submit" class="btnComm">Enviar</button>
        </form>
        
        <?php
        }else{
            ?>
        <form action= "<?= $GLOBALS['config']['site']['root']?>/insertComment" method="post" class="commForm" onclick="alertSession()">
            <textarea name="comment" cols="50" rows="5" placeholder="Deja aquí tu comentario..." readonly></textarea>
            <input type="hidden" name="codigoJugador" value= <?=$data["jugador"]->codigo?>>
            <button type="submit" class="btnComm" disabled>Enviar</button>
        </form>
        <script>
            function alertSession(){
                alert("Para dejar un comentario debe iniciar sesión");
            }
        </script>
        <?php
        }
        foreach ($data["comentarios"] as $comment) {
            $usuario=UserModel::find($comment->codigoUsuario);
            $avatar=$usuario->avatar;
            $nombre=$usuario->usuario;
            ?>
        <img src=<?=$GLOBALS['config']['site']['root'].ds."public/images/avatares/".$avatar ?> class="avatar">
        <div class="comment">   
            <div class="titulo"><h3><?=$nombre?>:</h3></div>
            <hr>
            <div class="msg"><?=$comment->comment?></div>
        </div> 
        <br>       
        <?php
        }
        ?>
        </div>
    </div>
</body>

</html>