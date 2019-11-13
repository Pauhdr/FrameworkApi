<?php
    namespace app\controllers;

    use core\MVC\Controller as Controller;
    use app\models\JugadorModel;
    //use core\database\DB as DB;

    class ApiController extends Controller{
      public function getPlayersAction(){
          $players=JugadorModel::getAllToApi();
          header("Access-Control-Allow-Origin: *");
          echo json_encode($players);
      }
      public function insertPlayersAction(){

      }
      public function updatePlayersAction(){

      }
      public function deletePlayersAction(){

      }

    }
