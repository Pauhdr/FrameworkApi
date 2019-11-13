<?php
    namespace app\controllers;

    use core\MVC\Controller as Controller;
    use app\models\ErrorModel;
    use core\database\DB as DB;

    class ErrorController extends Controller{
        function errorAction(){
            $this->renderView("error");
        }
    }