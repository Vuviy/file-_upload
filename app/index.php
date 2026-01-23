<?php

declare(strict_types=1);

use App\Router;

require __DIR__ . '/func/functions.php';
require __DIR__ . '/vendor/autoload.php';


$router = new Router();

require __DIR__ . '/routes/web.php';


$response = $router->dispatch();

$response->send();
