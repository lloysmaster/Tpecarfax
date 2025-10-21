<?php
require_once __DIR__ . '/../../models/vehicle.php';
require_once __DIR__ . '/../../models/category.php';

class VehicleController {
    public function index($param=null) {
        $vehicle = new Vehicle();
        $vehicles = $vehicle->obtenerVehicle(); // ya es un array asociativo
        
        $category = new Category();
        $categories = $category->getAllCategory();

        if (!empty($params[0]) && $params[0] === "category" && !empty($params[1])) {
            $category_id = $params[1];
            $vehicles = $vehicle->getVehicleForCategory($category_id);
        } else {
            $vehicles = $vehicle->obtenerVehicle();
        }
        // Paso los datos a la vista
        include __DIR__ . '/../../views/vehicle/index.php';
    }
}
?>