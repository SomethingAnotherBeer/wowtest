<?php 
declare(strict_types = 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "App/Includes/autoload.php";
$conf_path = "App/Config/config.json";
$Configuration = new App\Core\Configuration(App\Helpers\File::getFile($conf_path));
$App = new App\App($Configuration);
$App->start();






 ?>