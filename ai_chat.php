<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

// Nhận dữ liệu từ JSON body hoặc POST
$rawInput = file_get_contents('php://input');
if (empty($rawInput)) {
    $rawInput = file_get_contents('php://stdin');
}
$input = json_decode($rawInput, true);
if (!$input && isset($_POST['message'])) {
    $input = $_POST;
}

$message = mb_strtolower(trim($input['message'] ?? ''), 'UTF-8');

if (empty($message)) {
    echo json_encode(["reply" => "Chào quý khách! Em là Trợ lý AI Showroom 4TL. Em có thể tư vấn mẫu xe, mức giá, chương trình trả góp hay đăng ký lái thử cho quý khách."], JSON_UNESCAPED_UNICODE);
    exit();
}

$cars = [];
if (isset($conn) && $conn && !$conn->connect_error) {
    $sql = "SELECT * FROM cars";
    $result = @$conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($car = $result->fetch_assoc()) {
            $cars[] = $car;
        }
    }
}

// Fallback danh sách xe nổi bật nếu CSDL chưa kết nối
if (empty($cars)) {
    $cars = [
        ['name' => 'Ferrari F8 Tributo', 'brand' => 'Ferrari', 'price' => 19000000000, 'engine' => '3.9L V8 Twin-Turbo (710 HP)', 'fuel' => 'Xăng'],
        ['name' => 'Lamborghini Urus S', 'brand' => 'Lamborghini', 'price' => 16500000000, 'engine' => '4.0L V8 Twin-Turbo (666 HP)', 'fuel' => 'Xăng'],
        ['name' => 'Mercedes-AMG G63', 'brand' => 'Mercedes-Benz', 'price' => 11750000000, 'engine' => '4.0L V8 Bi-Turbo (585 HP)', 'fuel' => 'Xăng'],
        ['name' => 'Porsche 911 Carrera S', 'brand' => 'Porsche', 'price' => 8500000000, 'engine' => '3.0L Boxer Twin-Turbo (450 HP)', 'fuel' => 'Xăng'],
        ['name' => 'VinFast VF3', 'brand' => 'VinFast', 'price' => 240000000, 'engine' => 'Động cơ điện đơn (43 HP)', 'fuel' => 'Điện'],
        ['name' => 'VinFast VF5 Plus', 'brand' => 'VinFast', 'price' => 468000000, 'engine' => 'Động cơ điện (134 HP)', 'fuel' => 'Điện'],
        ['name' => 'VinFast VF8 Plus', 'brand' => 'VinFast', 'price' => 1270000000, 'engine' => '2 Động cơ điện (402 HP)', 'fuel' => 'Điện'],
        ['name' => 'Ford Ranger Raptor', 'brand' => 'Ford', 'price' => 1299000000, 'engine' => '3.0L V6 EcoBoost Twin-Turbo (392 HP)', 'fuel' => 'Xăng'],
        ['name' => 'Mercedes-Benz C300', 'brand' => 'Mercedes-Benz', 'price' => 2099000000, 'engine' => '2.0L Turbo EQ Boost (258 HP)', 'fuel' => 'Xăng'],
        ['name' => 'Toyota Camry 2.5Q', 'brand' => 'Toyota', 'price' => 1405000000, 'engine' => '2.5L Dynamic Force (207 HP)', 'fuel' => 'Xăng'],
        ['name' => 'Hyundai Tucson', 'brand' => 'Hyundai', 'price' => 959000000, 'engine' => '2.0L Smartstream D2.0 (186 HP)', 'fuel' => 'Dầu (Diesel)'],
        ['name' => 'Mazda CX-5', 'brand' => 'Mazda', 'price' => 829000000, 'engine' => '2.0L SkyActiv-G (154 HP)', 'fuel' => 'Xăng']
    ];
}

$reply = "";

