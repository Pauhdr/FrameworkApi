<?php
   return array(
     'get' => array(
       'LeerJugadores'=>array(
         "route" => $GLOBALS["config"]["site"]["subdomain"]."/jugadores",
         "controller"=>"api",
         "action" => "getPlayers"
       )
     ),

     'post'=> array(
       "Insertar" => array(
           "route" => $GLOBALS["config"]["site"]["subdomain"]."/jugadores/insertar",
           "controller"=>"api",
           "action" => "insertPlayers"
       ),
     ),
     'patch'=>array(
       "Actualizar" => array(
           "route" => $GLOBALS["config"]["site"]["subdomain"]."/jugadores/actualizar",
           "controller"=>"api",
           "action" => "updatePlayers"
       ),
      ),
    'put'=>array(

    ),
    'delete'=>array(
      "Borrar" => array(
        "route" => $GLOBALS["config"]["site"]["subdomain"]."/jugadores/borrar",
        "controller"=>"api",
        "action" => "deletePlayers"
    ),
  ));
