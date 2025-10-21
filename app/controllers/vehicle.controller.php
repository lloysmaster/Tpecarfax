<?php
require_once __DIR__ . '/../../models/vehicle.php';
require_once __DIR__ . '/../../models/category.php';

class VehicleController {
    public function index($category_id = null) {
    $vehicle = new Vehicle();
    $category = new Category();
    $categories = $category->getAllCategory();

    if ($category_id !== null) {
        $vehicles = $vehicle->getVehicleForCategory($category_id);
    } else {
        $vehicles = $vehicle->obtenerVehicle();
    }

    include __DIR__ . '/../../views/vehicle/index.php';
}
}
?>