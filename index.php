<?php
use App\Application;
use App\Router;

require_once __DIR__ . '/vendor/autoload.php';

Application::boot(__DIR__);
$router = new Router();
$router->execute();