<?php 
namespace App\Core;

class Route
{
	private $uri;
	private $routes;

	public function __construct(array $routes,string $uri){
		$this->routes = $routes;
		$this->uri = $uri;
	}

	public function getRoute(){
		$current_uri = $this->clearParams($this->uri);
		return $this->getControllerParams($current_uri);

	}



	private function clearParams(string $uri):string{
		return (strpos($uri,'?')) ? substr($uri, 0, strpos($uri, '?')) : $uri;
	}

	private function getControllerParams(string $uri):array{
		if(isset($this->routes[$uri])){

			$controller =  $this->getController($this->routes[$uri]['controller']);
			$action = $this->getAction($this->routes[$uri]['action']);

			return ['controller'=>$controller,'action'=>$action];
		}
		else{
			throw new \Exception("Неверный маршрут $uri");
		}
	}

	private function getController(string $controller_name):string{
		return "App\\Controllers\\$controller_name"."Controller";	
	}

	private function getAction(string $action_name):string{
		return $action_name;
	}





}





 ?>