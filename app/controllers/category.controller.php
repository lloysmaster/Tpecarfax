<?php
require_once __DIR__ . '/../../models/category.php';
require_once __DIR__ . '/init.php';
class CategoryController {
    public function index() {
        $category = new Category();
        $categories = $category->getAllCategory();
        
        include __DIR__ . '/../../views/vehicle/index.phtml';
    }

    public function manage() {
       if (isAdmin()) {
        $category = new Category();
        $categories = $category->getAllCategory();
        include __DIR__ . '/../../views/vehicle/admin/manage.phtml';
    } else {
        include __DIR__ . '/../../views/vehicle/user/manage.phtml';
    }
    }
    public function create() {

    }
    public function edit() {

    }
    public function delete() {

    }
    
}
?>