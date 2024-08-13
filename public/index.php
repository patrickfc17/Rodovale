<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Rodovale\Database\DAO\ViagensDAO;
use Rodovale\Exceptions\NotFoundException;

$routes = require_once __DIR__ . '/../src/routes.php';

try {
    $routeURIs = array_keys($routes);
    $action = $routes[$_SERVER['REQUEST_URI']];
    $params = [];

    if ($_SERVER['REQUEST_URI'] !== '/' and str_ends_with($_SERVER['REQUEST_URI'], '/'))
        $_SERVER['REQUEST_URI'] = implode('', array_slice(str_split($_SERVER['REQUEST_URI']), 0, count(str_split($_SERVER['REQUEST_URI'])) - 1));

    foreach ($routeURIs as $key => $route) {
        if ($action) break;

        if (!str_contains($route, ':')) continue;

        unset($routeURIs[$key]);
        $routeURIs[$route] = preg_replace('/:\w+[^\/]/i', '', $route);

        $commonParts = explode('//', $routeURIs[$route]);

        $requestRoute = $_SERVER['REQUEST_URI'];
        foreach ($commonParts as $part)
            $requestRoute = str_replace($part, '', $requestRoute);

        $params = explode('/', $requestRoute);

        $requestRoute = $_SERVER['REQUEST_URI'];
        foreach ($params as $param)
            $requestRoute = str_replace($param, '', $requestRoute);

        if ($routeURIs[$route] === $requestRoute) {
            $action = $routes[$route];
            break;
        }
    }

    if (!$action)
        throw new NotFoundException('Essa rota não foi encontrada no servidor');

    [$controller, $method] = explode('@', $action);

    $reflectionClass = new ReflectionClass("Rodovale\\Controllers\\$controller");

    $controller = $reflectionClass->newInstance(ViagensDAO::getInstance());

    if ($params and isset($_REQUEST))
        $params[] = (object) $_REQUEST;

    $params = $params ?: [(object) $_REQUEST];

    call_user_func($controller->{$method}(...), ...$params);
} catch (NotFoundException) {
    require_once __DIR__ . '/pages/not-found.php';
} catch (Exception) {
    require_once __DIR__ . '/pages/error.php';
}
