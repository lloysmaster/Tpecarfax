<?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $conn;
    private $table = "users";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // login correcto
        }
        return false; // login fallido
    }

    public function register($name, $email, $password, $isAdmin = 0) {
    // Encriptamos la contraseña
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, password, is_admin) 
              VALUES (:name, :email, :password, :is_admin)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hash);
    $stmt->bindParam(':is_admin', $isAdmin, PDO::PARAM_INT);

    return $stmt->execute();
}
}
?>

