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
            return $user;
        }
        return false; 
    }

    public function register($name, $email, $password, $role = 'user') {
    // Encriptacion
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, password, role) 
              VALUES (:name, :email, :password, :role)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hash);
    $stmt->bindParam(':role', $role, PDO::PARAM_STR);

    return $stmt->execute();
}
}
?>

