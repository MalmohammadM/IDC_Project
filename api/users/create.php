<?php
header("Content-Type: application/json");
include_once "../../config/db.php";
include_once "../../models/User.php";

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));

try{

    if (!empty($data->name) && !empty($data->email) && !empty($data->password)) {
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = $data->password;
    
        if ($user->create()) {
            http_response_code(200);
            echo json_encode(["message" => "User created successfully"]);
        } else {
            http_response_code(200);
            echo json_encode(["message" => "User could not be created"]);
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