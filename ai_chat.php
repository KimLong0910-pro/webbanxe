<?php
// Bật chế độ chặn mọi thông báo lỗi PHP lọt ra ngoài làm hỏng JSON
error_reporting(0);
@ini_set('display_errors', 0);

// Đảm bảo header trả về đúng định dạng JSON
header('Content-Type: application/json; charset=utf-8');

// Nhận dữ liệu từ JavaScript gửi lên
$raw_input = file_get_contents('php://input');
$input = json_decode($raw_input, true);
$user_message = isset($input['message']) ? trim($input['message']) : '';

if (empty($user_message)) {
    echo json_encode(['reply' => 'Dạ, bro vui lòng nhập nội dung cần tư vấn nhé!']);
    exit;
}

// Kết nối database an toàn
$conn = @new mysqli("localhost", "root", "", "webbanxe");
if ($conn && !$conn->connect_error) {
    $conn->set_charset("utf8");
}

// Lấy danh sách xe từ Database
$inventory_list = [];
if ($conn && !empty($conn)) {
    $result = $conn->query("SELECT name, brand, price FROM cars");
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $price_fmt = number_format($row['price'], 0, ',', '.') . " VNĐ";
            $inventory_list[] = "• " . $row['name'] . " (" . $row['brand'] . ") - Giá: " . $price_fmt;
        }
    }
}

// Nếu database trống, dùng dữ liệu dự phòng
if (empty($inventory_list)) {
    $inventory_list[] = "• VinFast VF3 (VinFast) - Giá: 240.000.000 VNĐ";
    $inventory_list[] = "• Mercedes-Benz C300 (Mercedes-Benz) - Giá: 2.099.000.000 VNĐ";
}

$msg_lower = mb_strtolower($user_message, 'UTF-8');
$reply = "";

// Phản hồi thông minh theo ý định
if (strpos($msg_lower, 'giá') !== false || strpos($msg_lower, 'danh sách') !== false || strpos($msg_lower, 'xe') !== false) {
    $reply = "Dạ, Showroom Ô Tô 4TL hiện đang phân phối các dòng xe sau:<br>" . implode("<br>", $inventory_list) . "<br><br>Bro muốn tham khảo chi tiết mẫu nào ạ?";
} 
elseif (strpos($msg_lower, 'trả góp') !== false || strpos($msg_lower, 'vay') !== false) {
    $reply = "Chính sách trả góp tại Showroom 4TL:<br>• Hỗ trợ vay ngân hàng lên đến **80%** giá trị xe.<br>• Lãi suất ưu đãi chỉ từ **7.5%/năm**.<br>• Duyệt hồ sơ nhanh chóng trong 24h!";
} 
elseif (strpos($msg_lower, 'cọc') !== false || strpos($msg_lower, 'tài khoản') !== false || strpos($msg_lower, 'stk') !== false) {
    $reply = "Thông tin chuyển khoản đặt cọc chính thức:<br>• **MB Bank**: 080820079<br>• **Chủ TK**: VU NGO QUOC ANH<br>• Cọc online giảm ngay 2 - 5% trực tiếp trên giá xe!";
} 
elseif (strpos($msg_lower, 'địa chỉ') !== false || strpos($msg_lower, 'ở đâu') !== false || strpos($msg_lower, 'showroom') !== false) {
    $reply = "Showroom Ô Tô 4TL tọa lạc tại: **95 Lê Văn Lương, Tân Hưng, Quận 7, TP.HCM**.<br>Hotline tư vấn: **0765650114**.";
} 
else {
    $reply = "Cảm ơn bro đã liên hệ Showroom 4TL! Em sẵn sàng hỗ trợ tư vấn về giá xe, thủ tục trả góp 80% hoặc thông tin đặt cọc MB Bank (080820079 - Vu Ngo Quoc Anh). Bro cần em giúp gì ạ?";
}

// Trả về kết quả JSON chuẩn tuyệt đối
echo json_encode(['reply' => $reply], JSON_UNESCAPED_UNICODE);
exit;
?>