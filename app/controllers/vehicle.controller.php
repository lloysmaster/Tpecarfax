<?php
require_once __DIR__ . '/../../models/vehicle.php';
require_once __DIR__ . '/../../models/category.php';
require_once __DIR__ . '/init.php';
class VehicleController {

    // ✅ Cualquiera puede ver los vehículos
    public function index($category_id = null) {
        $vehicle = new Vehicle();
        $category = new Category();
        $categories = $category->getAllCategory();

        if ($category_id !== null) {
            $vehicles = $vehicle->getVehicleForCategory($category_id);
        } else {
            $vehicles = $vehicle->obtenerVehicle();
        }

        include __DIR__ . '/../../views/vehicle/index.phtml';
    }

    // 👤 Solo usuarios logueados pueden crear publicaciones
    public function create() {
        requireLogin(); // Cualquier usuario logueado puede publicar

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vehicle = new Vehicle();

            // Opcional: si querés asociar el usuario al vehículo
            $user_id = $_SESSION['user']['id'];

            $vehicle->addVehicle($_POST['name'], $_POST['category_id'], $_POST['price'], $user_id);

            header("Location: ?action=vehiculos");
            exit;
        }

        $category = new Category();
        $categories = $category->getAllCategory();
        include __DIR__ . '/../../views/vehicle/create.phtml';
    }

    // 🛠️ Solo administradores pueden editar
    public function edit($id) {
        requireAdmin();

        $vehicle = new Vehicle();
        $v = $vehicle->getVehicleById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vehicle->updateVehicle($id, $_POST['name'], $_POST['category_id'], $_POST['price']);
            header("Location: ?action=vehiculos");
            exit;
        }

        $category = new Category();
        $categories = $category->getAllCategory();
        include __DIR__ . '/../../views/vehicle/edit.phtml';
    }

    // 🛠️ Solo administradores pueden eliminar
    public function delete($id) {
        requireAdmin();

        $vehicle = new Vehicle();
        $vehicle->deleteVehicle($id);

        header("Location: ?action=vehiculos");
        exit;
    }
    public function modifycationMenu() {
    requireLogin(); // Todos los usuarios logueados pueden ver el panel

    // Si querés restringir opciones según el rol
    $isAdmin = ($_SESSION['user']['role'] === 'admin');

    include __DIR__ . '/../../views/vehicle/manage.phtml';
}
    
}
?>
