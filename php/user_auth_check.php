<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function requireUserApi()
{
    if (empty($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
        http_response_code(401);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode([
            "status" => "unauthorized",
            "message" => "Vui lòng đăng nhập tài khoản khách hàng!"
        ], JSON_UNESCAPED_UNICODE);
        exit();
    }
}

if (basename($_SERVER['SCRIPT_FILENAME']) === 'user_auth_check.php') {
    header("Content-Type: application/json; charset=UTF-8");
    $loggedIn = (!empty($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true);
    echo json_encode([
        "logged_in" => $loggedIn,
        "user" => $loggedIn ? [
            "id" => $_SESSION['user_id'] ?? null,
            "full_name" => $_SESSION['user_name'] ?? '',
            "phone" => $_SESSION['user_phone'] ?? '',
            "email" => $_SESSION['user_email'] ?? ''
        ] : null
    ], JSON_UNESCAPED_UNICODE);
    exit();
}