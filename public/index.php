<?php

use Database\DAO\ViagensDAO;

require_once __DIR__ . '/../vendor/autoload.php';

$routes = require_once __DIR__ . '/../src/routes.php';

try {
    foreach ($routes as $route => $action) {
        if ($_SERVER['REQUEST_URI'] !== $route) continue;

        [$controller, $method] = explode('@', $action);

        $controller = new $controller(ViagensDAO::getInstance());

        $controller->{$method}((object) $_REQUEST);
    }
} catch (Exception) {
    require_once __DIR__ . '/pages/error.php';
}
