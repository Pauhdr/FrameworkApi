<?php
return array(
    "routes" => array(
        "/" => array(
            "route" => $GLOBALS["config"]["site"]["subdomain"]."/",
            "controller"=>"principal",
            "action" => "principal"
        ),

        "Jugadores" => array(
            "route" => $GLOBALS["config"]["site"]["subdomain"]."/jugadores",
            "controller"=>"principal",
            "action" => "jugadores"
        ),
        "Historia" => array(
            "route" => $GLOBALS["config"]["site"]["subdomain"]."/historia",
            "controller"=>"principal",
            "action" => "historia"
        ),
        "Jugador" => array(
            "route" => $GLOBALS["config"]["site"]["subdomain"]."/jugador/:jugador",
            "controller"=>"jugador",
            "action" => "jugador"
        ),
        "Login" => array(
            "route" => $GLOBALS["config"]["site"]["subdomain"]."/login",
            "controller"=>"login",
            "action" => "login"
        ),
        "Register" => array(
            "route" => $GLOBALS["config"]["site"]["subdomain"]."/register",
            "controller"=>"register",
            "action" => "register"
        ),
        "RegistroUsuario" => array(
            "route" => $GLOBALS["config"]["site"]["subdomain"]."/registroUsuario",
            "controller"=>"register",
            "action" => "register"
        ),
        "CompruebaLogin" => array(
            "route" => $GLOBALS["config"]["site"]["subdomain"]."/compruebaLogin",
            "controller"=>"login",
            "action" => "validate"
        ),
        "Logout" => array(
            "route" => $GLOBALS["config"]["site"]["subdomain"]."/logout",
            "controller"=>"login",
            "action" => "logout"
        ),
        "InsertComment" => array(
            "route" => $GLOBALS["config"]["site"]["subdomain"]."/insertComment",
            "controller"=>"jugador",
            "action" => "insertComment"
        ),
    ),
    "error" => array(
        "controller"=>"error",
        "action"=>"error"
    )
);
