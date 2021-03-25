<?php 
namespace App\HTTP;

class Request
{   
	private static $exist = false;	

	private string $request_method;
	private array $request_data;
	private array $post_params;

	public function __construct(){
		if(self::$exist === true) throw new \Exception("Объект запроса может существовать только в единственном экземпляре");
		self::$exist = true;
		$this->request_method = $_SERVER['REQUEST_METHOD'];
		$this->setRequestData();

	}	


	public function getRequestMethod():string{
		return $this->request_method;
	}

	private function setRequestData(){
		if(!empty($_GET)){
			$this->request_data['GET'] = $_GET;
			$_GET = [];
		}

		else if(!empty(json_decode(file_get_contents("php://input")))){
			$this->request_data['POST'] = json_decode(file_get_contents("php://input"),true);
		}
		else{
			$this->request_data = [];
		}
	}

	public function getRequestData($key){
		if(array_key_exists($key, $this->request_data))return $this->request_data[$key];
		return [];
	}

	public function getURI():string{
		return $_SERVER['REQUEST_URI'];
	}




}




 ?>