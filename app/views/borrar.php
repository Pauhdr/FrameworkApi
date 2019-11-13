<?php
use core\database\DB as DB;
use app\models\JugadorModel;

$jugador=JugadorModel::find(9999);
$jugador->delete();

header("Location:".$GLOBALS["config"]["site"]["root"]."/jugadores");