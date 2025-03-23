<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // جلب جميع المنتجات
    public function read() {
        $query = "SELECT id, name, description, price, category_id FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // إنشاء منتج جديد
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, description, price, category_id) 
                  VALUES (:name, :description, :price, :category_id)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category_id);

        return $stmt->execute();
    }

    // تحديث المنتج
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = :name, description = :description, 
                  price = :price, category_id = :category_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // حذف المنتج
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}
?>
