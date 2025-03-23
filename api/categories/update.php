<?php
header("Content-Type: application/json");
include_once "../../config/db.php";
include_once "../../models/Category.php";

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);
$data = json_decode(file_get_contents("php://input"));


try{
    if (!empty($data->id) && !empty($data->name)) {
        $category->id = $data->id;
        $category->name = $data->name;
    
        if ($category->update()) {
            http_response_code(200);
            echo json_encode(["message" => "Category updated successfully"]);
        } else {
            http_response_code(200);
            echo json_encode(["message" => "Category could not be updated"]);
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