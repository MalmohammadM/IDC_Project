<?php
header("Content-Type: application/json");
include_once "../../config/db.php";
include_once "../../models/User.php";

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));
try{
    if (!empty($data->id)) {
        $user->id = $data->id;
    
        if ($user->delete()) {
            http_response_code(200);
            echo json_encode(["message" => "User deleted successfully"]);
        } else {
            http_response_code(200);
            echo json_encode(["message" => "User could not be deleted"]);
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
