<?php
class Category {
    private $conn;
    private $table_name = "categories";

    public $id;
    public $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    // جلب جميع الأصناف
    public function read() {
        $query = "SELECT id, name FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // إنشاء صنف جديد
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name) VALUES (:name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        return $stmt->execute();
    }

    // تحديث الصنف
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    // حذف الصنف
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}
?>
