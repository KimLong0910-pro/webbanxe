<?php
session_start();
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Phương thức không hợp lệ"], JSON_UNESCAPED_UNICODE);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
$identifier = trim($input['identifier'] ?? ''); // SĐT hoặc Email
$password = $input['password'] ?? '';

if (empty($identifier) || empty($password)) {
    echo json_encode(["status" => "error", "message" => "Vui lòng nhập SĐT/Email và mật khẩu!"], JSON_UNESCAPED_UNICODE);
    exit();
}

if (!$pdo) {
    echo json_encode(["status" => "error", "message" => "Chưa kết nối được CSDL MySQL"], JSON_UNESCAPED_UNICODE);
    exit();
}

try {
    $cleanPhone = preg_replace('/\D/', '', $identifier);
    $stmt = $pdo->prepare("SELECT id, full_name, phone, email, password FROM customers WHERE phone = ? OR email = ? LIMIT 1");
    $stmt->execute([$cleanPhone, $identifier]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['user_phone'] = $user['phone'];
        $_SESSION['user_email'] = $user['email'] ?? '';

        echo json_encode([
            "status" => "success",
            "message" => "Đăng nhập thành công!",
            "user" => [
                "full_name" => $user['full_name'],
                "phone" => $user['phone']
            ]
        ], JSON_UNESCAPED_UNICODE);
        exit();
    }

    echo json_encode(["status" => "error", "message" => "Thông tin đăng nhập hoặc mật khẩu không chính xác!"], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Lỗi truy vấn: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}