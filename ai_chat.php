<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);
if (!$input && isset($_POST['message'])) {
    $input = $_POST;
}

$message = mb_strtolower(trim($input['message'] ?? ''), 'UTF-8');

if (empty($message)) {
    echo json_encode(["reply" => "Chào quý khách! Em là Trợ lý AI Showroom 4TL. Em có thể tư vấn mẫu xe, mức giá, chương trình trả góp hay đăng ký lái thử cho quý khách."], JSON_UNESCAPED_UNICODE);
    exit();
}

// Hàm chuẩn hóa tiếng Việt bỏ dấu để tìm kiếm mờ (fuzzy match)
function removeAccents($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    return $str;
}

$msgNoAccent = removeAccents($message);
$reply = "";

// ƯU TIÊN 1: TRA CỨU TỪ BẢNG TRI THỨC HUẤN LUYỆN (bot_knowledge)
if (isset($pdo) && $pdo) {
    try {
        $stmt = $pdo->query("SELECT keywords, response FROM bot_knowledge ORDER BY id DESC");
        $knowledges = $stmt->fetchAll();

        $bestScore = 0;
        $bestResponse = "";

        foreach ($knowledges as $row) {
            $kwList = explode(',', $row['keywords']);
            $score = 0;
            foreach ($kwList as $kw) {
                $kwClean = mb_strtolower(trim($kw), 'UTF-8');
                $kwNoAccent = removeAccents($kwClean);
                if (empty($kwClean)) continue;

                // Khớp chính xác cụm từ khóa (có dấu hoặc không dấu)
                if (mb_strpos($message, $kwClean) !== false || strpos($msgNoAccent, $kwNoAccent) !== false) {
                    $score += 3;
                } else {
                    // Tìm kiếm mờ bằng độ tương đồng từ (similar_text) cho từng từ trong câu
                    $msgWords = explode(' ', $msgNoAccent);
                    foreach ($msgWords as $w) {
                        if (strlen($w) >= 4 && strlen($kwNoAccent) >= 4) {
                            similar_text($w, $kwNoAccent, $percent);
                            if ($percent >= 82) {
                                $score += 1;
                            }
                        }
                    }
                }
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestResponse = $row['response'];
            }
        }

        if ($bestScore >= 3) {
            $reply = nl2br(htmlspecialchars($bestResponse));
        }
    } catch (Exception $e) {
        // Bỏ qua nếu bảng chưa tồn tại
    }
}

// ƯU TIÊN 2: TRA CỨU THÔNG TIN XE TỪ BẢNG CARS
$cars = [];
if (isset($conn) && $conn && !$conn->connect_error) {
    $result = @$conn->query("SELECT * FROM cars");
    if ($result && $result->num_rows > 0) {
        while ($car = $result->fetch_assoc()) {
            $cars[] = $car;
        }
    }
}

if (!$reply && !empty($cars)) {
    foreach ($cars as $car) {
        $carNameLower = mb_strtolower($car['name'], 'UTF-8');
        $carNameNoAccent = removeAccents($carNameLower);
        $words = explode(' ', $carNameNoAccent);
        $lastWord = end($words);

        if (mb_strpos($message, $carNameLower) !== false ||
            strpos($msgNoAccent, $carNameNoAccent) !== false ||
            (strlen($lastWord) >= 3 && strpos($msgNoAccent, $lastWord) !== false) ||
            ($car['name'] === 'VinFast VF3' && (strpos($msgNoAccent, 'vf3') !== false || strpos($msgNoAccent, 'vf 3') !== false)) ||
            ($car['name'] === 'Mercedes-AMG G63' && (strpos($msgNoAccent, 'g63') !== false || strpos($msgNoAccent, 'g 63') !== false))
        ) {
            $priceFormatted = number_format($car['price'], 0, ',', '.');
            $reply = "Dạ, mẫu xe <strong>{$car['name']}</strong> ({$car['brand']}) hiện có giá niêm yết là <strong>{$priceFormatted} VNĐ</strong>.<br>✨ Động cơ: {$car['engine']} | Nhiên liệu: {$car['fuel']}.<br>Quý khách có thể bấm <strong>Đặt Cọc</strong> hoặc <strong>Lái Thử</strong> ngay bên dưới thẻ xe ạ!";
            break;
        }
    }
}

// ƯU TIÊN 3: TƯ VẤN THEO NGÂN SÁCH & CÂU HỎI MẶC ĐỊNH
if (!$reply && (strpos($msgNoAccent, 'duoi') !== false || strpos($msgNoAccent, 'tam') !== false || strpos($msgNoAccent, 'ngan sach') !== false)) {
    $limitPrice = 0;
    $label = "";
    if (strpos($msgNoAccent, '500') !== false) { $limitPrice = 500000000; $label = "dưới 500 triệu"; }
    elseif (strpos($msgNoAccent, '1 ty') !== false || strpos($msgNoAccent, '1ty') !== false) { $limitPrice = 1000000000; $label = "dưới 1 tỷ"; }
    elseif (strpos($msgNoAccent, '2 ty') !== false || strpos($msgNoAccent, '2ty') !== false) { $limitPrice = 2000000000; $label = "dưới 2 tỷ"; }
    elseif (strpos($msgNoAccent, '3 ty') !== false || strpos($msgNoAccent, '3ty') !== false) { $limitPrice = 3000000000; $label = "dưới 3 tỷ"; }

    if ($limitPrice > 0 && !empty($cars)) {
        $matches = array_filter($cars, fn($c) => (float)$c['price'] <= $limitPrice);
        if (!empty($matches)) {
            usort($matches, fn($a, $b) => $b['price'] - $a['price']);
            $list = [];
            foreach (array_slice($matches, 0, 4) as $m) {
                $p = number_format($m['price'], 0, ',', '.');
                $list[] = "• <strong>{$m['name']}</strong>: {$p} VNĐ";
            }
            $reply = "Dạ với tầm tài chính <strong>{$label}</strong>, Showroom 4TL đề xuất các mẫu xe:<br>" . implode("<br>", $list);
        }
    }
}

if (!$reply) {
    if (strpos($msgNoAccent, 'tra gop') !== false || strpos($msgNoAccent, 'vay') !== false) {
        $reply = "Showroom 4TL hỗ trợ vay trả góp lên đến <strong>80% giá trị xe</strong> trong tối đa 7 năm (84 tháng). Quý khách có thể kéo thử thanh <strong>Dự Toán Trả Góp</strong> ngay trên trang chủ!";
    } elseif (strpos($msgNoAccent, 'lai thu') !== false) {
        $reply = "Quý khách hãy bấm nút <strong>'Lái Thử'</strong> trên bất kỳ mẫu xe nào, điền tên và SĐT, hệ thống sẽ lưu lịch hẹn ngay để chuyên viên mang xe tới tận nơi ạ!";
    } else {
        $reply = "Cảm ơn quý khách đã nhắn tin! Quý khách có thể hỏi về giá xe cụ thể (VD: <em>giá VF3, G63, Porsche 911</em>), ngân sách (<em>xe dưới 2 tỷ</em>) hoặc gọi Hotline VIP <strong>0706.850.014</strong> ạ!";
    }
}

echo json_encode(["reply" => $reply], JSON_UNESCAPED_UNICODE);
?>