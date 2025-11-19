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
    
    
}
?>
