<?php
    namespace core\MVC;
    abstract class Controller{
        function run($action=null,$params=null){
            if($action!=null){
                if($params!=null){
                    $this->$action($params);
                }else{
                    $this->$action();
                }
                
            }
        }
        function renderView($viewName, $data=null){
            $view=new View($viewName);
            $view->render($data);
        }
    }