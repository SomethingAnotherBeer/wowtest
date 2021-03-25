<?php 
namespace App\Includes;

class DB
{
	private static $connection;

	public static function initConnection(array $connection_params){
		$host = $connection_params['host'];
		$dbname = $connection_params['dbname'];
		$user = $connection_params['user'];
		$password = $connection_params['password'];

		self::$connection = new \PDO("mysql:host = $host;dbname=$dbname",$user,$password);
		self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	public static function getConnection(){
		return self::$connection;
	}


}


?>