// 1. Tìm theo tên xe hoặc model cụ thể
foreach ($cars as $car) {
    $carNameLower = mb_strtolower($car['name'], 'UTF-8');
    $brandLower = mb_strtolower($car['brand'], 'UTF-8');
    
    $words = explode(' ', $carNameLower);
    $lastWord = end($words);
    
    if (strpos($message, $carNameLower) !== false || 
        (strlen($lastWord) >= 3 && strpos($message, $lastWord) !== false) || 
        ($car['name'] === 'VinFast VF3' && (strpos($message, 'vf3') !== false || strpos($message, 'vf 3') !== false)) ||
        ($car['name'] === 'Mercedes-AMG G63' && (strpos($message, 'g63') !== false || strpos($message, 'g 63') !== false)) ||
        ($car['name'] === 'Porsche 911 Carrera S' && strpos($message, '911') !== false) ||
        ($car['name'] === 'Ferrari F8 Tributo' && (strpos($message, 'f8') !== false || strpos($message, 'ferrari') !== false)) ||
        ($car['name'] === 'Lamborghini Urus S' && (strpos($message, 'urus') !== false || strpos($message, 'lambo') !== false))
    ) {
        $priceFormatted = number_format($car['price'], 0, ',', '.');
        $reply = "Dạ, mẫu siêu phẩm <strong>{$car['name']}</strong> ({$car['brand']}) hiện có giá niêm yết tại Showroom là <strong>{$priceFormatted} VNĐ</strong>.<br>✨ Động cơ: {$car['engine']} | Nhiên liệu: {$car['fuel']}.<br>Quý khách có thể cọc giữ xe online hoặc bấm nút <strong>Đăng Ký Lái Thử</strong> ngay trên màn hình ạ!";
        break;
    }
}

// 2. Tư vấn theo khoảng ngân sách (dưới 2 tỷ, dưới 1 tỷ, dưới 500 triệu...)
if (!$reply && (strpos($message, 'dưới') !== false || strpos($message, 'duoi') !== false || strpos($message, 'tầm') !== false || strpos($message, 'ngân sách') !== false || strpos($message, 'khoảng') !== false || strpos($message, 'tài chính') !== false)) {
    $limitPrice = 0;
    $label = "";
    if (strpos($message, '500') !== false) {
        $limitPrice = 500000000;
        $label = "dưới 500 triệu";
    } elseif (strpos($message, '1 tỷ') !== false || strpos($message, '1 ty') !== false || strpos($message, '1ty') !== false) {
        $limitPrice = 1000000000;
        $label = "dưới 1 tỷ";
    } elseif (strpos($message, '2 tỷ') !== false || strpos($message, '2 ty') !== false || strpos($message, '2ty') !== false) {
        $limitPrice = 2000000000;
        $label = "dưới 2 tỷ";
    } elseif (strpos($message, '3 tỷ') !== false || strpos($message, '3 ty') !== false || strpos($message, '3ty') !== false) {
        $limitPrice = 3000000000;
        $label = "dưới 3 tỷ";
    } elseif (strpos($message, '5 tỷ') !== false || strpos($message, '5 ty') !== false || strpos($message, '5ty') !== false) {
        $limitPrice = 5000000000;
        $label = "dưới 5 tỷ";
    }

    if ($limitPrice > 0) {
        $matches = array_filter($cars, function($c) use ($limitPrice) {
            return (float)$c['price'] <= $limitPrice;
        });
        if (!empty($matches)) {
            usort($matches, function($a, $b) { return $b['price'] - $a['price']; });
            $list = [];
            foreach (array_slice($matches, 0, 4) as $m) {
                $p = number_format($m['price'], 0, ',', '.');
                $list[] = "• <strong>{$m['name']}</strong>: {$p} VNĐ";
            }
            $reply = "Dạ với tầm tài chính <strong>{$label}</strong>, Showroom 4TL trân trọng đề xuất các mẫu xe cực đẹp:<br>" . implode("<br>", $list) . "<br><br>Quý khách muốn xem chi tiết thông số hay đăng ký lái thử mẫu nào không ạ?";
        }
    }
}

