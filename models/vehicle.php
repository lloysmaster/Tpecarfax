<?php
require_once __DIR__ . '/../config/database.php';

class Vehicle {
    private $conn;
    private $table_name = "vehicles";
    private $table_nameUser = "users";
    private $table_nameCategory = "category";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function obtenerVehicle() {

    $query = "SELECT " . $this->table_name . ".*,
    " . $this->table_nameUser. ".name,
    ". $this->table_nameCategory . ".name AS ". $this->table_nameCategory . "_name
    FROM " . $this->table_name . "
    JOIN " . $this->table_nameUser . " ON " . $this->table_name . ".id_user = " . $this->table_nameUser . ".id
    JOIN " . $this->table_nameCategory . " ON " . $this->table_name . ".id_category = " . $this->table_nameCategory . ".id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
    public function getVehicleForCategory($categoryId){
    $query = "SELECT " . $this->table_name . ".*,
                " . $this->table_nameUser . ".name,
                " . $this->table_nameCategory . ".name AS " . $this->table_nameCategory . "_name
              FROM " . $this->table_name . "
              JOIN " . $this->table_nameUser . " 
                  ON " . $this->table_name . ".id_user = " . $this->table_nameUser . ".id
              JOIN " . $this->table_nameCategory . " 
                  ON " . $this->table_name . ".id_category = " . $this->table_nameCategory . ".id
              WHERE " . $this->table_name . ".id_category = :categoryId";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
?>

