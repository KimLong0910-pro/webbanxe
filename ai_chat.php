<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

$input = json_decode(file_get_contents('php://input'), true);
$message = strtolower(trim($input['message'] ?? ''));

if (empty($message)) {
    echo json_encode(["reply" => "Vui lòng nhập câu hỏi."]);
    exit();
}

$sql = "SELECT * FROM cars";
$result = $conn->query($sql);
$reply = "";

if ($result && $result->num_rows > 0) {
    while($car = $result->fetch_assoc()) {
        if (stristr($message, $car['name']) || stristr($message, $car['brand'])) {
            $priceFormatted = number_format($car['price'], 0, ',', '.');
            $reply = "Mẫu xe {$car['name']} ({$car['brand']}) có giá {$priceFormatted} VNĐ. Động cơ: {$car['engine']}, Nhiên liệu: {$car['fuel']}.";
            break;
        }
    }
}

if (!$reply) {
    if (strpos($message, 'dien') !== false || strpos($message, 'điện') !== false) {
        $reply = "Showroom đang có các mẫu xe điện nổi bật như VinFast VF3, VF5 Plus, VF8 Plus.";
    } elseif (strpos($message, 'dia chi') !== false || strpos($message, 'diachi') !== false) {
        $reply = "Showroom 4TL tọa lạc tại trung tâm TP.HCM. Bạn có thể xem bản đồ trực tiếp ở trang chủ!";
    } else {
        $reply = "Cảm ơn bạn đã đặt câu hỏi. Bạn có thể tra cứu thông tin chi tiết các dòng xe bằng bộ lọc ở trang chủ!";
    }
}

echo json_encode(["reply" => $reply], JSON_UNESCAPED_UNICODE);
?>