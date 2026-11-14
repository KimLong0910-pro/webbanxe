<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function requireAdminPage() {
    if (empty($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: login.html');
        exit();
    }
}

function requireAdminApi() {
    if (empty($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        http_response_code(401);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode([
            "status" => "unauthorized",
            "message" => "Từ chối truy cập! Bạn chưa đăng nhập quyền Admin."
        ], JSON_UNESCAPED_UNICODE);
        exit();
    }
}

// Endpoint cho phép các file HTML kiểm tra phiên đăng nhập qua fetch()
if (basename($_SERVER['SCRIPT_FILENAME']) === 'auth_check.php') {
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode([
        "logged_in" => (!empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true),
        "user" => $_SESSION['admin_user'] ?? null
    ], JSON_UNESCAPED_UNICODE);
    exit();
}
?>