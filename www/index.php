<?php

declare(strict_types=1);

use Core\Routing;

session_start();

initialiseRoutingHistory();

function initialiseRoutingHistory(): void
{
    $_SESSION['routingHistory'] = [];
    $_SESSION['sqlHistory'] = [];
}

function addRoutingHistory($page)
{
    $_SESSION['routingHistory'][] = $page;
}

function myAutoloader($class)
{
    $class = substr($class, strpos($class, '\\') + 1);
    $classPath = 'Core/' . $class . '.php';
    $classModel = 'Model/' . $class . '.php';
    $classRepository = 'Repository/' . $class . '.php';
    $valueObject = 'ValueObject/' . $class . '.php';

    addRoutingHistory($class);

    if (file_exists($classPath)) {
        require_once $classPath;
    } elseif (file_exists($classModel)) {
        require_once $classModel;
    } elseif (file_exists($classRepository)) {
        require_once $classRepository;
    } elseif (file_exists($valueObject)) {
        require_once $valueObject;
    }
}

// La fonction myAutoloader est lancé sur la classe appelée n'est pas trouvée
spl_autoload_register('myAutoloader');

// Récupération des paramètres dans l'url - Routing
$slug = explode('?', $_SERVER['REQUEST_URI'])[0];
$routes = Routing::getRoute($slug);
extract($routes);

$container = [];
$container['config'] = require 'config/global.php';
$container += require 'config/di.global.php';

// Vérifie l'existence du fichier et de la classe pour charger le controlleur

if (!file_exists($controllerPath)) {
    die('Le fichier controller ' . $controller . " n'existe pas");
}
require_once $controllerPath;
if (!class_exists('\\Controller\\' . $controller)) {
    die('La class controller ' . $controller . " n'existe pas");
}
//instancier dynamiquement le controller
$cObject = $container['Controller\\' . $controller]($container);
//vérifier que la méthode (l'action) existe
if (!method_exists($cObject, $action)) {
    die('La methode ' . $action . " n'existe pas");
}
//appel dynamique de la méthode
$cObject->$action();
