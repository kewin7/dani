<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/subloader/loader.php';

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('ROOT_PATH') or define('ROOT_PATH', __DIR__);


if (!isset($_SERVER['APP_ENV'])) {
    if (!class_exists(Dotenv::class)) {
        throw new \RuntimeException('APP_ENV environment variable is not defined. You need to define environment variables for configuration or add "symfony/dotenv" as a Composer dependency to load variables from a .env file.');
    }
    (new Dotenv())->load(__DIR__ . '/.env');
} 

defined('BASE_URL') or define('BASE_URL',$_ENV['BASE_URL']);

$request = Request::createFromGlobals();
(new System\ABA($request))->run();

