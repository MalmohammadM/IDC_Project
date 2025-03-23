<?php
header("Content-Type: application/json");
include_once "../../config/db.php";
include_once "../../models/User.php";

$database = new Database();
$db = $database->getConnection();

try {
    $user = new User($db);
    $stmt = $user->read();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($users) > 0) {
        http_response_code(200);
        echo json_encode($users, JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "لم يتم العثور على أي مستخدمين."], JSON_UNESCAPED_UNICODE);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "خطأ في الخادم: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}