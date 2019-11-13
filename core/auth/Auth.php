<?php
namespace core\auth;
use app\models\UserModel;

/**
 * Clase para validar usuarios
 */
class Auth {

    /**
     * Devuelve la contraseña encriptada
     *
     * @param string $password
     * @return string
     */
    static function crypt($password) {
        $crypted=password_hash($password,PASSWORD_DEFAULT);
        return $crypted;
    }

    /**
     * Verifica que el usuario y la contraseña sea correcta
     *
     * @param [type] $password
     * @param [type] $idUser
     * @return boolean
     */
    static function passwordVerify($password, $idUser) {
        $user=UserModel::where("usuario","=",$idUser)->get()[0];
        $res=null;
        if(password_verify($password,$user->password)){
            $res=$user;
        }
        return $res;
    }

    /**
     * Comprueba si el usuario está logeado
     *
     * @return boolean
     */
    static function check() {
        if(isset($_SESSION["loged"])){
            return $_SESSION["loged"];
        }else{
            return false;
        }
        
    }

}
