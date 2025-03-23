<?php
header("Content-Type: application/json");
include_once "../../config/db.php";
include_once "../../models/Image.php";

$database = new Database();
$db = $database->getConnection();

$image = new Image($db);
$data = json_decode(file_get_contents("php://input"));

try{

    if (!empty($data->product_id) && !empty($data->image_url)) {
        $image->product_id = $data->product_id;
        $image->image_url = $data->image_url;
    
        if ($image->upload()) {
            http_response_code(200);
            echo json_encode(["message" => "Image uploaded successfully"]);
        } else {
            http_response_code(200);
            echo json_encode(["message" => "Image upload failed"]);
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
