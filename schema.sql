CREATE DATABASE IF NOT EXISTS web_ban_xe DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE web_ban_xe;

DROP TABLE IF EXISTS cars;

CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    price DECIMAL(15,2) NOT NULL,
    image VARCHAR(255) DEFAULT 'default.jpg',
    engine VARCHAR(100),
    transmission VARCHAR(100),
    fuel VARCHAR(50),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS bot_knowledge (
    id INT AUTO_INCREMENT PRIMARY KEY,
    keywords VARCHAR(255) NOT NULL,
    response TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng lưu lịch đăng ký lái thử & yêu cầu tư vấn
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    car_name VARCHAR(255) NOT NULL,
    booking_date VARCHAR(50) DEFAULT NULL,
    note TEXT DEFAULT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng lưu đơn đặt cọc giữ xe qua VietQR
CREATE TABLE IF NOT EXISTS deposits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_name VARCHAR(255) NOT NULL,
    car_price DECIMAL(15,2) NOT NULL,
    memo VARCHAR(100) NOT NULL,
    customer_name VARCHAR(150) DEFAULT 'Khách đặt online',
    customer_phone VARCHAR(20) DEFAULT '',
    status ENUM('pending', 'verified', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password) VALUES
('admin', 'admin123')
ON DUPLICATE KEY UPDATE username=username;

INSERT INTO bot_knowledge (keywords, response) VALUES
('gia, bao nhieu, chi phi', 'Giá các dòng xe tại Showroom 4TL dao động từ 240 triệu (VinFast VF3) đến hơn 19 tỷ VNĐ (Ferrari F8 Tributo).'),
('bao hanh, dich vu', 'Tất cả siêu xe và xe sang bán ra đều bảo hành 3 - 10 năm chính hãng, cam kết kiểm định 160 bước không đâm đụng, không ngập nước.'),
('tra gop, vay', 'Showroom 4TL hỗ trợ trả góp qua ngân hàng lên đến 80% giá trị xe trong thời gian tối đa 7 năm với lãi suất ưu đãi chỉ từ 7.5%/năm.');

INSERT INTO cars (name, brand, price, image, engine, transmission, fuel, description) VALUES
('VinFast VF3', 'VinFast', 240000000.00, 'https://vinfastquan12.com.vn/wp-content/uploads/2025/02/VinFast_VF3_Mau_trang.webp', 'Động cơ điện đơn (43 HP)', 'Tự động', 'Điện', 'Cơn sốt xe điện mini tại Việt Nam! Kiểu dáng hình hộp cá tính, gầm cao 191mm vượt địa hình ngập nước, Best Seller tại Showroom 4TL.'),
('Mercedes-Benz C-Class C300 AMG', 'Mercedes-Benz', 2099000000.00, 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=800', '2.0L Turbo EQ Boost (258 HP)', 'Tự động 9 cấp 9G-TRONIC', 'Xăng Mild-Hybrid', 'Tiểu S-Class với thiết kế thể thao AMG Line, màn hình giải trí trung tâm 11.9 inch định dạng dọc, đèn Digital Light tối tân nhất.'),
('Porsche 911 Carrera S', 'Porsche', 8500000000.00, 'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800', '3.0L Boxer Twin-Turbo (450 HP)', 'Tự động 8 cấp PDK', 'Xăng', 'Mẫu xe thể thao huyền thoại mang lại cảm giác lái đỉnh cao, thiết kế timeless vượt thời gian đi cùng gói thể thao Sport Chrono Package.'),
('Mercedes-AMG G63', 'Mercedes-Benz', 11750000000.00, 'https://images.unsplash.com/photo-1520050206274-a1ae44613e6d?w=800', '4.0L V8 Bi-Turbo (585 HP)', 'Tự động 9 cấp AMG Speedshift', 'Xăng', 'Mẫu SUV địa hình hạng sang đẳng cấp biểu tượng hoàng gia. Hệ dẫn động 4 bánh toàn thời gian 4MATIC với 3 khóa vi sai độc lập.'),
('BMW 740i Pure Excellence', 'BMW', 4699000000.00, 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800', '3.0L I6 TwinPower (381 HP)', 'Tự động 8 cấp Steptronic', 'Xăng Mild-Hybrid', 'Sedan hạng sang cao cấp đầy công nghệ của BMW với màn hình Theatre Screen 31.3 inch chuẩn 8K cùng hệ thống âm thanh vòm Bowers & Wilkins Diamond.'),
('VinFast VF8 Plus', 'VinFast', 1270000000.00, 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800', '2 Động cơ điện (402 HP - AWD)', 'Tự động đơn cấp', 'Điện', 'SUV điện thông minh phân khúc D, thiết kế Pininfarina đỉnh cao, tăng tốc 0-100 km/h trong 5.5 giây và trợ lái thông minh ADAS cấp độ 2.'),
('VinFast VF5 Plus', 'VinFast', 468000000.00, 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=800', 'Động cơ điện (134 HP - 135 Nm)', 'Tự động đơn cấp', 'Điện', 'A-SUV thuần điện quốc dân nhỏ gọn, chi phí vận hành siêu rẻ chỉ bằng 1/3 xe xăng, thời trang và linh hoạt trong đô thị.'),
('Toyota Camry 2.5Q', 'Toyota', 1405000000.00, 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=800', '2.5L Dynamic Force (207 HP)', 'Tự động 8 cấp Direct Shift', 'Xăng', 'Mẫu sedan hạng D chuẩn mực của sự thành đạt, bền bỉ, êm ái bậc nhất phân khúc với gói an toàn Toyota Safety Sense 2.0.'),
('Toyota Corolla Cross 1.8HEV', 'Toyota', 905000000.00, 'https://images.unsplash.com/photo-1590362891991-f776e747a588?w=800', '1.8L Hybrid Xăng + Điện (122 HP)', 'Vô cấp e-CVT', 'Xăng Hybrid', 'Mẫu Urban SUV tiết kiệm nhiên liệu tối ưu với động cơ Hybrid tiên tiến, khung gầm TNGA vững chắc và vận hành êm ái nhẹ nhàng.'),
('Ford Ranger Raptor 3.0 V6', 'Ford', 1299000000.00, 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800', '3.0L V6 EcoBoost Twin-Turbo (392 HP)', 'Tự động 10 cấp', 'Xăng', 'Vua bán tải hiệu năng cao, trang bị bộ giảm xóc FOX 2.5 inch Live Valve thích ứng theo thời gian thực và chế độ lái sa mạc Baja Mode.'),
('Ford Everest Titanium+ 4x4', 'Ford', 1468000000.00, 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=800', '2.0L Bi-Turbo Diesel (210 HP)', 'Tự động 10 cấp điện tử', 'Dầu (Diesel)', 'SUV 7 chỗ thực thụ đậm chất cơ bắp Mỹ, khả năng lội nước 800mm, camera 360 độ và công nghệ đỗ xe tự động 2.0.'),
('Hyundai Tucson 2.0 Diesel', 'Hyundai', 959000000.00, 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800', '2.0L Smartstream D2.0 (186 HP)', 'Tự động 8 cấp số nút bấm', 'Dầu (Diesel)', 'Crossover thiết kế tương lai Parametric Jewel, nội thất mở dạng phi thuyền, máy dầu bốc và tiết kiệm bậc nhất.'),
('Hyundai Accent 1.5 AT', 'Hyundai', 489000000.00, 'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=800', '1.5L Smartstream G (115 HP)', 'Vô cấp thông minh iVT', 'Xăng', 'Sedan hạng B thế hệ hoàn toàn mới, kích thước lớn nhất phân khúc, trang bị gói SmartSense vượt tầm giá.'),
('Honda CR-V e:HEV RS', 'Honda', 1259000000.00, 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=800', '2.0L Hybrid Xăng + Điện (204 HP)', 'E-CVT thể thao', 'Xăng Hybrid', 'SUV thể thao thế hệ mới nhập khẩu nguyên chiếc, tiết kiệm nhiên liệu chỉ 3.4L/100km đô thị, gói an toàn Honda SENSING đầy đủ.'),
('Mazda CX-5 2.0 Premium', 'Mazda', 829000000.00, 'https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?w=800', '2.0L SkyActiv-G (154 HP)', 'Tự động 6 cấp', 'Xăng', 'Mẫu Crossover bán chạy nhất phân khúc nhờ ngôn ngữ thiết kế KODO tinh tế, 10 loa Bose cao cấp và hệ thống an toàn i-Activsense.'),
('Kia Carnival 2.2D Signature', 'Kia', 1759000000.00, 'https://images.unsplash.com/photo-1563720223185-11003d516935?w=800', '2.2L Smartstream D2.2 (199 HP)', 'Tự động 8 cấp', 'Dầu (Diesel)', 'Chuyên cơ mặt đất MPV 7 chỗ thương gia siêu tiện nghi, hàng ghế thứ 2 sưởi/làm mát và chế độ thư giãn không trọng lực VIP.'),
('Audi Q7 45 TFSI quattro', 'Audi', 3700000000.00, 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800', '2.0L Turbo Mild-Hybrid (252 HP)', 'Tự động 8 cấp Tiptronic', 'Xăng Mild-Hybrid', 'SUV hạng sang 7 chỗ cỡ lớn dẫn động 4 bánh toàn thời gian quattro danh tiếng, đèn Matrix LED thông minh và buồng lái ảo Audi Virtual Cockpit.'),
('Lexus RX350 Luxury', 'Lexus', 4330000000.00, 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800', '2.4L Turbo T24A-FTS (275 HP)', 'Tự động 8 cấp Direct Shift', 'Xăng', 'Mẫu SUV xe sang Nhật Bản êm ái, cách âm tĩnh lặng đỉnh cao, nội thất da Semi-Aniline cao cấp và hệ thống an toàn Lexus Safety System+ 3.0.'),
('Lamborghini Urus S', 'Lamborghini', 16500000000.00, 'https://images.unsplash.com/photo-1617788138017-80ad40651399?w=800', '4.0L V8 Twin-Turbo (666 HP)', 'Tự động 8 cấp thể thao', 'Xăng', 'Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây. Thiết kế góc cạnh đậm chất chiến đấu của hãng xe bò tót Sant\'Agata Bolognese.'),
('Ferrari F8 Tributo', 'Ferrari', 19000000000.00, 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800', '3.9L V8 Twin-Turbo (710 HP)', 'Tự động 7 cấp ly hợp kép', 'Xăng', 'Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm Ý. Tăng tốc 0-100 km/h trong 2.9 giây, tốc độ tối đa 340 km/h.');