<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

$cars = [];

if (isset($conn) && $conn && !$conn->connect_error) {
    $sql = "SELECT * FROM cars ORDER BY id DESC";
    $result = @$conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $row['id'] = (int)$row['id'];
            $row['price'] = (float)$row['price'];
            $cars[] = $row;
        }
    }
}

// Nếu CSDL chưa được import hoặc chưa chạy, sử dụng dữ liệu mẫu chuẩn của Showroom 4TL
if (empty($cars)) {
    $cars = [
        [
            'id' => 20,
            'name' => 'Ferrari F8 Tributo',
            'brand' => 'Ferrari',
            'price' => 19000000000.00,
            'image' => 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800',
            'engine' => '3.9L V8 Twin-Turbo (710 HP)',
            'transmission' => 'Tự động 7 cấp ly hợp kép',
            'fuel' => 'Xăng',
            'description' => 'Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm Ý. Tăng tốc 0-100 km/h trong 2.9 giây, tốc độ tối đa 340 km/h.'
        ],
        [
            'id' => 19,
            'name' => 'Lamborghini Urus S',
            'brand' => 'Lamborghini',
            'price' => 16500000000.00,
            'image' => 'https://images.unsplash.com/photo-1617788138017-80ad40651399?w=800',
            'engine' => '4.0L V8 Twin-Turbo (666 HP)',
            'transmission' => 'Tự động 8 cấp thể thao',
            'fuel' => 'Xăng',
            'description' => 'Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây. Thiết kế góc cạnh đậm chất chiến đấu của hãng xe bò tót Sant\'Agata Bolognese.'
        ],
        [
            'id' => 18,
            'name' => 'Lexus RX350 Luxury',
            'brand' => 'Lexus',
            'price' => 4330000000.00,
            'image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800',
            'engine' => '2.4L Turbo T24A-FTS (275 HP)',
            'transmission' => 'Tự động 8 cấp Direct Shift',
            'fuel' => 'Xăng',
            'description' => 'Mẫu SUV xe sang Nhật Bản êm ái, cách âm tĩnh lặng đỉnh cao, nội thất da Semi-Aniline cao cấp và hệ thống an toàn Lexus Safety System+ 3.0.'
        ],
        [
            'id' => 17,
            'name' => 'Audi Q7 45 TFSI quattro',
            'brand' => 'Audi',
            'price' => 3700000000.00,
            'image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800',
            'engine' => '2.0L Turbo Mild-Hybrid (252 HP)',
            'transmission' => 'Tự động 8 cấp Tiptronic',
            'fuel' => 'Xăng Mild-Hybrid',
            'description' => 'SUV hạng sang 7 chỗ cỡ lớn dẫn động 4 bánh toàn thời gian quattro danh tiếng, đèn Matrix LED thông minh và buồng lái ảo Audi Virtual Cockpit.'
        ],
        [
            'id' => 16,
            'name' => 'Kia Carnival 2.2D Signature',
            'brand' => 'Kia',
            'price' => 1759000000.00,
            'image' => 'https://images.unsplash.com/photo-1563720223185-11003d516935?w=800',
            'engine' => '2.2L Smartstream D2.2 (199 HP)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'Chuyên cơ mặt đất MPV 7 chỗ thương gia siêu tiện nghi, hàng ghế thứ 2 sưởi/làm mát và chế độ thư giãn không trọng lực VIP.'
        ],
        [
            'id' => 15,
            'name' => 'Mazda CX-5 2.0 Premium',
            'brand' => 'Mazda',
            'price' => 829000000.00,
            'image' => 'https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?w=800',
            'engine' => '2.0L SkyActiv-G (154 HP)',
            'transmission' => 'Tự động 6 cấp',
            'fuel' => 'Xăng',
            'description' => 'Mẫu Crossover bán chạy nhất phân khúc nhờ ngôn ngữ thiết kế KODO tinh tế, 10 loa Bose cao cấp và hệ thống an toàn i-Activsense.'
        ],
        [
            'id' => 14,
            'name' => 'Honda CR-V e:HEV RS',
            'brand' => 'Honda',
            'price' => 1259000000.00,
            'image' => 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=800',
            'engine' => '2.0L Hybrid Xăng + Điện (204 HP)',
            'transmission' => 'E-CVT thể thao',
            'fuel' => 'Xăng Hybrid',
            'description' => 'SUV thể thao thế hệ mới nhập khẩu nguyên chiếc, tiết kiệm nhiên liệu chỉ 3.4L/100km đô thị, gói an toàn Honda SENSING đầy đủ.'
        ],
        [
            'id' => 13,
            'name' => 'Hyundai Accent 1.5 AT',
            'brand' => 'Hyundai',
            'price' => 489000000.00,
            'image' => 'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=800',
            'engine' => '1.5L Smartstream G (115 HP)',
            'transmission' => 'Vô cấp thông minh iVT',
            'fuel' => 'Xăng',
            'description' => 'Sedan hạng B thế hệ hoàn toàn mới, kích thước lớn nhất phân khúc, trang bị gói SmartSense vượt tầm giá.'
        ],
        [
            'id' => 12,
            'name' => 'Hyundai Tucson 2.0 Diesel',
            'brand' => 'Hyundai',
            'price' => 959000000.00,
            'image' => 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800',
            'engine' => '2.0L Smartstream D2.0 (186 HP)',
            'transmission' => 'Tự động 8 cấp số nút bấm',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'Crossover thiết kế tương lai Parametric Jewel, nội thất mở dạng phi thuyền, máy dầu bốc và tiết kiệm bậc nhất.'
        ],
        [
            'id' => 11,
            'name' => 'Ford Everest Titanium+ 4x4',
            'brand' => 'Ford',
            'price' => 1468000000.00,
            'image' => 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=800',
            'engine' => '2.0L Bi-Turbo Diesel (210 HP)',
            'transmission' => 'Tự động 10 cấp điện tử',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'SUV 7 chỗ thực thụ đậm chất cơ bắp Mỹ, khả năng lội nước 800mm, camera 360 độ và công nghệ đỗ xe tự động 2.0.'
        ],
        [
            'id' => 10,
            'name' => 'Ford Ranger Raptor 3.0 V6',
            'brand' => 'Ford',
            'price' => 1299000000.00,
            'image' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800',
            'engine' => '3.0L V6 EcoBoost Twin-Turbo (392 HP)',
            'transmission' => 'Tự động 10 cấp',
            'fuel' => 'Xăng',
            'description' => 'Vua bán tải hiệu năng cao, trang bị bộ giảm xóc FOX 2.5 inch Live Valve thích ứng theo thời gian thực và chế độ lái sa mạc Baja Mode.'
        ],
        [
            'id' => 9,
            'name' => 'Toyota Corolla Cross 1.8HEV',
            'brand' => 'Toyota',
            'price' => 905000000.00,
            'image' => 'https://images.unsplash.com/photo-1590362891991-f776e747a588?w=800',
            'engine' => '1.8L Hybrid Xăng + Điện (122 HP)',
            'transmission' => 'Vô cấp e-CVT',
            'fuel' => 'Xăng Hybrid',
            'description' => 'Mẫu Urban SUV tiết kiệm nhiên liệu tối ưu với động cơ Hybrid tiên tiến, khung gầm TNGA vững chắc và vận hành êm ái nhẹ nhàng.'
        ],
        [
            'id' => 8,
            'name' => 'Toyota Camry 2.5Q',
            'brand' => 'Toyota',
            'price' => 1405000000.00,
            'image' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=800',
            'engine' => '2.5L Dynamic Force 4-cylinders (207 HP)',
            'transmission' => 'Tự động 8 cấp Direct Shift',
            'fuel' => 'Xăng',
            'description' => 'Mẫu sedan hạng D chuẩn mực của sự thành đạt, bền bỉ, êm ái bậc nhất phân khúc với gói an toàn Toyota Safety Sense 2.0.'
        ],
        [
            'id' => 7,
            'name' => 'VinFast VF5 Plus',
            'brand' => 'VinFast',
            'price' => 468000000.00,
            'image' => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=800',
            'engine' => 'Động cơ điện (134 HP - 135 Nm)',
            'transmission' => 'Tự động đơn cấp',
            'fuel' => 'Điện',
            'description' => 'A-SUV thuần điện quốc dân nhỏ gọn, chi phí vận hành siêu rẻ chỉ bằng 1/3 xe xăng, thời trang và linh hoạt trong đô thị.'
        ],
        [
            'id' => 6,
            'name' => 'VinFast VF8 Plus',
            'brand' => 'VinFast',
            'price' => 1270000000.00,
            'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800',
            'engine' => '2 Động cơ điện (402 HP - AWD)',
            'transmission' => 'Tự động đơn cấp',
            'fuel' => 'Điện',
            'description' => 'SUV điện thông minh phân khúc D, thiết kế Pininfarina đỉnh cao, tăng tốc 0-100 km/h trong 5.5 giây và trợ lái thông minh ADAS cấp độ 2.'
        ],
        [
            'id' => 5,
            'name' => 'BMW 740i Pure Excellence',
            'brand' => 'BMW',
            'price' => 4699000000.00,
            'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800',
            'engine' => '3.0L I6 TwinPower (381 HP)',
            'transmission' => 'Tự động 8 cấp Steptronic',
            'fuel' => 'Xăng Mild-Hybrid',
            'description' => 'Sedan hạng sang cao cấp đầy công nghệ của BMW với màn hình Theatre Screen 31.3 inch chuẩn 8K cùng hệ thống âm thanh vòm Bowers & Wilkins Diamond.'
        ],
        [
            'id' => 4,
            'name' => 'Mercedes-AMG G63',
            'brand' => 'Mercedes-Benz',
            'price' => 11750000000.00,
            'image' => 'https://images.unsplash.com/photo-1520050206274-a1ae44613e6d?w=800',
            'engine' => '4.0L V8 Bi-Turbo (585 HP)',
            'transmission' => 'Tự động 9 cấp AMG Speedshift',
            'fuel' => 'Xăng',
            'description' => 'Mẫu SUV địa hình hạng sang đẳng cấp biểu tượng hoàng gia. Hệ dẫn động 4 bánh toàn thời gian 4MATIC với 3 khóa vi sai độc lập.'
        ],
        [
            'id' => 3,
            'name' => 'Porsche 911 Carrera S',
            'brand' => 'Porsche',
            'price' => 8500000000.00,
            'image' => 'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800',
            'engine' => '3.0L Boxer Twin-Turbo (450 HP)',
            'transmission' => 'Tự động 8 cấp PDK',
            'fuel' => 'Xăng',
            'description' => 'Mẫu xe thể thao huyền thoại mang lại cảm giác lái đỉnh cao, thiết kế timeless vượt thời gian đi cùng gói thể thao Sport Chrono Package.'
        ],
        [
            'id' => 2,
            'name' => 'Mercedes-Benz C-Class C300 AMG',
            'brand' => 'Mercedes-Benz',
            'price' => 2099000000.00,
            'image' => 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=800',
            'engine' => '2.0L Turbo Mild-Hybrid EQ Boost (258 HP)',
            'transmission' => 'Tự động 9 cấp 9G-TRONIC',
            'fuel' => 'Xăng Mild-Hybrid',
            'description' => 'Tiểu S-Class với thiết kế thể thao AMG Line, màn hình giải trí trung tâm 11.9 inch định dạng dọc, đèn Digital Light tối tân nhất.'
        ],
        [
            'id' => 1,
            'name' => 'VinFast VF3',
            'brand' => 'VinFast',
            'price' => 240000000.00,
            'image' => 'https://vinfastquan12.com.vn/wp-content/uploads/2025/02/VinFast_VF3_Mau_trang.webp',
            'engine' => 'Động cơ điện đơn (43 HP)',
            'transmission' => 'Tự động',
            'fuel' => 'Điện',
            'description' => 'Cơn sốt xe điện mini tại Việt Nam! Kiểu dáng hình hộp cá tính, gầm cao 191mm vượt địa hình ngập nước, Best Seller tại Showroom 4TL.'
        ]
    ];
}

echo json_encode($cars, JSON_UNESCAPED_UNICODE);
?>