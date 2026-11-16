<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);
if (!$input && isset($_POST['message'])) {
    $input = $_POST;
}

function e($str)
{
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

function toLowerUtf8($str)
{
    return function_exists('mb_strtolower') ? mb_strtolower($str, 'UTF-8') : strtolower($str);
}

function strPosUtf8($haystack, $needle)
{
    return function_exists('mb_strpos') ? mb_strpos($haystack, $needle) : strpos($haystack, $needle);
}

function removeAccents($str)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/u", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/u", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/u", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/u", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/u", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/u", 'y', $str);
    $str = preg_replace("/(đ)/u", 'd', $str);
    return $str;
}

// Kiểm tra từ/cụm từ độc lập (tránh khớp nhầm chuỗi con)
function hasWord($haystack, $needle)
{
    $pattern = '/(?<![a-z0-9])' . preg_quote($needle, '/') . '(?![a-z0-9])/i';
    return preg_match($pattern, $haystack) === 1;
}

// Trích xuất mã nhận diện riêng của từng xe, loại bỏ các hậu tố phổ thông
function getCarIdentifiers($carNameNoAccent, $brandNoAccent)
{
    $stopWords = [
        'plus',
        'amg',
        'luxury',
        'premium',
        'signature',
        'tributo',
        'quattro',
        'pure',
        'excellence',
        'carrera',
        'diesel',
        'hybrid',
        'hev',
        'e:hev',
        'titanium',
        'titanium+',
        '4x4',
        'at',
        'rs',
        'v6',
        's',
        'class',
        'c-class'
    ];

    $identifiers = [$carNameNoAccent];
    // Bỏ tên hãng khỏi tên xe để lấy phần tên dòng/mã xe
    $modelPart = trim(str_replace($brandNoAccent, '', $carNameNoAccent));
    if (strlen($modelPart) >= 2 && !in_array($modelPart, $stopWords)) {
        $identifiers[] = $modelPart;
    }

    $tokens = preg_split('/[\s\/]+/', $modelPart);
    foreach ($tokens as $token) {
        $tokenClean = trim($token, '+-');
        if (strlen($tokenClean) >= 2 && !in_array($tokenClean, $stopWords)) {
            // Ưu tiên token có chứa chữ số (vf3, c300, g63, 911, cx-5...) hoặc tên riêng >= 4 ký tự (camry, urus...)
            if (preg_match('/\d/', $tokenClean) || strlen($tokenClean) >= 4) {
                $identifiers[] = $tokenClean;
            }
        }
    }

    // Bổ sung biến thể có dấu cách cho mã VF (vd: "vf 3", "vf 5", "vf 8")
    if (preg_match('/\bvf(\d+)\b/', $carNameNoAccent, $m)) {
        $identifiers[] = 'vf ' . $m[1];
    }

    return array_unique($identifiers);
}

$message = toLowerUtf8(trim($input['message'] ?? ''));

if (empty($message)) {
    echo json_encode([
        "reply" => "Chào quý khách! Em là Trợ lý AI Showroom 4TL. Em có thể tư vấn mẫu xe, mức giá, chương trình trả góp hay đăng ký lái thử cho quý khách."
    ], JSON_UNESCAPED_UNICODE);
    exit();
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
                $kwClean = toLowerUtf8(trim($kw));
                $kwNoAccent = removeAccents($kwClean);
                if (empty($kwNoAccent)) continue;

                if (hasWord($msgNoAccent, $kwNoAccent)) {
                    $score += 3;
                } else {
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
            $reply = nl2br(htmlspecialchars($bestResponse, ENT_QUOTES, 'UTF-8'));
        }
    } catch (Exception $e) {
        // Bỏ qua nếu bảng chưa tồn tại
    }
}

// ƯU TIÊN 2: LẤY DANH SÁCH XE TỪ PDO
$cars = [];
if (isset($pdo) && $pdo) {
    try {
        $cars = $pdo->query("SELECT * FROM cars ORDER BY id DESC")->fetchAll();
    } catch (Exception $e) {
        $cars = [];
    }
}

if (empty($cars)) {
    $cars = [
        ['name' => 'VinFast VF3', 'brand' => 'VinFast', 'price' => 240000000, 'engine' => 'Động cơ điện đơn (43 HP)', 'fuel' => 'Điện'],
        ['name' => 'VinFast VF5 Plus', 'brand' => 'VinFast', 'price' => 468000000, 'engine' => 'Động cơ điện (134 HP)', 'fuel' => 'Điện'],
        ['name' => 'VinFast VF8 Plus', 'brand' => 'VinFast', 'price' => 1270000000, 'engine' => '2 Động cơ điện (402 HP)', 'fuel' => 'Điện'],
        ['name' => 'Mercedes-Benz C-Class C300 AMG', 'brand' => 'Mercedes-Benz', 'price' => 2099000000, 'engine' => '2.0L Turbo EQ Boost (258 HP)', 'fuel' => 'Xăng Mild-Hybrid'],
        ['name' => 'Porsche 911 Carrera S', 'brand' => 'Porsche', 'price' => 8500000000, 'engine' => '3.0L Boxer Twin-Turbo (450 HP)', 'fuel' => 'Xăng'],
        ['name' => 'Mercedes-AMG G63', 'brand' => 'Mercedes-Benz', 'price' => 11750000000, 'engine' => '4.0L V8 Bi-Turbo (585 HP)', 'fuel' => 'Xăng'],
        ['name' => 'Lamborghini Urus S', 'brand' => 'Lamborghini', 'price' => 16500000000, 'engine' => '4.0L V8 Twin-Turbo (666 HP)', 'fuel' => 'Xăng'],
        ['name' => 'Ferrari F8 Tributo', 'brand' => 'Ferrari', 'price' => 19000000000, 'engine' => '3.9L V8 Twin-Turbo (710 HP)', 'fuel' => 'Xăng'],
    ];
}

