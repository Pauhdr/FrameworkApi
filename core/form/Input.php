<?php

namespace core\form;

/**
 * Clase para validar los campos de un formulario
 */
class Input {
    
    /**
     * Archivos de imagen permitidos
     */
    static $whiteList = array ('jpg', 'png', 'bmp');


    /**
     * Comprueba si se han pasado los campos correctos del formulario
     *
     * @param array $fields
     * @param boolean $on
     * @return boolean
     */
    static function check($fields, $on = false) {
        $correct=false;
        if(self::checkImage($fields["avatar"])&&self::str($fields["name"])&&self::str($fields["psw"])&&self::str($fields["psw2"])){
            if($fields["psw"]==$fields["psw2"]){
                $correct= true;
            }
        }
        return $correct;
    }


    /**
     * Devuelve el valor de un string sanitizado
     *
     * @param string $value
     * @return string
     */
    static function str($value) {
        return filter_var($value,FILTER_SANITIZE_STRING);
    }

    /**
     * Comprueba si la extensión de la imagen es valida
     *
     * @param [type] $path
     * @return boolean
     */
    static function checkImage($path) {
        $correct=false;
        $ext=strtolower(pathinfo($path,PATHINFO_EXTENSION));
        foreach (self::$whiteList as $key) {
            if($ext===$key){
                $correct= true;
            }
        }
        return $correct;
    }

    static function renameImage($name,$idUser){
        $ext=strtolower(pathinfo($name,PATHINFO_EXTENSION));
        return "avatar".$idUser.".".$ext;
    }
}
