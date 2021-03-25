<?php 
namespace App\Model;
use App\Includes;

abstract class Model
{
	protected $connection;

	public function __construct(){
		$this->connection = Includes\DB::getConnection();
	}


	protected function prepareQueryToArray($query):array{
		$result_arr = [];

		while($row = $query->fetch(\PDO::FETCH_ASSOC)){
			$result_arr[] = $row;
		}
		
		return $result_arr;


	}

	protected function prepareAndGetQueryCondition(string $query_string, string $query_condition) : string{
		return (strpos($query_string, 'WHERE')) ? str_replace('WHERE', 'AND', $query_condition) : $query_condition;

	}


}






 ?>