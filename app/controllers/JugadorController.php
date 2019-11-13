<?php
    namespace app\controllers;

    use core\MVC\Controller as Controller;
    use app\models\JugadorModel;
    use app\models\CommentsModel;
    use core\database\DB as DB;

    class JugadorController extends Controller{
        function jugadorAction($params){ 
            $jugador=JugadorModel::where("codigo","=",$params['jugador'])->get()[0];
            $comm=CommentsModel::where("codigoJugador","=",$params['jugador'])->get();
            
            

            $data=array("jugador"=>$jugador,"comentarios"=>$comm); 
              
            $this->renderView("jugador",$data);      
        }
        function insertCommentAction(){
            $comment=new CommentsModel();
            $comment->comment=$_POST["comment"];
            $comment->codigoUsuario=$_SESSION["codigo"];
            $comment->codigoJugador=$_POST["codigoJugador"];
            $comment->save();

            header("Location:".$GLOBALS["config"]["site"]["root"]."/jugadores");
            $jugador=JugadorModel::where("codigo","=",$_POST["codigoJugador"])->get();  
              
            $this->renderView("jugador",$jugador);
        }
    }