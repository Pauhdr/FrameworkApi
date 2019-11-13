<?php
use core\database\DB as DB;
use app\models\JugadorModel;

$jugador=JugadorModel::find(9999);
foreach ($data as $key => $value) {
    $jugador->$key = $value;
}

$jugador->save();

header("Location:".$GLOBALS["config"]["site"]["root"]."/jugadores");

