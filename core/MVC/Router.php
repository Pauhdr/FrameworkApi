<?php
namespace core\MVC;
class Router {
	protected $params=array();
	private $routers=array();
	private $errorPage;
	protected function addRoutesFromFile(array $routes) {
		$method= strtolower($_SERVER["REQUEST_METHOD"]);
		foreach ($routes[$method] as $currentRoute) {
			$this->routers[$currentRoute["route"]]=array("controller"=>$currentRoute["controller"],
														 "action"=>$currentRoute["action"]);
			//echo $currentRoute["route"]."---".$currentRoute["page"];
		}
		//$this->errorPage=$routes["error"];

	}

	function parseUriRouter(){
		$uri=trim($_SERVER["REQUEST_URI"], "/");
		$matchesParams=array();

		$page=$this->errorPage;
		foreach ($this->routers as $route=>$cr) {
			$route = trim($route, "/");
			$routerPattern="#^".preg_replace('/\\\:[a-zA-Z0-9\_\-]+/','([a-zA-Z0-9\-\_]+)',preg_quote($route))."$#D";
			if(preg_match_all($routerPattern,$uri,$matchesParams)){

				$keys = array();


				array_shift($matchesParams);

				preg_match_all('/\\:([a-zA-Z0-9\_\-]+)/',$route,$keys);

				array_shift($keys);

				for ($i=0; $i < count($keys[0]); $i++) {
					$this->params[$keys[0][$i]] = $matchesParams[$i][0];

				}
				$page = $cr;
			}

		}
		return $page;
	}

}
