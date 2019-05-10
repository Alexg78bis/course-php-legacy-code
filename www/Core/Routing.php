<?php

declare(strict_types=1);

namespace Core;

class Routing
{
    public static $routeFile = 'routes.yml';

    public static function getRoute($slug): array
    {
        $routes = yaml_parse_file(self::$routeFile);
        if (isset($routes[$slug])) {
            if (empty($routes[$slug]['controller']) || empty($routes[$slug]['action'])) {
                die('Il y a une erreur dans le fichier routes.yml');
            }
            $controller = ucfirst($routes[$slug]['controller']) . 'Controller';
            $action = $routes[$slug]['action'] . 'Action';
            $cPath = 'Controller/' . $controller . '.php';
        } else {
            return ['controller' => null, 'action' => null, 'controllerPath' => null];
        }

        return ['controller' => $controller, 'action' => $action, 'controllerPath' => $cPath];
    }

    public static function getSlug($controller, $action): ?string
    {
        $routes = yaml_parse_file(self::$routeFile);

        foreach ($routes as $slug => $action) {
            if (!empty($action['controller']) &&
                !empty($action['action']) &&
                $action['controller'] == $controller &&
                $action['action'] == $action) {
                return $slug;
            }
        }

        return null;
    }
}
