<?php
use core\database\DB as DB;
use app\models\JugadorModel;
$jugador = new JugadorModel();
foreach ($data as $key => $value) {
    //esta seria la forma correcta de hacerlo, pero en este caso concreto, asignamos el valor a mano para poder usarlo después
    // if($key=$jugador->key){
    //     $jugador->$key=JugadorModel::lastInsertId();
    // }else{
    //     $jugador->$key = $value;
    // }
    $jugador->$key = $value;
}
$jugador->save();

header("Location:".$GLOBALS["config"]["site"]["root"]."/jugadores");