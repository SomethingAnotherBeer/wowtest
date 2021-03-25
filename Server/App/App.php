<?php 
namespace App;

class App
{
	private $configuration;

	public function __construct(Core\Configuration $configuration){
		$this->configuration = $configuration;

	}

	public function start(){
		
		try{
			Includes\DB::initConnection($this->configuration->db);
			$request = new HTTP\Request();

			$route = new Core\Route(Helpers\File::getFile($this->configuration->patches['routes']),$request->getURI());
			$controller_params = $route->getRoute();

			$controller =  new $controller_params['controller']($request);
			$action = $controller_params['action'];

			$controller->$action();
		}
		catch(\Exception $e){
			$logger = new Includes\Logger();
			$logger->writeLog($e->getMessage());

		}

		


		


	}



	private function init(){
		Includes\DB::initConnection($this->configuration->db);

	}


}



 ?>