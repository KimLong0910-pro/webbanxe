<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'db.php';

$input = json_decode(file_get_contents('php://input'), true);
$message = isset($input['message']) ? trim($input['message']) : '';

// Lấy danh sách xe thực tế từ database nếu có để trả lời trực quan
$car_list_str = "";
$result = $conn->query("SELECT name, price FROM cars LIMIT 3");
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $car_list_str .= "• " . $row['name'] . ": " . number_format($row['price'], 0, ',', '.') . " VNĐ\n";
    }
}

// Xử lý các câu trả lời thông minh theo từ khóa
if (strpos($message, 'giá') !== false || strpos($message, 'danh sách') !== false) {
    $reply = "Dạ, các dòng xe nổi bật tại Showroom 4TL:\n" . $car_list_str . "\nBro có thể bấm vào mục 'Xem Chi Tiết' trên từng xe để xem thông số cụ thể nhé!";
} elseif (strpos($message, 'trả góp') !== false) {
    $reply = "Chính sách trả góp 80% tại Showroom 4TL:\n• Vay tối đa 80% giá trị xe.\n• Lãi suất ưu đãi chỉ từ 7.5%/năm.\n• Thủ tục đơn giản, xét duyệt nhanh trong 24h.";
} elseif (strpos($message, 'đặt cọc') !== false || strpos($message, 'cọc') !== false) {
    $reply = "Thông tin chuyển khoản đặt cọc (Giảm ngay 2-5% khi cọc online):\n• Ngân hàng: MB Bank\n• STK: 080820079\n• Chủ TK: VU NGO QUOC ANH";
} elseif (strpos($message, 'địa chỉ') !== false || strpos($message, 'showroom') !== false) {
    $reply = "Showroom Ô Tô 4TL tọa lạc tại: 95 Lê Văn Lương, Tân Hưng, Quận 7, TP.HCM.\nHotline liên hệ trực tiếp: 0765650114.";
} elseif (strpos($message, 'bảo hành') !== false) {
    $reply = "Tất cả các dòng xe tại Showroom 4TL đều được bảo hành chính hãng từ 3 đến 5 năm, hỗ trợ cứu hộ miễn phí 24/7 trên toàn quốc!";
} elseif (strpos($message, 'khuyến mãi') !== false || strpos($message, 'ưu đãi') !== false) {
    $reply = "Chương trình ưu đãi hiện tại:\n• Tặng gói phụ kiện cao cấp chính hãng.\n• Tặng 1 năm bảo hiểm vật chất.\n• Giảm trực tiếp 2-5% khi cọc online qua MB Bank.";
} else {
    $reply = "Cảm ơn bro đã quan tâm đến Showroom 4TL! Em sẵn sàng hỗ trợ tư vấn về giá xe, thủ tục trả góp 80% hoặc thông tin đặt cọc. Bro cần em giúp gì thêm không ạ?";
}

echo json_encode(['reply' => $reply], JSON_UNESCAPED_UNICODE);
?>