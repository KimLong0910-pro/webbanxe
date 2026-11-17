<?php
// Tự động nhận diện môi trường chạy Local (XAMPP) hay Online (Hosting PHP)
$hostName = $_SERVER['HTTP_HOST'] ?? 'localhost';
$remoteAddr = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
$isLocal = in_array($remoteAddr, ['127.0.0.1', '::1'])
    || strpos($hostName, 'localhost') !== false
    || strpos($hostName, '127.0.0.1') !== false;

if ($isLocal) {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "web_ban_xe";
} else {
    // THAY 4 THÔNG SỐ DƯỚI ĐÂY BẰNG THÔNG TIN MYSQL TRÊN HOSTING CỦA BẠN (VD: InfinityFree)
    $host = "sql305.infinityfree.com";
    $user = "if0_43447777";
    $pass = "1oa1wl9IvwkrK";
    $dbname = "if0_43447777_web_ban_xe";
}

$pdo = null;

try {
    if ($isLocal) {
        // Chỉ chạy tạo DB tự động khi ở máy cá nhân (XAMPP)
        $pdoInit = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        $pdoInit->exec("CREATE DATABASE IF NOT EXISTS `$dbname` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }

    // Kết nối thẳng vào Database (Bắt buộc trên InfinityFree)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // 4. Tự động tạo 5 bảng nếu chưa tồn tại (Không cần import schema.sql)
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS cars (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            brand VARCHAR(100) NOT NULL,
            price DECIMAL(15,2) NOT NULL,
            image TEXT,
            engine VARCHAR(100),
            transmission VARCHAR(100),
            fuel VARCHAR(50),
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE IF NOT EXISTS bot_knowledge (
            id INT AUTO_INCREMENT PRIMARY KEY,
            keywords VARCHAR(255) NOT NULL,
            response TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE IF NOT EXISTS bookings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            customer_name VARCHAR(150) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            car_name VARCHAR(255) NOT NULL,
            booking_date VARCHAR(50) DEFAULT NULL,
            note TEXT DEFAULT NULL,
            status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE IF NOT EXISTS deposits (
            id INT AUTO_INCREMENT PRIMARY KEY,
            car_name VARCHAR(255) NOT NULL,
            car_price DECIMAL(15,2) NOT NULL,
            memo VARCHAR(100) NOT NULL,
            customer_name VARCHAR(150) DEFAULT 'Khách đặt online',
            customer_phone VARCHAR(20) DEFAULT '',
            status ENUM('pending', 'verified', 'cancelled') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
    // Tự động nâng cấp cột image lên TEXT để chứa được nhiều link ảnh
    $pdo->exec("ALTER TABLE cars MODIFY COLUMN image TEXT");

    // 5. Nạp tài khoản Admin mặc định (đã mã hóa mật khẩu) nếu bảng users trống
    if ((int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn() === 0) {
        $stmtUser = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmtUser->execute(['admin', password_hash('admin123', PASSWORD_DEFAULT)]);
    }

    // 6. Nạp tri thức AI Chatbot mặc định nếu bảng bot_knowledge trống
    if ((int)$pdo->query("SELECT COUNT(*) FROM bot_knowledge")->fetchColumn() === 0) {
        $pdo->exec("
            INSERT INTO bot_knowledge (keywords, response) VALUES
            ('gia, bao nhieu, chi phi', 'Giá các dòng xe tại Showroom 4TL dao động từ 240 triệu (VinFast VF3) đến hơn 19 tỷ VNĐ (Ferrari F8 Tributo).'),
            ('bao hanh, dich vu', 'Tất cả siêu xe và xe sang bán ra đều bảo hành 3 - 10 năm chính hãng, cam kết kiểm định 160 bước không đâm đụng, không ngập nước.'),
            ('tra gop, vay', 'Showroom 4TL hỗ trợ trả góp qua ngân hàng lên đến 80% giá trị xe trong thời gian tối đa 7 năm với lãi suất ưu đãi chỉ từ 7.5%/năm.')
        ");
    }

    // 7. Nạp trọn bộ 20 mẫu xe mặc định từ schema.sql nếu bảng cars trống
    if ((int)$pdo->query("SELECT COUNT(*) FROM cars")->fetchColumn() === 0) {
        $sql_cars = <<<'SQL'
INSERT INTO cars (name, brand, price, image, engine, transmission, fuel, description) VALUES
('VinFast VF3', 'VinFast', 240000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFJCmiv3bB_2DDesc8SnYvKr_hq-1IiNwk2YCGZKyqZA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDJ8HxL4j3SfFrNMGCvRD9bwAZjykVF3WG-Xxl5v7h9w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbsZHkDzGDsG_EspjalYDoIEN3dnHiV45pQrIns8UK3w&s=10', 'Động cơ điện đơn (Công suất 43 HP / Mô-men xoắn 110 Nm)', 'Tự động 1 cấp', 'Điện', 'Cơn sốt xe điện mini đô thị tại Việt Nam! Mang phong cách thiết kế hình hộp cá tính, khỏe khoắn, khoảng sáng gầm xe cao 191mm giúp dễ dàng vượt qua các địa hình ngập nước đô thị, là mẫu xe điện bán chạy nhất (Best Seller) tại Showroom 4TL.'),
('Mercedes-Benz C-Class C300 AMG', 'Mercedes-Benz', 2099000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8nJj5R87z1dpwUCcHbj1KwNTJtJBM4sYDjrEIgxRtRA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0jXuoX5_WAmEuVpxNpYUIX-UtNpPa78eTAQECU9_aJQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR98khAhzlP1bBIDo7mN_uNiVMy5ExBrqfae38EzD2oBg&s=10', 'Xăng 2.0L Turbo kết hợp công nghệ EQ Boost Mild-Hybrid (258 HP / 400 Nm)', 'Tự động 9 cấp 9G-TRONIC', 'Xăng Mild-Hybrid', 'Mẫu sedan thể thao mệnh danh là "tiểu S-Class" với gói trang thiết kế ngoại thất AMG Line cuốn hút, màn hình giải trí trung tâm đặt dọc 11.9 inch tích hợp MBUX thế hệ mới, cụm đèn pha thông minh Digital Light tối tân và hệ thống âm thanh vòm Burmester 3D 15 loa sống động.'),
('Porsche 911 Carrera S', 'Porsche', 8500000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUGbNCOFMrr8i-ELaF9sQVPpIjPWMSJB44Ql_bo2667w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXIwrpx24-3p2ImkIovLVRN_wTXP-Sr-f5Y_LXkgKJDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpMtyFyXiOJ0kzPQgcy_26PGobb5w_z8zugn9VxdYSjg&s=10', 'Xăng Boxer 6 xi-lanh 3.0L Twin-Turbo (450 HP / 530 Nm)', 'Ly hợp kép 8 cấp PDK danh tiếng của Porsche', 'Xăng', 'Biểu tượng xe thể thao hiệu suất cao huyền thoại mang lại cảm giác lái thuần khiết đỉnh cao. Khả năng tăng tốc 0-100 km/h chỉ mất 3.7 giây khi trang bị gói Sport Chrono, tốc độ tối đa đạt 308 km/h, tích hợp hệ thống treo chủ động PASM và thiết kế buồng lái đậm chất xe đua Đức.'),
('Mercedes-AMG G63', 'Mercedes-Benz', 11750000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9k-mmUkZkHwMhAB8bjPOA9mFIiMkV_1C-dBgyFThkTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHgJI_oRJzR0lzto9sfPraPiSShwHmuhhfQ45LX6a1lA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKEtZnRwUw07P1WR5UkpeZNNF4_2YJJY3Pyyja2xXKOw&s=10', 'Xăng V8 4.0L Biturbo AMG (585 HP / 850 Nm)', 'Tự động thể thao 9 cấp AMG SPEEDSHIFT TCT 9G', 'Xăng', 'Mẫu SUV địa hình hạng sang biểu tượng uy quyền. Thiết kế khung gầm hình thang siêu cứng vững với 3 khóa vi sai độc lập có thể khóa hoàn toàn bằng điện, hệ thống ống xả thể thao đặt bên hông uy lực, nội thất da Nappa hảo hạng kết hợp hệ thống âm thanh vòm Burmester 15 loa.'),
('BMW 740i Pure Excellence', 'BMW', 4699000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHMNStnEqOgN-AtfJc4ZxIl-FSqSxWD-_KPP9Zjk-BkA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10', 'Xăng 3.0L I6 TwinPower Turbo Mild-Hybrid (381 HP / 540 Nm)', 'Tự động 8 cấp Steptronic Sport', 'Xăng Mild-Hybrid', 'Sedan hạng sang cỡ lớn đỉnh cao công nghệ của BMW. Không gian nội thất xa hoa với thanh pha lê tương tác BMW Interaction Bar, ghế ngồi thương gia bọc da Merino cao cấp tích hợp massage, màn hình rạp chiếu phim rạp phía sau 31.3 inch và dàn âm thanh vòm Bowers & Wilkins Diamond.'),
('VinFast VF8 Plus', 'VinFast', 1270000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMgh5eFb69xZCQCeJXpE2n1sx0fIj0gMZRsLUCkF7F2Q&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2fiRyUQE2tzYAfH61XkhF-ZaRi4kbEv1pGYAd6gaKZw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNnZ23dQtN4guhpS1WTpIHS2Azx4Cb_TRBVR3v3oMa8A&s=10', '2 mô-tơ điện AWD toàn thời gian (402 HP / 620 Nm)', 'Tự động 1 cấp', 'Điện', 'SUV điện thông minh phân khúc D mạnh mẽ, trang bị nhiều tính năng trợ lái nâng cao ADAS. Khả năng tăng tốc ấn tượng từ 0-100 km/h dưới 5.5 giây, màn hình trung tâm tràn viền 15.6 inch tối giản, không gian rộng rãi và cửa sổ trời toàn cảnh kính lớn.'),
('VinFast VF5 Plus', 'VinFast', 468000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQd-uWGNUo1taSToXpQaIDCJxCi0OOXvd5SN34Va8zCgQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFGMSwMiRgj3WEsCu14j3Th0mDeFZDiTmfuN5AIyfgiA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEnAbDWJMk7kjzcYqCfHxsNLGsZ4hGodDqmC_vbKh6lw&s=10', 'Động cơ điện đơn (Công suất 134 HP / Mô-men xoắn 135 Nm)', 'Tự động 1 cấp', 'Điện', 'Mẫu A-SUV chạy điện nhỏ gọn, thiết kế năng động tối ưu cho nhu cầu di chuyển đô thị hàng ngày. Tầm hoạt động hơn 300 km cho mỗi lần sạc đầy, tích hợp trợ lý ảo tiếng Việt thông minh, cảnh báo điểm mù và trang bị 6 túi khí an toàn.'),
('Toyota Camry 2.5Q', 'Toyota', 1405000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYl1j8avzp_a52uX2szBu_X2g82yHbEtkqDDN0XtKJ6A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ16pL8BQW83ACdsEAsk95IbLeS0i347RmCkAbc4zGLLA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkDKY-KgdZor0p_2ggyNXFiRd7VE6K5ydz31QxuOYG8w&s=10', 'Xăng Dynamic Force 2.5L (207 HP / 250 Nm)', 'Tự động 8 cấp', 'Xăng', 'Mẫu sedan hạng D biểu tượng cho sự bền bỉ, sang trọng và êm ái. Khoang hành khách phía sau thiết kế chuẩn doanh nhân với bệ tỳ tay tích hợp bảng điều khiển cảm ứng ngả ghế, rèm che nắng chỉnh điện, điều hòa 3 vùng độc lập và 9 loa JBL cao cấp.'),
('Toyota Corolla Cross 1.8HEV', 'Toyota', 905000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpA_ZtVNe8sOc_-tGXiFue--SWAvHYn4hqdXnj1v5NYg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNuPdKKZWfVIlpfJtWjiH1WDTCkzs65ZGLNbW8xdkYXA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaemDP4gzPH3lDaNIymrWag_h6ogYiqv8TLc60aEacSA&s=10', 'Xăng 1.8L kết hợp mô-tơ điện Hybrid (Tổng công suất 122 HP)', 'Tự động vô cấp E-CVT', 'Xăng Hybrid', 'SUV đô thị xanh tiết kiệm nhiên liệu tối ưu nhờ công suất tự sạc Hybrid tiên tiến. Trang bị gói công nghệ an toàn Toyota Safety Sense, camera toàn cảnh 360 độ, cửa sổ trời toàn cảnh và vận hành êm ái, bền bỉ chuẩn mực.'),
('Ford Ranger Raptor 3.0 V6', 'Ford', 1299000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkAP8_0fM7-es-s0TkuWfES4ERnhn3kRzgpiERtCEFyw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSX-ZqLNONfwQeU5XwtL9ZqejukswL1TpUpsr1-76jc3w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQH0fOuAoH-XV1q7BGhIXSq8KXrWfeO2ChqH9Z6Zjgvg&s=10', 'Xăng EcoBoost 3.0L V6 Twin-Turbo (397 HP / 583 Nm)', 'Tự động 10 cấp điện tử', 'Xăng', 'Vua bán tải hiệu năng cao chuyên nghiệp, trang bị hệ thống giảm xóc FOX Live Valve 2.5 inch trượt địa hình. Sở hữu 7 chế độ lái linh hoạt (bao gồm chế độ Baja chuyên đua sa mạc), hệ thống khóa vi sai trước/sau và ống xả thể thao điều chỉnh độ vang.'),
('Ford Everest Titanium+ 4x4', 'Ford', 1468000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiZtZyv9cLXgHdi-7v-PjeTIL5tGeeU3tpnMYplS6XDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTYj1liAKQcUeUhRU01jidOFrEQonbqh2FvYukozZM4w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfRprvZIOazCuK7ZgS3R8vKBIHAlTpdmYSX9Y03eOZBw&s=10', 'Bi-Turbo Diesel 2.0L i4 (210 HP / 500 Nm)', 'Tự động 10 cấp điện tử', 'Dầu (Diesel)', 'SUV 7 chỗ gầm cao hầm hố, khả năng cách âm đỉnh cao và giàu công nghệ an toàn hàng đầu phân khúc. Hệ thống dẫn động 2 cầu 4x4 thông minh, màn hình trung tâm dọc 12 inch chạy SYNC 4A, camera 360 độ sắc nét và hỗ trợ đỗ xe tự động.'),
('Hyundai Tucson 2.0 Diesel', 'Hyundai', 959000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStMbKbjpRugZbAa8Jxhz2GPdFPKMMrw8fJwjRdQ-TBZQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZ8ey04y0-7pSS5gagfiCQrjMaVJBoxy_NPolImcNVTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-AHImYzA1sSv1yPO9EeJObAW1AWSceaxllVKBvl_VJg&s=10', 'Diesel Smartstream D2.0 (186 HP / 416 Nm)', 'Tự động 8 cấp', 'Dầu (Diesel)', 'Crossover sở hữu thiết kế ngoại thất táo bạo, khả năng vận hành mạnh mẽ, bốc và tiết kiệm nhiên liệu tối ưu. Nổi bật với lưới tản nhiệt hình khối thông minh, cần số điện tử dạng nút bấm, cửa sổ trời toàn cảnh và gói an toàn Hyundai SmartSense.'),
('Hyundai Accent 1.5 AT', 'Hyundai', 489000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqxAlh0ojNuYt82BpLC-BRYGclFmTXJd-gJrp2lEF6WQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSahuOZxstBhmyAYM9STEFGftWiVL3FaEJV6jgiXXgjVQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1NEb-vWA47bMBzZmMi3bTdDEKeRmafgiCvZAUuKuHlA&s=10', 'Xăng Smartstream G1.5 (115 HP / 144 Nm)', 'Tự động vô cấp thông minh iVT', 'Xăng', 'Sedan hạng B phổ thông, tiện nghi phong phú vượt tầm giá. Thiết kế phong cách Fastback thể thao trẻ trung, màn hình giải trí 8 inch tích hợp Apple CarPlay/Android Auto không dây, sạc điện thoại không dây và tính năng mở cốp thông minh.'),
('Honda CR-V e:HEV RS', 'Honda', 1259000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgYwkQ2_Bnn715DhM8OfuYNpzg5ozBqKoyC2evRYhhUw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYKCZvpPeMChk_J4Lbs9BbrSrpBDSw5G69aSbUDdtrsw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8Vqeig2JBKNtNlJ5UGdtK69cmsDwRARmVSINyLF-S_Q&s=10', 'Xăng 2.0L kết hợp 2 mô-tơ điện (Tổng công suất 204 HP / 335 Nm)', 'Tự động vô cấp E-CVT', 'Xăng Hybrid', 'SUV 5 chỗ thể thao mang lại trải nghiệm lái phấn khích chuẩn Honda Sensing. Khả năng tiết kiệm nhiên liệu tối ưu chỉ khoảng 5.2L/100km trong đô thị, trang bị cửa sổ trời toàn cảnh Panorama, hệ thống âm thanh 12 loa Bose và màn hình HUD.'),
('Mazda CX-5 2.0 Premium', 'Mazda', 829000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpW39XsAvfNmzgS3h7r2TjxeeJTUhyLpVsnzGlKpS-mQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTInC9__STOHLHNime6eFjQhx4SSUEX5S8lyJn71cJTqQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIF5WKKGY123T08e8kSO_mXGGGMgDtg41luLhyq88TKw&s=10', 'Xăng SkyActiv-G 2.0L (154 HP / 200 Nm)', 'Tự động 6 cấp', 'Xăng', 'Mẫu Crossover bán chạy hàng đầu phân khúc nhờ ngôn ngữ thiết kế KODO tinh tế. Trang bị màn hình hiển thị kính lái HUD, gương chiếu hậu chống chói tự động, cốp điện rảnh tay, 10 loa Bose cao cấp và gói an toàn chủ động i-Activsense.'),
('Kia Carnival 2.2D Signature', 'Kia', 1759000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDrQOfx7kICr3cyGjHqTHm_SMnzFbZOde_TVN6qS1FXw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5v0u6MMN_-u8H5QgBA6eq9gRrBtD3urv_V9zGDT_5ig&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKUw3TRHK3bFJ7Hv5brQb8FBAB1NJEcZdPSkYD5-8ysg&s=10', 'Diesel Smartstream 2.2L (199 HP / 440 Nm)', 'Tự động 8 cấp', 'Dầu (Diesel)', 'Xe gia đình hạng sang (MPV) cỡ lớn rộng rãi, trang bị đầy đủ như khoang hạng thương gia. Hàng ghế thứ hai chỉnh điện thư giãn tích hợp sưởi/làm mát, cửa sổ trời đôi độc lập, rèm che nắng và hệ thống âm thanh 12 loa Bose.'),
('Audi Q7 45 TFSI quattro', 'Audi', 3700000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsMi5fmiZg1cQubrLMpSpHHiwFbiC2puLtGW-dhi1Evw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg2Z49zJQSa-QgYOK6PnDsCeXGbIjDlMy_UJgY5AVG0w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXio_hwx7mM0zgI01Sdx4o-ZLySmfpn8qKouBDzFESQA&s=10', 'Xăng 2.0L TFSI Mild-Hybrid MHEV (252 HP / 370 Nm)', 'Tự động 8 cấp Tiptronic', 'Xăng', 'SUV hạng sang 7 chỗ dẫn động 4 bánh toàn thời gian quattro danh tiếng. Thiết kế lưới tản nhiệt Singleframe bát giác bề thế, cụm đèn pha LED Matrix sắc sảo, buồng lái ảo Audi Virtual Cockpit và dàn âm thanh 3D Bang & Olufsen 19 loa.'),
('Lexus RX350 Luxury', 'Lexus', 4330000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOKn1MNoCINsLRyMryNK-gqu0xXC7E4vegTJpqDpxwKg&s, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlhxOxreBx7dZ0WVilniwHUvofB_NaKB71xDtEZh1WYA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOMkj7dV-dZSUjqzqpyhMVxWrlA_BEZeQ-CC4u_rdp7Q&s=10', 'Xăng 2.4L Turbo I4 (275 HP / 430 Nm)', 'Tự động 8 cấp', 'Xăng', 'Mẫu SUV xe sang Nhật Bản êm ái, cách âm vượt trội và giữ giá tốt. Nội thất bọc da Semi-Aniline cao cấp, màn hình trung tâm cảm ứng 14 inch, hệ thống âm thanh vòm 21 loa Mark Levinson và gói công nghệ an toàn Lexus Safety System+.'),
('Lamborghini Urus S', 'Lamborghini', 16500000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHS2yGPTepN8pLd6xYDDwMDfzd7nNgw0Wb_yTGlGCm0A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKtHAnyoB_1kLYyhE81rizhXi7nkTxwh82w-nitYue7g&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ098BS6eDBP3owhuf17ApxAaDbgMExcwrI0huLgTUudQ&s=10', 'Xăng V8 4.0L Twin-Turbo (666 HP / 850 Nm)', 'Tự động 8 cấp', 'Xăng', 'Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây. Hệ thống dẫn động 4 bánh toàn thời gian, treo khí nén thích ứng thông minh và núm xoay chế độ lái ANIMA gồm Strada, Sport, Corsa, Terra, Sabbia và Neve.'),
('Ferrari F8 Tributo', 'Ferrari', 19000000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRE3sDpn33xn9qTk5wTWc6EFHdkMEssFXSa6l-0td5o2w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgqtnNRCxzmqTFoL6wSi62G-QtJKf_vgT58IWQOpjJvg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTw0GaWZqHRGG_hseloDpgEOje7D5M_ahm2lMqzkTrlTg&s=10', 'Xăng V8 3.9L Twin-Turbo (720 HP / 770 Nm)', 'Ly hợp kép 7 cấp F1', 'Xăng', 'Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm. Tăng tốc 0-100 km/h trong 2.9 giây, tốc độ tối đa 340 km/h, trang bị hốc gió khí động học S-Duct lấy cảm hứng từ xe đua Công thức 1 giúp tăng lực ép xuống đường.');
SQL;
        $pdo->exec($sql_cars);
    }
} catch (Exception $e) {
    $pdo = null;
}
