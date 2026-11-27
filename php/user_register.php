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
$fullName = trim($input['full_name'] ?? '');
$phone = preg_replace('/\D/', '', trim($input['phone'] ?? ''));
$email = trim($input['email'] ?? '');
$password = $input['password'] ?? '';

if (empty($fullName) || !preg_match('/^(0[35789])[0-9]{8}$/', $phone)) {
    echo json_encode(["status" => "error", "message" => "Vui lòng nhập họ tên và số điện thoại di động VN hợp lệ (10 số)!"], JSON_UNESCAPED_UNICODE);
    exit();
}

if (strlen($password) < 6) {
    echo json_encode(["status" => "error", "message" => "Mật khẩu phải có ít nhất 6 ký tự!"], JSON_UNESCAPED_UNICODE);
    exit();
}

if (!$pdo) {
    echo json_encode(["status" => "error", "message" => "Chưa kết nối được CSDL MySQL"], JSON_UNESCAPED_UNICODE);
    exit();
}

try {
    $check = $pdo->prepare("SELECT id FROM customers WHERE phone = ?");
    $check->execute([$phone]);
    if ($check->fetch()) {
        echo json_encode(["status" => "error", "message" => "Số điện thoại này đã được đăng ký tài khoản!"], JSON_UNESCAPED_UNICODE);
        exit();
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO customers (full_name, phone, email, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$fullName, $phone, $email ?: null, $hash]);

    session_regenerate_id(true);
    $_SESSION['user_logged_in'] = true;
    $_SESSION['user_id'] = (int)$pdo->lastInsertId();
    $_SESSION['user_name'] = $fullName;
    $_SESSION['user_phone'] = $phone;
    $_SESSION['user_email'] = $email;

    echo json_encode([
        "status" => "success",
        "message" => "Đăng ký tài khoản thành công!",
        "user" => [
            "full_name" => $fullName,
            "phone" => $phone
        ]
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Lỗi CSDL: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}