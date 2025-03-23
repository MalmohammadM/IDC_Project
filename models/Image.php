<?php
class Image {
    private $conn;
    private $table_name = "product_images";

    public $id;
    public $product_id;
    public $image_url;

    public function __construct($db) {
        $this->conn = $db;
    }

    // رفع صورة جديدة
    public function upload() {
        $query = "INSERT INTO " . $this->table_name . " (product_id, image_url) VALUES (:product_id, :image_url)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":image_url", $this->image_url);

        return $stmt->execute();
    }

    // حذف صورة
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}