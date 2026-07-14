<?php
session_start();

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

require_once dirname(__DIR__) . '/config/app.php';
require_once dirname(__DIR__) . '/app/Core/helpers.php';

App\Core\Lang::init();

$router = new App\Core\Router();
require_once dirname(__DIR__) . '/routes/web.php';
$router->dispatch();
