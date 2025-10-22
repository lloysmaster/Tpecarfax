<?php
require_once __DIR__ . '/../../models/category.php';

class CategoryController {
    public function index() {
        $category = new Category();
        $categorys = $category->getAllCategory(); // ya es un array asociativo
        
        // Paso los datos a la vista
        include __DIR__ . '/../../views/vehicle/index.phtml';
    }
    
}
?>