<?php
namespace app\controllers;

use core\MVC\Controller as Controller;
use app\models\UserModel;
use core\form\Input;
use core\auth\Auth;


/**
 * Clase para el login de usuarios
 */
class LoginController extends Controller {
    /**
     * Página donde será redirigido si el registro es correcto
     *
     * @var string
     */
    private $redirect_to = '/';
/**
     * Carga el formulario de inicio de sesión
     *
     * @return void
     */
    public function loginAction() {
        $this->renderView("login");
    }

    /**
     * Comprueba si los datos son correctos
     *
     * @return void
     */
    public function ValidateAction() {
        if(isset($_POST["user"])){
            $userName=$_POST["user"];
            $psw=$_POST["password"];
            $user=Auth::passwordVerify($psw,$userName);
            if($user!=null){
                $this->setSession($user);
                $this->renderView("logedIn");
            }else{
                $this->renderView("login");
            }
        }
    }

    /**
     * Destruye la sesión y borra la cookie
     *
     * @return void
     */
    public function LogoutAction() {
        $_SESSION["loged"]=false;
        setcookie("nba_localhost","",time()-1,"/");
        session_destroy();
        header("Location:".$GLOBALS["config"]["site"]["root"]."/");
        
        //unset($_COOKIE ["sesion"]);
        
    }

    /**
     * Crea la cookie y le pasa el id de la sesión
     *
     * @param [type] $userId
     * @return void
     */
    private function setSession($user) {
        //session_start();
        $_SESSION["loged"]=true;
        $_SESSION["usuario"]=$user->usuario;
        if($user->avatar==null){
            $_SESSION["avatar"]="avatar0.jpg";
        }else{
            $_SESSION["avatar"]=$user->avatar;
        }
        $_SESSION["codigo"]=$user->codigo;
        setcookie("nba_localhost",session_id(),time()+3600,"/");
    }

}