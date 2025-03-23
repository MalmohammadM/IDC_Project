<?php
header("Content-Type: application/json");
include_once "../../config/db.php";
include_once "../../models/Image.php";

$database = new Database();
$db = $database->getConnection();

$image = new Image($db);
$data = json_decode(file_get_contents("php://input"));

try{
    if (!empty($data->id)) {
        $image->id = $data->id;
    
        if ($image->delete()) {
            http_response_code(200);
            echo json_encode(["message" => "Image deleted successfully"]);
        } else {
            http_response_code(200);
            echo json_encode(["message" => "Image could not be deleted"]);
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