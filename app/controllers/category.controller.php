<?php
require_once __DIR__ . '/../../models/category.php';
require_once __DIR__ . '/init.php';
class CategoryController {
    public function index() {
        $category = new Category();
        $categories = $category->getAllCategory();
        
        include __DIR__ . '/../../views/layouts/main.phtml';
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
        if(isAdmin()){
        include __DIR__ . '/../../views/panel/admin/category/create.phtml';
    }else{
        header("Location: ?action=vehicle");
        exit;
    }
    }


    public function edit() {
         if(isAdmin()){
        include __DIR__ . '/../../views/panel/admin/category/edit.phtml';
        }else{
        header("Location: ?action=vehicle");
        exit;
    }
    }


    public function delete() {
         if(isAdmin()){
        include __DIR__ . '/../../views/panel/admin/category/delete.phtml';
        }else{
        header("Location: ?action=vehicle");
        exit;
    }
    }
    
}
?>