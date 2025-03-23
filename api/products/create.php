<?php
header("Content-Type: application/json");
include_once "../../config/db.php";
include_once "../../models/Product.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$data = json_decode(file_get_contents("php://input"));

try{

    if (!empty($data->name) && !empty($data->description) && !empty($data->price) && !empty($data->category_id)) {
        $product->name = $data->name;
        $product->description = $data->description;
        $product->price = $data->price;
        $product->category_id = $data->category_id;
    
        if ($product->create()) {
            http_response_code(200);
            echo json_encode(["message" => "Product created successfully"]);
        } else {
            http_response_code(200);
            echo json_encode(["message" => "Product could not be created"]);
        }
    } else {
        http_response_code(200);
        echo json_encode(["message" => "Incomplete data"]);
    }
}
catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "خطأ في الخادم: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>
