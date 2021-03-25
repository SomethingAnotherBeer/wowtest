<?php 
namespace App\Core;

class Configuration
{
	private array $conf;

	public function __construct(array $configuration){
		$this->conf = $configuration;
		
	}

	public function __get(string $key){
		if(array_key_exists($key, $this->conf)) return $this->conf[$key];
		return "Ключа не существует";
	}
}





 ?>