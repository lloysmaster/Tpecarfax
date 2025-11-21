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

     public function list() {
        requireLogin();

        if (!isAdmin()) {
            echo "solo los administradores pueden ver esta lista.";
            exit;
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategory();

        include __DIR__ . '/../../views/panel/admin/category/list.phtml';
    }


    public function create() {
       requireLogin();

        if (!isAdmin()) {
            echo "permisos insuficientes.";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'];
            $description = $_POST['description'];

            $categoryModel = new Category();
            $categoryModel->createCategory($name, $description);

            header("Location: ?action=panel/category/list");
            exit;
        }

        include __DIR__ . '/../../views/panel/admin/category/create.phtml';
    }


    public function edit() {
        requireLogin();

        if (!isAdmin()) {
            echo "permisos insuficientes.";
            exit;
        }

        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "ID no especificado.";
            exit;
        }

        $categoryModel = new Category();
        $category = $categoryModel->getCategoryById($id);

        if (!$category) {
            echo "La categoria no existe.";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'];
            $description = $_POST['description'];

            $categoryModel->updateCategory($id, $name, $description);

            header("Location: ?action=panel/category/list");
            exit;
        }

        include __DIR__ . '/../../views/panel/admin/category/edit.phtml';
    }
    


    public function delete() {
        requireLogin();

        if (!isAdmin()) {
            echo "No tenes permisos.";
            exit;
        }

        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "ID no especificado.";
            exit;
        }

        $categoryModel = new Category();
        $category = $categoryModel->getCategoryById($id);

        if (!$category) {
            echo "Categoria no encontrada.";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $categoryModel->deleteCategory($id);

            header("Location: ?action=panel/category/list&status=deleted");
            exit;
        }

        include __DIR__ . '/../../views/panel/admin/category/delete.phtml';
    }
    
    
}
?>