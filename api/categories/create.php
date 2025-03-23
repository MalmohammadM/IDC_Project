<?php
header("Content-Type: application/json");
include_once "../../config/db.php";
include_once "../../models/Category.php";

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);
$data = json_decode(file_get_contents("php://input"));

try{
    if (!empty($data->name)) {
        $category->name = $data->name;
    
        if ($category->create()) {
            http_response_code(200);
            echo json_encode(["message" => "Category created successfully"]);
        } else {
            http_response_code(200);
            echo json_encode(["message" => "Category could not be created"]);
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