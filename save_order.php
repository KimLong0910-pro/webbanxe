<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data || !isset($data['type'])) {
    echo json_encode(["status" => "error", "message" => "Dữ liệu không hợp lệ"], JSON_UNESCAPED_UNICODE);
    exit();
}

$type = $data['type'];

if (!$pdo) {
    echo json_encode(["status" => "error", "message" => "Chưa kết nối được CSDL MySQL"], JSON_UNESCAPED_UNICODE);
    exit();
}

try {
    if ($type === 'booking') {
        $name = trim($data['name'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $car = trim($data['car'] ?? 'Chưa chọn xe');
        $date = trim($data['date'] ?? date('Y-m-d'));
        $note = trim($data['note'] ?? 'Đăng ký lái thử từ website');

        if (empty($name) || empty($phone)) {
            echo json_encode(["status" => "error", "message" => "Vui lòng nhập tên và số điện thoại"], JSON_UNESCAPED_UNICODE);
            exit();
        }

        $stmt = $pdo->prepare("INSERT INTO bookings (customer_name, phone, car_name, booking_date, note) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $phone, $car, $date, $note]);

        echo json_encode(["status" => "success", "message" => "Đã lưu lịch hẹn lái thử vào hệ thống!"], JSON_UNESCAPED_UNICODE);

    } elseif ($type === 'deposit') {
        $carName = trim($data['car_name'] ?? '');
        $carPrice = floatval($data['car_price'] ?? 0);
        $memo = trim($data['memo'] ?? 'COC XE 4TL');
        $cusName = trim($data['customer_name'] ?? 'Khách quét QR');
        $cusPhone = trim($data['customer_phone'] ?? '');

        $stmt = $pdo->prepare("INSERT INTO deposits (car_name, car_price, memo, customer_name, customer_phone) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$carName, $carPrice, $memo, $cusName, $cusPhone]);

        echo json_encode(["status" => "success", "message" => "Đã ghi nhận giao dịch đặt cọc!"], JSON_UNESCAPED_UNICODE);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Lỗi hệ thống: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>