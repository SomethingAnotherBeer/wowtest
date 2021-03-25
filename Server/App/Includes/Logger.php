<?php 
namespace App\Includes;
use App\Helpers;

class Logger
{
	private $logs_path;
	private $logs_params;

	public function __construct(){
		$this->logs_path = "App/Logs/logs.txt";

		$this->logs_params =[
			'current_date'=>function(){
				return " Дата: ". date("Y m d G:i:s");
			}

		];
	}

	public function writeLog(string $log_string){
		$prepared_log = $this->prepareAndGetLog($log_string,$this->logs_params);
		Helpers\File::appendFile($this->logs_path,$prepared_log."\n");
		
	}


	private function prepareAndGetLog(string $log_string,array $logs_params):string{
		$logs_adds = [];

		foreach($logs_params as $log_key=>$log_value){
			$logs_adds[] = $logs_params[$log_key]();
		}

		return $log_string . implode(' : ', $logs_adds);
	}

}






 ?>