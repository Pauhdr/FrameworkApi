<?php
use core\MVC\Kernel;
//definimos la ruta del raiz y el separador de directorios
$baseDir=dirname(dirname(__FILE__));
DEFINE("ds",DIRECTORY_SEPARATOR);
require_once($baseDir.ds."core".ds."AutoLoad.php");
//incluimos el archivo de rutas
//$routes = include($baseDir.ds."routes".ds."web.php");

//incluimos el achivo de config y extraemos la ruta relativa
$config= require_once($baseDir.ds."config.php");

session_start();

//obtenemos la url de la pagina a cargar
//$page = $baseDir.ds."public".ds."vistas".ds.parseURI($absPath,$routes);

$kernel=new Kernel();
$kernel->run();