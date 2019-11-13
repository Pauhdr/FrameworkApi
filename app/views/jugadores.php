<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Portada</title>
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/main.css" />
</head>
<body>
<?php
    include "menu.php";
?>
<div class="content">
<div class="plantilla"> 
    <?php
        $player="";
        foreach ($data as $key => $value) {
            $player.= 
            "<a href='jugador/".preg_replace('/\s+/','',$data[$key]->codigo)."/' class='jugador'>
            <figure class='playersTeam'> 
                <img src='public/images/jugador.jpg' width= '50%'>   
                <figcaption>".$data[$key]->Nombre."</figcaption>
            </figure>
            </a>";
        }
        echo $player;
    ?>
        
    </div>
    <div class="gestion">
        <div class="botones-centro">
        <a class="boton" href="jugadores/insertar">INSERTAR</a>
        <a class="boton" href="jugadores/borrar">BORRAR</a>
        <a class="boton" href="jugadores/actualizar">ACTUALIZAR</a>
    </div></div>
</div>    
</body>
</html>