// 3. Tư vấn theo chủ đề thường gặp
if (!$reply) {
    if (strpos($message, 'tra gop') !== false || strpos($message, 'trả góp') !== false || strpos($message, 'vay') !== false || strpos($message, 'ngan hang') !== false || strpos($message, 'ngân hàng') !== false) {
        $reply = "Showroom 4TL hỗ trợ mua xe trả góp lên đến <strong>80% giá trị xe</strong>, thời gian vay linh hoạt từ 1 đến 7 năm (84 tháng), lãi suất ưu đãi chỉ từ 7.5%/năm. Quý khách có thể thử ngay công cụ <strong>Dự Toán Trả Góp</strong> ở trên trang web!";
    } elseif (strpos($message, 'lai thu') !== false || strpos($message, 'lái thử') !== false || strpos($message, 'test drive') !== false) {
        $reply = "Showroom 4TL luôn sẵn sàng xe demo để quý khách trải nghiệm cảm giác lái thực tế. Quý khách có thể bấm nút <strong>'Đăng Ký Lái Thử'</strong> trên màn hình hoặc gọi Hotline: <strong>0706.850.014</strong> để chuyên viên sắp xếp xe đón tận nơi!";
    } elseif (strpos($message, 'dien') !== false || strpos($message, 'điện') !== false || strpos($message, 'ev') !== false) {
        $reply = "Hiện Showroom có sẵn các dòng xe thuần điện HOT nhất thị trường: <strong>VinFast VF3</strong> (giá từ 240 triệu), <strong>VF5 Plus</strong> (468 triệu) và <strong>VF8 Plus</strong> (1.27 tỷ). Xe giao ngay, tặng kèm bộ sạc tại nhà!";
    } elseif (strpos($message, 'dia chi') !== false || strpos($message, 'ở đâu') !== false || strpos($message, 'o dau') !== false || strpos($message, 'location') !== false || strpos($message, 'showroom') !== false) {
        $reply = "Showroom 4TL tọa lạc tại: <strong>99 Nguyễn Lương Bằng, Phú Mỹ Hưng, Quận 7, TP. Hồ Chí Minh</strong>. Mở cửa từ 08:00 đến 20:30 tất cả các ngày trong tuần. Kính mời quý khách ghé thăm trải nghiệm!";
    } elseif (strpos($message, 'bao hanh') !== false || strpos($message, 'bảo hành') !== false || strpos($message, 'cam ket') !== false || strpos($message, 'cam kết') !== false) {
        $reply = "Tất cả các dòng xe tại Showroom 4TL đều cam kết: Bảo hành chính hãng từ 3 - 10 năm, kiểm định 160 bước nghiêm ngặt, cam kết KHÔNG đâm đụng, KHÔNG thủy kích ngập nước!";
    } elseif (strpos($message, 'coc') !== false || strpos($message, 'cọc') !== false || strpos($message, 'dat coc') !== false || strpos($message, 'chuyen khoan') !== false || strpos($message, 'qr') !== false) {
        $reply = "Để giữ xe, quý khách chỉ cần bấm nút <strong>'Đặt Cọc Giữ Xe'</strong> tại mẫu xe yêu thích. Hệ thống sẽ hiển thị mã QR VietQR chuyển khoản nhanh bảo đảm quyền ưu tiên nhận xe!";
    } else {
        $reply = "Cảm ơn quý khách đã quan tâm! Showroom 4TL luôn sẵn sàng phục vụ. Quý khách có thể lọc xe theo thương hiệu, mức giá ở danh mục trên hoặc liên hệ Hotline VIP: <strong>0706.850.014</strong> để được phục vụ chu đáo nhất.";
    }
}

echo json_encode(["reply" => $reply], JSON_UNESCAPED_UNICODE);
?>