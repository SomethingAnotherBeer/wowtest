<?php 
namespace App\Helpers;

class File
{
	private static array $extensions;


	public static function getFile(string $path){
		self::checkFile($path);
		self::initExtensions();
		$extension = self::getExtension($path);
		if(array_key_exists($extension, self::$extensions)) return self::$extensions[$extension]($path);
	}

	public static function appendFile(string $path,$data){
		self::checkFile($path);
		return file_put_contents($path, $data,FILE_APPEND);
	}

	public static function writeFile(string $path,$data){
		self::checkFile($path);
		file_put_contents($path, $data);
	}

	private static function initExtensions(){

		self::$extensions = [
			'json'=>function($path){
				return json_decode(file_get_contents($path),true);
			}

		];
	}	

	private static function getExtension(string $path):string{
		return $extension = substr($path, strpos($path, '.')+1);


	}

	private static function checkFile(string $path){
		if(!file_exists($path)) throw new \Exception("Файл с именем $path не существует");
	}

}





 ?>