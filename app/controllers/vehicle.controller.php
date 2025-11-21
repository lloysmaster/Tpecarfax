<?php
require_once __DIR__ . '/../../models/vehicle.php';
require_once __DIR__ . '/../../models/category.php';
require_once __DIR__ . '/init.php';
class VehicleController {

    public function index($category_id = null) {
        $vehicle = new Vehicle();
        $category = new Category();
        $categories = $category->getAllCategory();

        if ($category_id !== null) {
            $vehicles = $vehicle->getVehicleForCategory($category_id);
        } else {
            $vehicles = $vehicle->getVehicle();
        }

        include __DIR__ . '/../../views/layouts/main.phtml';
    }

    public function manage(){
         requireLogin();
        
    if (isAdmin()) {
        
        include __DIR__ . '/../../views/panel/admin/manage.phtml';

    } else {
       include __DIR__ . '/../../views/panel/user/manage.phtml';
    }
    }

    public function list() {
         requireLogin();

         $model = new Vehicle();

    if (isAdmin()) {
        $vehicles = $model->getVehicle();
        include __DIR__ . '/../../views/panel/admin/vehicle/list.phtml';
    } else {
        $vehicles = $model->getVehicleByUser($_SESSION['user']['id']);
        include __DIR__ . '/../../views/panel/user/vehicle/list.phtml';
    }

    
    }



    public function create() {
    requireLogin();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $title = $_POST['title'];
        $description = $_POST['description'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];

        
        $user_id = $_SESSION['user']['id'];

        $vehicle = new Vehicle();

        $vehicle->createVehicle(
            $title,
            $description,
            $brand,
            $model,
            $year,
            $price,
            $category_id,
            $user_id
        );

        header("Location: ?action=vehicle");
        exit;
    }

    
    $category = new Category();
    $categories = $category->getAllCategory();

    if (isAdmin()) {
    include __DIR__ . '/../../views/panel/admin/vehicle/create.phtml';
    } else {
    include __DIR__ . '/../../views/panel/user/vehicle/create.phtml';
    }

}


public function edit() {
    requireLogin();

    $vehicle_id = $_GET['id'] ?? null;

    if (!$vehicle_id) {
        echo "ID de vehículo no especificado";
        exit;
    }

    $vehicleModel = new Vehicle();
    $vehicle = $vehicleModel->getVehicleById($vehicle_id);

    if (!$vehicle) {
        echo "Vehículo no encontrado";
        exit;
    }

    $currentUserId = $_SESSION['user']['id'];
    $isAdmin = isAdmin();

    
    if (!$isAdmin && $vehicle['id_user'] != $currentUserId) {
        echo "No tenés permiso para editar este vehículo.";
        exit;
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $title = $_POST['title'];
        $description = $_POST['description'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];

        $vehicleModel->updateVehicle(
            $vehicle_id,
            $title,
            $description,
            $brand,
            $model,
            $year,
            $price,
            $category_id
        );

        header("Location: ?action=panel/vehicle/list&status=updated");
        exit;
    }

    
    $category = new Category();
    $categories = $category->getAllCategory();

   
    if ($isAdmin) {
        include __DIR__ . '/../../views/panel/admin/vehicle/edit.phtml';
    } else {
        include __DIR__ . '/../../views/panel/user/vehicle/edit.phtml';
    }
}


    
    public function delete() {
    requireLogin();

    $vehicle_id = $_GET['id'] ?? null;

    if (!$vehicle_id) {
        echo "ID de vehículo no especificado";
        exit;
    }

    $vehicleModel = new Vehicle();
    $vehicle = $vehicleModel->getVehicleById($vehicle_id);

    if (!$vehicle) {
        echo "Vehículo no encontrado";
        exit;
    }

    $currentUserId = $_SESSION['user']['id'];
    $isAdmin = isAdmin();


    if (!$isAdmin && $vehicle['id_user'] != $currentUserId) {
        echo "No tenés permiso para eliminar este vehículo.";
        exit;
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $vehicleModel->deleteVehicle($vehicle_id);

        header("Location: ?action=panel/vehicle/list&status=deleted");
        exit;
    }


    if ($isAdmin) {
        include __DIR__ . '/../../views/panel/admin/vehicle/delete.phtml';
    } else {
        include __DIR__ . '/../../views/panel/user/vehicle/delete.phtml';
    }
}

public function view($id) {
    $vehicleModel = new Vehicle();
    $vehicle = $vehicleModel->getVehicleById($id);

    if (!$vehicle) {
        echo "Vehículo no encontrado.";
        exit;
    }

    include __DIR__ . '/../../views/layouts/view.phtml';
}


    
    
}
?>
