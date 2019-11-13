<?php

namespace app\controllers;

use core\MVC\Controller as Controller;
use app\models\UserModel;
use core\form\Input;
use core\auth\Auth;

/**
 * Clase para el registro de nuevos usuarios
 */
class RegisterController extends Controller
{
    /**
     * Página donde será redirigido si el registro es correcto
     *
     * @var string
     */
    private $redirect_to = '/';

    /**
     * Registra un nuevo usuario
     *
     * @return boolean
     */
    public function RegisterAction()
    {
        if (isset($_POST["user"])) {
            $name = $_POST["user"];
            $psw = $_POST["password"];
            $psw2 = $_POST["password2"];
            $avatar = $_FILES["avatar"]["name"];
            $tmpFileName = $_FILES["avatar"]["tmp_name"];

            $input = array("name" => $name, "psw" => $psw, "psw2" => $psw2, "avatar" => $avatar);

            if (Input::check($input)) {
                $id = $this->createUser($name, $psw);
                $us = UserModel::find($id);

                $img=$this->uploadAvatar($avatar, $tmpFileName, $id);
                if ($img!=null) {
                    $us->avatar = $img;
                } else {
                    $us->avatar = "avatar0.jpg";
                }

                $us->save();

                $this->renderView("registrado");

            } else {
                $this->renderView("registro");
            }

        } else {
            $this->renderView("registro");
        }
    }

    /**
     * guarda los datos en la tabla usuario y devuelve el id 
     *
     * @param [type] $userName
     * @param [type] $password
     * @return int
     */
    private function createUser($userName, $password)
    {
        $user = new UserModel();
        $user->codigo = null;
        $user->usuario = $userName;
        $user->password = Auth::crypt($password);
        //$user->avatar=$avatar;
        $user->save();
        return UserModel::lastInsertId();
    }

    /**
     * Sube una imagen a la carpeta /public/images/avatares
     *
     * @param string $fileName
     * @param string $tmpFileName
     * @return boolean
     */
    private function uploadAvatar($fileName, $tmpFileName, $idUser)
    {
        //
        $dir = 'public/images/avatares/';
        $img=Input::renameImage($fileName, $idUser);
        $fichero = $dir . basename($img);
        if (isset($_FILES["avatar"])) {
            move_uploaded_file($tmpFileName, $fichero);
        } else {
            $img=null;
        }
        return $img;
    }
}
