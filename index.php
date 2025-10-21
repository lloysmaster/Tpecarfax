<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './app/controllers/vehicle.controller.php';
require_once './app/controllers/category.controller.php';

$action = $_GET['action'] ?? 'vehiculos';
$params = explode('/', $action);

$controllerName = array_shift($params); 

switch ($controllerName) {
    case 'vehiculos':
        $controller = new vehicleController();
        $controller->index($params);
        break;

    case 'categorias':
        $controller = new categoryController();
        $controller->index();
        break;

    case 'categorias/agregar':
        $controller = new categoryController();
        $controller->add();
        break;

    default:
        echo "404 - Página no encontrada";
        break;
}


?>
