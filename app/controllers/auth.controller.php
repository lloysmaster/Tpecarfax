<?php
require_once __DIR__ . '/../../models/User.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->login($email, $password);

            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                header("Location: ?action=vehiculos");
                exit;
            } else {
                $error = "Email o contraseña incorrecta";
            }
        }
        include __DIR__ . '/../../views/auth/login.phtml';
    }
    public function register() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        if ($userModel->register($name, $email, $password)) {
            // Registro exitoso, redirige al login
            header("Location: ?action=login");
            exit;
        } else {
            $error = "No se pudo registrar el usuario. Verifica los datos.";
        }
    }

    include __DIR__ . '/../../views/auth/register.phtml';
}
    public function logout() {
        session_start();
        session_destroy();
        header("Location: ?action=vehiculos");
        exit;
    }
    
}
?>