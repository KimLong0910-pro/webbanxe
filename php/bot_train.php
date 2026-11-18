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
        [
            'id' => 20,
            'name' => 'Ferrari F8 Tributo',
            'brand' => 'Ferrari',
            'price' => 19000000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRE3sDpn33xn9qTk5wTWc6EFHdkMEssFXSa6l-0td5o2w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgqtnNRCxzmqTFoL6wSi62G-QtJKf_vgT58IWQOpjJvg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTw0GaWZqHRGG_hseloDpgEOje7D5M_ahm2lMqzkTrlTg&s=10',
            'engine' => 'Xăng V8 3.9L Twin-Turbo (720 HP / 770 Nm)',
            'transmission' => 'Ly hợp kép 7 cấp F1',
            'fuel' => 'Xăng',
            'description' => 'Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm. Tăng tốc 0-100 km/h trong 2.9 giây, tốc độ tối đa 340 km/h, trang bị hốc gió khí động học S-Duct lấy cảm hứng từ xe đua Công thức 1 giúp tăng lực ép xuống đường.'
        ],
        [
            'id' => 19,
            'name' => 'Lamborghini Urus S',
            'brand' => 'Lamborghini',
            'price' => 16500000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHS2yGPTepN8pLd6xYDDwMDfzd7nNgw0Wb_yTGlGCm0A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKtHAnyoB_1kLYyhE81rizhXi7nkTxwh82w-nitYue7g&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ098BS6eDBP3owhuf17ApxAaDbgMExcwrI0huLgTUudQ&s=10',
            'engine' => 'Xăng V8 4.0L Twin-Turbo (666 HP / 850 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Xăng',
            'description' => 'Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây. Hệ thống dẫn động 4 bánh toàn thời gian, treo khí nén thích ứng thông minh và núm xoay chế độ lái ANIMA gồm Strada, Sport, Corsa, Terra, Sabbia và Neve.'
        ],
        [
            'id' => 18,
            'name' => 'Lexus RX350 Luxury',
            'brand' => 'Lexus',
            'price' => 4330000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOKn1MNoCINsLRyMryNK-gqu0xXC7E4vegTJpqDpxwKg&s, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlhxOxreBx7dZ0WVilniwHUvofB_NaKB71xDtEZh1WYA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOMkj7dV-dZSUjqzqpyhMVxWrlA_BEZeQ-CC4u_rdp7Q&s=10',
            'engine' => 'Xăng 2.4L Turbo I4 (275 HP / 430 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Xăng',
            'description' => 'Mẫu SUV xe sang Nhật Bản êm ái, cách âm vượt trội và giữ giá tốt. Nội thất bọc da Semi-Aniline cao cấp, màn hình trung tâm cảm ứng 14 inch, hệ thống âm thanh vòm 21 loa Mark Levinson và gói công nghệ an toàn Lexus Safety System+.'
        ],
        [
            'id' => 17,
            'name' => 'Audi Q7 45 TFSI quattro',
            'brand' => 'Audi',
            'price' => 3700000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsMi5fmiZg1cQubrLMpSpHHiwFbiC2puLtGW-dhi1Evw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg2Z49zJQSa-QgYOK6PnDsCeXGbIjDlMy_UJgY5AVG0w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXio_hwx7mM0zgI01Sdx4o-ZLySmfpn8qKouBDzFESQA&s=10',
            'engine' => 'Xăng 2.0L TFSI Mild-Hybrid MHEV (252 HP / 370 Nm)',
            'transmission' => 'Tự động 8 cấp Tiptronic',
            'fuel' => 'Xăng',
            'description' => 'SUV hạng sang 7 chỗ dẫn động 4 bánh toàn thời gian quattro danh tiếng. Thiết kế lưới tản nhiệt Singleframe bát giác bề thế, cụm đèn pha LED Matrix sắc sảo, buồng lái ảo Audi Virtual Cockpit và dàn âm thanh 3D Bang & Olufsen 19 loa.'
        ],
        [
            'id' => 16,
            'name' => 'Kia Carnival 2.2D Signature',
            'brand' => 'Kia',
            'price' => 1759000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDrQOfx7kICr3cyGjHqTHm_SMnzFbZOde_TVN6qS1FXw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5v0u6MMN_-u8H5QgBA6eq9gRrBtD3urv_V9zGDT_5ig&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKUw3TRHK3bFJ7Hv5brQb8FBAB1NJEcZdPSkYD5-8ysg&s=10',
            'engine' => 'Diesel Smartstream 2.2L (199 HP / 440 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'Xe gia đình hạng sang (MPV) cỡ lớn rộng rãi, trang bị đầy đủ như khoang hạng thương gia. Hàng ghế thứ hai chỉnh điện thư giãn tích hợp sưởi/làm mát, cửa sổ trời đôi độc lập, rèm che nắng và hệ thống âm thanh 12 loa Bose.'
        ],
        [
            'id' => 15,
            'name' => 'Mazda CX-5 2.0 Premium',
            'brand' => 'Mazda',
            'price' => 829000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpW39XsAvfNmzgS3h7r2TjxeeJTUhyLpVsnzGlKpS-mQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTInC9__STOHLHNime6eFjQhx4SSUEX5S8lyJn71cJTqQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIF5WKKGY123T08e8kSO_mXGGGMgDtg41luLhyq88TKw&s=10',
            'engine' => 'Xăng SkyActiv-G 2.0L (154 HP / 200 Nm)',
            'transmission' => 'Tự động 6 cấp',
            'fuel' => 'Xăng',
            'description' => 'Mẫu Crossover bán chạy hàng đầu phân khúc nhờ ngôn ngữ thiết kế KODO tinh tế. Trang bị màn hình hiển thị kính lái HUD, gương chiếu hậu chống chói tự động, cốp điện rảnh tay, 10 loa Bose cao cấp và gói an toàn chủ động i-Activsense.'
        ],
        [
            'id' => 14,
            'name' => 'Honda CR-V e:HEV RS',
            'brand' => 'Honda',
            'price' => 1259000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgYwkQ2_Bnn715DhM8OfuYNpzg5ozBqKoyC2evRYhhUw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYKCZvpPeMChk_J4Lbs9BbrSrpBDSw5G69aSbUDdtrsw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8Vqeig2JBKNtNlJ5UGdtK69cmsDwRARmVSINyLF-S_Q&s=10',
            'engine' => 'Xăng 2.0L kết hợp 2 mô-tơ điện (Tổng công suất 204 HP / 335 Nm)',
            'transmission' => 'Tự động vô cấp E-CVT',
            'fuel' => 'Xăng Hybrid',
            'description' => 'SUV 5 chỗ thể thao mang lại trải nghiệm lái phấn khích chuẩn Honda Sensing. Khả năng tiết kiệm nhiên liệu tối ưu chỉ khoảng 5.2L/100km trong đô thị, trang bị cửa sổ trời toàn cảnh Panorama, hệ thống âm thanh 12 loa Bose và màn hình HUD.'
        ],
        [
            'id' => 13,
            'name' => 'Hyundai Accent 1.5 AT',
            'brand' => 'Hyundai',
            'price' => 489000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqxAlh0ojNuYt82BpLC-BRYGclFmTXJd-gJrp2lEF6WQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSahuOZxstBhmyAYM9STEFGftWiVL3FaEJV6jgiXXgjVQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1NEb-vWA47bMBzZmMi3bTdDEKeRmafgiCvZAUuKuHlA&s=10',
            'engine' => 'Xăng Smartstream G1.5 (115 HP / 144 Nm)',
            'transmission' => 'Tự động vô cấp thông minh iVT',
            'fuel' => 'Xăng',
            'description' => 'Sedan hạng B phổ thông, tiện nghi phong phú vượt tầm giá. Thiết kế phong cách Fastback thể thao trẻ trung, màn hình giải trí 8 inch tích hợp Apple CarPlay/Android Auto không dây, sạc điện thoại không dây và tính năng mở cốp thông minh.'
        ],
        [
            'id' => 12,
            'name' => 'Hyundai Tucson 2.0 Diesel',
            'brand' => 'Hyundai',
            'price' => 959000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStMbKbjpRugZbAa8Jxhz2GPdFPKMMrw8fJwjRdQ-TBZQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZ8ey04y0-7pSS5gagfiCQrjMaVJBoxy_NPolImcNVTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-AHImYzA1sSv1yPO9EeJObAW1AWSceaxllVKBvl_VJg&s=10',
            'engine' => 'Diesel Smartstream D2.0 (186 HP / 416 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'Crossover sở hữu thiết kế ngoại thất táo bạo, khả năng vận hành mạnh mẽ, bốc và tiết kiệm nhiên liệu tối ưu. Nổi bật với lưới tản nhiệt hình khối thông minh, cần số điện tử dạng nút bấm, cửa sổ trời toàn cảnh và gói an toàn Hyundai SmartSense.'
        ],
        [
            'id' => 11,
            'name' => 'Ford Everest Titanium+ 4x4',
            'brand' => 'Ford',
            'price' => 1468000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiZtZyv9cLXgHdi-7v-PjeTIL5tGeeU3tpnMYplS6XDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTYj1liAKQcUeUhRU01jidOFrEQonbqh2FvYukozZM4w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfRprvZIOazCuK7ZgS3R8vKBIHAlTpdmYSX9Y03eOZBw&s=10',
            'engine' => 'Bi-Turbo Diesel 2.0L i4 (210 HP / 500 Nm)',
            'transmission' => 'Tự động 10 cấp điện tử',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'SUV 7 chỗ gầm cao hầm hố, khả năng cách âm đỉnh cao và giàu công nghệ an toàn hàng đầu phân khúc. Hệ thống dẫn động 2 cầu 4x4 thông minh, màn hình trung tâm dọc 12 inch chạy SYNC 4A, camera 360 độ sắc nét và hỗ trợ đỗ xe tự động.'
        ],
        [
            'id' => 10,
            'name' => 'Ford Ranger Raptor 3.0 V6',
            'brand' => 'Ford',
            'price' => 1299000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkAP8_0fM7-es-s0TkuWfES4ERnhn3kRzgpiERtCEFyw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSX-ZqLNONfwQeU5XwtL9ZqejukswL1TpUpsr1-76jc3w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQH0fOuAoH-XV1q7BGhIXSq8KXrWfeO2ChqH9Z6Zjgvg&s=10',
            'engine' => 'Xăng EcoBoost 3.0L V6 Twin-Turbo (397 HP / 583 Nm)',
            'transmission' => 'Tự động 10 cấp điện tử',
            'fuel' => 'Xăng',
            'description' => 'Vua bán tải hiệu năng cao chuyên nghiệp, trang bị hệ thống giảm xóc FOX Live Valve 2.5 inch trượt địa hình. Sở hữu 7 chế độ lái linh hoạt (bao gồm chế độ Baja chuyên đua sa mạc), hệ thống khóa vi sai trước/sau và ống xả thể thao điều chỉnh độ vang.'
        ],
        [
            'id' => 9,
            'name' => 'Toyota Corolla Cross 1.8HEV',
            'brand' => 'Toyota',
            'price' => 905000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpA_ZtVNe8sOc_-tGXiFue--SWAvHYn4hqdXnj1v5NYg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNuPdKKZWfVIlpfJtWjiH1WDTCkzs65ZGLNbW8xdkYXA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaemDP4gzPH3lDaNIymrWag_h6ogYiqv8TLc60aEacSA&s=10',
            'engine' => 'Xăng 1.8L kết hợp mô-tơ điện Hybrid (Tổng công suất 122 HP)',
            'transmission' => 'Tự động vô cấp E-CVT',
            'fuel' => 'Xăng Hybrid',
            'description' => 'SUV đô thị xanh tiết kiệm nhiên liệu tối ưu nhờ công suất tự sạc Hybrid tiên tiến. Trang bị gói công nghệ an toàn Toyota Safety Sense, camera toàn cảnh 360 độ, cửa sổ trời toàn cảnh và vận hành êm ái, bền bỉ chuẩn mực.'
        ],
        [
            'id' => 8,
            'name' => 'Toyota Camry 2.5Q',
            'brand' => 'Toyota',
            'price' => 1405000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYl1j8avzp_a52uX2szBu_X2g82yHbEtkqDDN0XtKJ6A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ16pL8BQW83ACdsEAsk95IbLeS0i347RmCkAbc4zGLLA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkDKY-KgdZor0p_2ggyNXFiRd7VE6K5ydz31QxuOYG8w&s=10',
            'engine' => 'Xăng Dynamic Force 2.5L (207 HP / 250 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Xăng',
            'description' => 'Mẫu sedan hạng D biểu tượng cho sự bền bỉ, sang trọng và êm ái. Khoang hành khách phía sau thiết kế chuẩn doanh nhân với bệ tỳ tay tích hợp bảng điều khiển cảm ứng ngả ghế, rèm che nắng chỉnh điện, điều hòa 3 vùng độc lập và 9 loa JBL cao cấp.'
        ],
        [
            'id' => 7,
            'name' => 'VinFast VF5 Plus',
            'brand' => 'VinFast',
            'price' => 468000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQd-uWGNUo1taSToXpQaIDCJxCi0OOXvd5SN34Va8zCgQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFGMSwMiRgj3WEsCu14j3Th0mDeFZDiTmfuN5AIyfgiA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEnAbDWJMk7kjzcYqCfHxsNLGsZ4hGodDqmC_vbKh6lw&s=10',
            'engine' => 'Động cơ điện đơn (Công suất 134 HP / Mô-men xoắn 135 Nm)',
            'transmission' => 'Tự động 1 cấp',
            'fuel' => 'Điện',
            'description' => 'Mẫu A-SUV chạy điện nhỏ gọn, thiết kế năng động tối ưu cho nhu cầu di chuyển đô thị hàng ngày. Tầm hoạt động hơn 300 km cho mỗi lần sạc đầy, tích hợp trợ lý ảo tiếng Việt thông minh, cảnh báo điểm mù và trang bị 6 túi khí an toàn.'
        ],
        [
            'id' => 6,
            'name' => 'VinFast VF8 Plus',
            'brand' => 'VinFast',
            'price' => 1270000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMgh5eFb69xZCQCeJXpE2n1sx0fIj0gMZRsLUCkF7F2Q&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2fiRyUQE2tzYAfH61XkhF-ZaRi4kbEv1pGYAd6gaKZw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNnZ23dQtN4guhpS1WTpIHS2Azx4Cb_TRBVR3v3oMa8A&s=10',
            'engine' => '2 mô-tơ điện AWD toàn thời gian (402 HP / 620 Nm)',
            'transmission' => 'Tự động 1 cấp',
            'fuel' => 'Điện',
            'description' => 'SUV điện thông minh phân khúc D mạnh mẽ, trang bị nhiều tính năng trợ lái nâng cao ADAS. Khả năng tăng tốc ấn tượng từ 0-100 km/h dưới 5.5 giây, màn hình trung tâm tràn viền 15.6 inch tối giản, không gian rộng rãi và cửa sổ trời toàn cảnh kính lớn.'
        ],
        [
            'id' => 5,
            'name' => 'BMW 740i Pure Excellence',
            'brand' => 'BMW',
            'price' => 4699000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHMNStnEqOgN-AtfJc4ZxIl-FSqSxWD-_KPP9Zjk-BkA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10',
            'engine' => 'Xăng 3.0L I6 TwinPower Turbo Mild-Hybrid (381 HP / 540 Nm)',
            'transmission' => 'Tự động 8 cấp Steptronic Sport',
            'fuel' => 'Xăng Mild-Hybrid',
            'description' => 'Sedan hạng sang cỡ lớn đỉnh cao công nghệ của BMW. Không gian nội thất xa hoa với thanh pha lê tương tác BMW Interaction Bar, ghế ngồi thương gia bọc da Merino cao cấp tích hợp massage, màn hình rạp chiếu phim rạp phía sau 31.3 inch và dàn âm thanh vòm Bowers & Wilkins Diamond.'
        ],
        [
            'id' => 4,
            'name' => 'Mercedes-AMG G63',
            'brand' => 'Mercedes-Benz',
            'price' => 11750000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9k-mmUkZkHwMhAB8bjPOA9mFIiMkV_1C-dBgyFThkTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHgJI_oRJzR0lzto9sfPraPiSShwHmuhhfQ45LX6a1lA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKEtZnRwUw07P1WR5UkpeZNNF4_2YJJY3Pyyja2xXKOw&s=10',
            'engine' => 'Xăng V8 4.0L Biturbo AMG (585 HP / 850 Nm)',
            'transmission' => 'Tự động thể thao 9 cấp AMG SPEEDSHIFT TCT 9G',
            'fuel' => 'Xăng',
            'description' => 'Mẫu SUV địa hình hạng sang biểu tượng uy quyền. Thiết kế khung gầm hình thang siêu cứng vững với 3 khóa vi sai độc lập có thể khóa hoàn toàn bằng điện, hệ thống ống xả thể thao đặt bên hông uy lực, nội thất da Nappa hảo hạng kết hợp hệ thống âm thanh vòm Burmester 15 loa.'
        ],
        [
            'id' => 3,
            'name' => 'Porsche 911 Carrera S',
            'brand' => 'Porsche',
            'price' => 8500000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUGbNCOFMrr8i-ELaF9sQVPpIjPWMSJB44Ql_bo2667w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXIwrpx24-3p2ImkIovLVRN_wTXP-Sr-f5Y_LXkgKJDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpMtyFyXiOJ0kzPQgcy_26PGobb5w_z8zugn9VxdYSjg&s=10',
            'engine' => 'Xăng Boxer 6 xi-lanh 3.0L Twin-Turbo (450 HP / 530 Nm)',
            'transmission' => 'Ly hợp kép 8 cấp PDK danh tiếng của Porsche',
            'fuel' => 'Xăng',
            'description' => 'Biểu tượng xe thể thao hiệu suất cao huyền thoại mang lại cảm giác lái thuần khiết đỉnh cao. Khả năng tăng tốc 0-100 km/h chỉ mất 3.7 giây khi trang bị gói Sport Chrono, tốc độ tối đa đạt 308 km/h, tích hợp hệ thống treo chủ động PASM và thiết kế buồng lái đậm chất xe đua Đức.'
        ],
        [
            'id' => 2,
            'name' => 'Mercedes-Benz C-Class C300 AMG',
            'brand' => 'Mercedes-Benz',
            'price' => 2099000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8nJj5R87z1dpwUCcHbj1KwNTJtJBM4sYDjrEIgxRtRA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0jXuoX5_WAmEuVpxNpYUIX-UtNpPa78eTAQECU9_aJQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR98khAhzlP1bBIDo7mN_uNiVMy5ExBrqfae38EzD2oBg&s=10',
            'engine' => 'Xăng 2.0L Turbo kết hợp công nghệ EQ Boost Mild-Hybrid (258 HP / 400 Nm)',
            'transmission' => 'Tự động 9 cấp 9G-TRONIC',
            'fuel' => 'Xăng Mild-Hybrid',
            'description' => 'Mẫu sedan thể thao mệnh danh là "tiểu S-Class" với gói trang thiết kế ngoại thất AMG Line cuốn hút, màn hình giải trí trung tâm đặt dọc 11.9 inch tích hợp MBUX thế hệ mới, cụm đèn pha thông minh Digital Light tối tân và hệ thống âm thanh vòm Burmester 3D 15 loa sống động.'
        ],
        [
            'id' => 1,
            'name' => 'VinFast VF3',
            'brand' => 'VinFast',
            'price' => 240000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFJCmiv3bB_2DDesc8SnYvKr_hq-1IiNwk2YCGZKyqZA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDJ8HxL4j3SfFrNMGCvRD9bwAZjykVF3WG-Xxl5v7h9w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbsZHkDzGDsG_EspjalYDoIEN3dnHiV45pQrIns8UK3w&s=10',
            'engine' => 'Động cơ điện đơn (Công suất 43 HP / Mô-men xoắn 110 Nm)',
            'transmission' => 'Tự động 1 cấp',
            'fuel' => 'Điện',
            'description' => 'Cơn sốt xe điện mini đô thị tại Việt Nam! Mang phong cách thiết kế hình hộp cá tính, khỏe khoắn, khoảng sáng gầm xe cao 191mm giúp dễ dàng vượt qua các địa hình ngập nước đô thị, là mẫu xe điện bán chạy nhất (Best Seller) tại Showroom 4TL.'
        ]
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
        $reply = "Cảm ơn quý khách đã nhắn tin! Quý khách có thể hỏi về giá xe cụ thể (VD: <em>giá VF3, G63, Porsche 911</em>), theo hãng (<em>xe VinFast, Mercedes</em>), ngân sách (<em>xe dưới 2 tỷ</em>) hoặc gọi Hotline VIP <strong>0765.650.114</strong> ạ!";
    }
}

echo json_encode(["reply" => $reply], JSON_UNESCAPED_UNICODE);
