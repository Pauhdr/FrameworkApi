<?php

namespace app\controllers;

use core\MVC\Controller as Controller;
use app\models\JugadorModel;

//use core\database\DB as DB;

class PrincipalController extends Controller
{
    function principalAction(){
        $this->renderView("principal");
    }

    function historiaAction(){
        $this->renderView("historia");
    }

    function jugadoresAction(){
        $jugadores = JugadorModel::where("Nombre_equipo", "=", "Lakers")->get();
        $this->renderView("jugadores", $jugadores);
    }

    function insertarAction(){
        
        $insert = array(
            "codigo" => 9999,
            "nombre" => "Manolo",
            "Procedencia" => "UCLA",
            "Altura" => "6-8",
            "Peso" => 210,
            "Posicion" => "F",
            "Nombre_equipo" => "Lakers"
        );
        

        //$jugadores = DB::table('jugadores')->where("Nombre_equipo", "=", "Lakers")->get();
        $this->renderView("insertar", $insert);
    }

    function borrarAction(){
        //$jugadores = DB::table('jugadores')->where("Nombre_equipo", "=", "Lakers")->get();
        $this->renderView("borrar");
    }

    function actualizarAction(){
        $update = array(
            "Peso" => 88800,
            "Posicion" => "G",   
        );
    
        //$jugadores = DB::table('jugadores')->where("Nombre_equipo", "=", "Lakers")->get();
        $this->renderView("actualizar", $update);
    }

    
}
