<?php

define('APP_PATH', dirname(__DIR__));
session_start();

require_once APP_PATH.'/vendor/autoload.php';

use App\DB\DataBase;
use \RedBeanPHP\R as R;

use Dotenv\Dotenv;
use App\Http\Request;

//use App\Exceptions\ErrorHandler;
//$error = (new ErrorHandler())->register();

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

if ($_ENV['IS_DEV_MODE'] === true) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}


//$db = new DataBase;
$db = DataBase::connect(
    $_ENV['DB_DRIVER'],
    $_ENV['DB_HOST'],
    $_ENV['DB_NAME'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASSWORD']
);

$request = Request::createFromGlobals();



require_once APP_PATH.'/routes/web.php';
