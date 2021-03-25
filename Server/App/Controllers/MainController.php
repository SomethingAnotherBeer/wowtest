<?php 
namespace App\Controllers;
use App\HTTP;
use App\Exceptions;

abstract class MainController
{
	protected $request;

	public function __construct(HTTP\Request $request){
		$this->request = $request;
	}

	protected function checkInnerParams(array $inner_params,array $expected_params){
		foreach(array_keys($inner_params) as $inner_param_key){
			if(!in_array($inner_param_key, $expected_params)) throw new \Exception("Ошибка: Ожидаемые параметры не соответствуют фактическим");
		}
	}



	

}





 ?>