if (!$reply && !empty($cars)) {
    // Bước 2A: Tìm theo MẪU XE CỤ THỂ (chọn xe khớp chính xác nhất)
    $matchedCar = null;
    $bestCarScore = 0;

    foreach ($cars as $car) {
        $carNameNoAccent = removeAccents(toLowerUtf8($car['name']));
        $brandNoAccent = removeAccents(toLowerUtf8($car['brand']));
        $identifiers = getCarIdentifiers($carNameNoAccent, $brandNoAccent);

        $carScore = 0;
        foreach ($identifiers as $idx => $idStr) {
            if (hasWord($msgNoAccent, $idStr)) {
                // Khớp nguyên tên xe điểm cao nhất (10), khớp mã dòng xe điểm 5
                $carScore = max($carScore, $idx === 0 ? 10 : 5);
            }
        }

        if ($carScore > $bestCarScore) {
            $bestCarScore = $carScore;
            $matchedCar = $car;
        }
    }

    if ($matchedCar) {
        $priceFormatted = number_format((float)$matchedCar['price'], 0, ',', '.');
        $cName = e($matchedCar['name']);
        $cBrand = e($matchedCar['brand']);
        $cEngine = e($matchedCar['engine']);
        $cFuel = e($matchedCar['fuel']);
        $reply = "Dạ, mẫu xe <strong>{$cName}</strong> ({$cBrand}) hiện có giá niêm yết là <strong>{$priceFormatted} VNĐ</strong>.<br>✨ Động cơ: {$cEngine} | Nhiên liệu: {$cFuel}.<br>Quý khách có thể bấm <strong>Đặt Cọc</strong> hoặc <strong>Lái Thử</strong> ngay bên dưới thẻ xe ạ!";
    } else {
        // Bước 2B: Nếu không nhắc tên xe cụ thể, kiểm tra xem khách có hỏi theo THƯƠNG HIỆU không (không break sớm)
        $brandMatches = [];
        $matchedBrandName = "";

        foreach ($cars as $car) {
            $brandNoAccent = removeAccents(toLowerUtf8($car['brand']));
            // Hỗ trợ gõ tắt "mercedes" cho "mercedes-benz"
            $brandAliases = [$brandNoAccent];
            if (strpos($brandNoAccent, 'mercedes') !== false) {
                $brandAliases[] = 'mercedes';
                $brandAliases[] = 'mec';
            }

            foreach ($brandAliases as $alias) {
                if (hasWord($msgNoAccent, $alias)) {
                    $brandMatches[] = $car;
                    $matchedBrandName = $car['brand'];
                    break;
                }
            }
        }

        if (!empty($brandMatches)) {
            $lines = [];
            foreach ($brandMatches as $m) {
                $p = number_format((float)$m['price'], 0, ',', '.');
                $lines[] = "• <strong>" . e($m['name']) . "</strong>: {$p} VNĐ (" . e($m['fuel']) . ")";
            }
            $reply = "Dạ, Showroom 4TL hiện đang có <strong>" . count($brandMatches) . " mẫu xe " . e($matchedBrandName) . "</strong> sẵn giao:<br>" . implode("<br>", $lines);
        }
    }
}

// ƯU TIÊN 3: TƯ VẤN THEO NGÂN SÁCH & CÂU HỎI MẶC ĐỊNH
if (!$reply && (strpos($msgNoAccent, 'duoi') !== false || strpos($msgNoAccent, 'tam') !== false || strpos($msgNoAccent, 'ngan sach') !== false)) {
    $limitPrice = 0;
    $label = "";
    if (strpos($msgNoAccent, '500') !== false) {
        $limitPrice = 500000000;
        $label = "dưới 500 triệu";
    } elseif (strpos($msgNoAccent, '1 ty') !== false || strpos($msgNoAccent, '1ty') !== false) {
        $limitPrice = 1000000000;
        $label = "dưới 1 tỷ";
    } elseif (strpos($msgNoAccent, '2 ty') !== false || strpos($msgNoAccent, '2ty') !== false) {
        $limitPrice = 2000000000;
        $label = "dưới 2 tỷ";
    } elseif (strpos($msgNoAccent, '3 ty') !== false || strpos($msgNoAccent, '3ty') !== false) {
        $limitPrice = 3000000000;
        $label = "dưới 3 tỷ";
    }

    if ($limitPrice > 0 && !empty($cars)) {
        $matches = array_filter($cars, fn($c) => (float)$c['price'] <= $limitPrice);
        if (!empty($matches)) {
            usort($matches, fn($a, $b) => (float)$b['price'] - (float)$a['price']);
            $list = [];
            foreach (array_slice($matches, 0, 4) as $m) {
                $p = number_format((float)$m['price'], 0, ',', '.');
                $list[] = "• <strong>" . e($m['name']) . "</strong>: {$p} VNĐ";
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
        $reply = "Cảm ơn quý khách đã nhắn tin! Quý khách có thể hỏi về giá xe cụ thể (VD: <em>giá VF3, G63, Porsche 911</em>), theo hãng (<em>xe VinFast, Mercedes</em>), ngân sách (<em>xe dưới 2 tỷ</em>) hoặc gọi Hotline VIP <strong>0706.850.014</strong> ạ!";
    }
}

echo json_encode(["reply" => $reply], JSON_UNESCAPED_UNICODE);
