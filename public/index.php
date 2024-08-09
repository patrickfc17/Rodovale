<?php

use Database\DAO\ViagensDAO;

require_once __DIR__ . '/../vendor/autoload.php';

$routes = require_once __DIR__ . '/../src/routes.php';

try {
    $action = $routes[$_SERVER['REQUEST_URI']];

    if (!$action)
        throw new Exception('Essa rota não foi encontrada no servidor');

    [$controller, $method] = explode('@', $action);

    $controller = new $controller(ViagensDAO::getInstance());

    $controller->{$method}((object) $_REQUEST);
} catch (Exception) {
    require_once __DIR__ . '/pages/error.php';
}
