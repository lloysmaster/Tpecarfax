<?php
require_once __DIR__ . '/../models/user.php';

class UserController {
    public function index() {
        $user = new user();
        $users = $user->obtenerUser(); // ya es un array asociativo

        // Paso los datos a la vista
        include __DIR__ . '/../views/vehicle/index.php';
    }
}
?>