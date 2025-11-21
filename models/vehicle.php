

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

    public function getVehicle() {

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

public function createVehicle($title, $description, $brand, $model, $year, $price, $category_id, $user_id) {
    $query = "INSERT INTO vehicles 
    (title, description, brand, model, year, price, id_category, id_user)
    VALUES (:title, :description, :brand, :model, :year, :price, :category_id, :user_id)";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':brand', $brand);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':user_id', $user_id);

    return $stmt->execute();
}

public function getVehicleById($id) {

    $query = "SELECT 
                v.*,
                u.name AS user_name,
                c.name AS category_name
              FROM vehicles v
              JOIN users u ON v.id_user = u.id
              JOIN category c ON v.id_category = c.id
              WHERE v.id_vehicle = :id
              LIMIT 1";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function updateVehicle($id, $title, $description, $brand, $model, $year, $price, $category_id) {

    $query = "UPDATE vehicles SET
        title = :title,
        description = :description,
        brand = :brand,
        model = :model,
        year = :year,
        price = :price,
        id_category = :category_id
        WHERE id_vehicle = :id";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':brand', $brand);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

public function getVehicleByUser($userId) {
    $query = "SELECT v.*, u.name AS user_name, c.name AS category_name
              FROM vehicles v
              JOIN users u ON v.id_user = u.id
              JOIN category c ON v.id_category = c.id
              WHERE v.id_user = :userId";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function deleteVehicle($id) {
    $query = "DELETE FROM vehicles WHERE id_vehicle = :id";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}



}
?>

