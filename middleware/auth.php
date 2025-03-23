<?php
function authenticate() {
    if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
        echo json_encode(["message" => "Unauthorized"]);
        exit();
    }
}