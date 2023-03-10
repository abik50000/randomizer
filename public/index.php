<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once '../config/config.php';
require_once '../app/Helpers/common.php';
require_once '../routes/api.php';
require_once '../app/Core/Router.php';


$app = \App\Core\App::getInstance();

$router = $app->getRouter()->initialize($routes);



