<?php
header("Content-Type: application/json");
include_once "../../config/db.php";
include_once "../../models/Product.php";

$database = new Database();
$db = $database->getConnection();

try {
    $product = new Product($db);
    $stmt = $product->read();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($products) > 0) {
        http_response_code(200);
        echo json_encode($products, JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "لم يتم العثور على أي منتجات."], JSON_UNESCAPED_UNICODE);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "خطأ في الخادم: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>

