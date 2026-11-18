<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

// Nhận số điện thoại từ GET hoặc POST JSON
$input = json_decode(file_get_contents('php://input'), true) ?: [];
$rawPhone = $_GET['phone'] ?? $input['phone'] ?? '';

// Chuẩn hóa SĐT: chỉ giữ lại chữ số để tránh lệch do dấu chấm/khoảng trắng (VD: 0909.123.456 -> 0909123456)
$cleanPhone = preg_replace('/[^0-9]/', '', trim($rawPhone));

if (strlen($cleanPhone) < 8) {
    echo json_encode([
        "status" => "error",
        "message" => "Vui lòng nhập số điện thoại hợp lệ (ít nhất 8 chữ số)!"
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

if (!$pdo) {
    echo json_encode([
        "status" => "error",
        "message" => "Không thể kết nối cơ sở dữ liệu MySQL."
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

try {
    // 1. Lấy danh sách đơn đặt cọc theo SĐT (so sánh sau khi loại bỏ dấu chấm/khoảng trắng)
    $stmtDep = $pdo->prepare("
        SELECT id, car_name, car_price, memo, customer_name, customer_phone, status, created_at
        FROM deposits
        WHERE REPLACE(REPLACE(REPLACE(customer_phone, '.', ''), ' ', ''), '-', '') = ?
        ORDER BY id DESC
    ");
    $stmtDep->execute([$cleanPhone]);
    $deposits = $stmtDep->fetchAll();

    // 2. Lấy danh sách lịch lái thử / tư vấn theo SĐT
    $stmtBook = $pdo->prepare("
        SELECT id, customer_name, phone, car_name, booking_date, note, status, created_at
        FROM bookings
        WHERE REPLACE(REPLACE(REPLACE(phone, '.', ''), ' ', ''), '-', '') = ?
        ORDER BY id DESC
    ");
    $stmtBook->execute([$cleanPhone]);
    $bookings = $stmtBook->fetchAll();

    echo json_encode([
        "status" => "success",
        "phone" => $cleanPhone,
        "deposits" => $deposits,
        "bookings" => $bookings
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Lỗi truy vấn dữ liệu: " . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
