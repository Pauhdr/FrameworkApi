<?php
    namespace core\MVC;

    class View{
        private $view_name;
       // private $data;

        function __construct($name){
            $this->view_name=$name;
        }

        function render($data=null){
            $viewRoute="app".ds."views".ds.$this->view_name.".php";
            if($data!=null){
                
                foreach($data as $key=>$value){
                    $$key=$value;
                }
                
            }
            if(file_exists($viewRoute)){
                //session_name("nba_localhost");
                include $viewRoute;
            }
            
        }
    }