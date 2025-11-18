<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './app/controllers/vehicle.controller.php';
require_once './app/controllers/category.controller.php';
require_once './app/controllers/auth.controller.php';

$action = $_GET['action'] ?? 'vehiculos';
$params = explode('/', $action);

$controllerName = array_shift($params); 

switch ($controllerName) {
    case 'vehiculos':
        $controller = new vehicleController();

        if (isset($params[0]) && $params[0] === 'category' && isset($params[1])) {
        $controller->index($params[1]); // llamamos al método category con el id
        } else {
        $controller->index();
        }
        break;

    case 'categorias':
        $controller = new categoryController();
        $controller->index();
        break;


    case 'panel':
    $section = $params[0] ?? 'vehiculos'; // o 'categorias'
    $subAction = $params[1] ?? 'manage';
    $id = $params[2] ?? null;

    switch ($section) {
        case 'categorias':
            $controller = new CategoryController();
            break;
        case 'vehiculos':
            $controller = new VehicleController();
            break;
        default:
            echo "Sección no válida del panel.";
            exit;
        }

    switch ($subAction) {
        case 'create':
            $controller->create();
            break;
        case 'edit':
            if ($id) $controller->edit($id);
            else echo "Falta el ID para editar.";
            break;
        case 'delete':
            if ($id) $controller->delete($id);
            else echo "Falta el ID para eliminar.";
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
