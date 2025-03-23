<?php
header("Content-Type: application/json");
include_once "../../config/db.php";
include_once "../../models/Category.php";

$database = new Database();
$db = $database->getConnection();

try{
    $category = new Category($db);
    $stmt = $category->read();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    http_response_code(200);
    echo json_encode($categories);
}
catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "خطأ في الخادم: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}

?>
