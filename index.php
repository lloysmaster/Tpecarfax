<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './app/controllers/vehicle.controller.php';
require_once './app/controllers/category.controller.php';
require_once './app/controllers/auth.controller.php';

$action = $_GET['action'] ?? 'vehicle';
$params = explode('/', $action);

$controllerName = array_shift($params); 

switch ($controllerName) {
    case 'vehicle':
        $controller = new vehicleController();
        if (isset($params[0]) && $params[0] === 'view' && isset($params[1])) {
        $controller->view($params[1]);
        break;
         }
        if (isset($params[0]) && $params[0] === 'category' && isset($params[1])) {
        $controller->index($params[1]);
        break;
        }


        $controller->index();
        break;

    case 'category':
        $controller = new categoryController();
        $controller->index();
        break;


    case 'panel':
    $section = $params[0] ?? 'vehicle'; 
    $subAction = $params[1] ?? 'manage';
    $id = $params[2] ?? null;

    switch ($section) {
        case 'category':
            $controller = new CategoryController();
            break;
        case 'vehicle':
            $controller = new VehicleController();
            break;
        default:
            echo "Sección no válida del panel.";
            exit;
        }

    switch ($subAction) {
        case 'list':
            $controller->list();
            break;
        case 'create':
            $controller->create();
            break;
        case 'edit':
            $controller->edit();
            break;
        case 'delete':
            $controller->delete();
            break;
        case 'manage':
        default:
            $controller->manage();
            break;
        }
    break;
            
    case 'login':
    $controller = new AuthController();
    $controller->login();
    break;

    case 'register':
    $controller = new AuthController();
    $controller->register();
    break;

    case 'logout':
    $controller = new AuthController();
    $controller->logout();
    break;

    default:
        echo "404 - Página no encontrada";
        break;
}


?>
