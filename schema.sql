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
-- Dữ liệu ban đầu
('VinFast VF3', 'VinFast', 240000000.00, 'https://vinfastquan12.com.vn/wp-content/uploads/2025/02/VinFast_VF3_Mau_trang.webp', 'Điện đơn', 'Tự động', 'Điện', 'Mẫu xe điện đô thị mini màu trắng thời thượng, là tâm điểm bán chạy nhất (Best Seller) tại Showroom 4TL.'),
('Mercedes-Benz C-Class C300', 'Mercedes-Benz', 2099000000.00, 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=800', '2.0L Turbo', 'Tự động 9 cấp', 'Xăng', 'Dòng xe sang ấn tượng, trang bị hiện đại tại Showroom 4TL.'),
('Porsche 911 Carrera S', 'Porsche', 8500000000.00, 'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800', '3.0L Twin-Turbo', 'Tự động 8 cấp PDK', 'Xăng', 'Mẫu xe thể thao huyền thoại mang lại cảm giác lái đỉnh cao.'),
('Mercedes-AMG G63', 'Mercedes-Benz', 11750000000.00, 'https://images.unsplash.com/photo-1520050206274-a1ae44613e6d?w=800', '585 mã lực', 'Tự động 9 cấp AMG', 'Xăng', 'Mẫu SUV địa hình hạng sang đẳng cấp biểu tượng.'),
('BMW 740i Pure Excellence', 'BMW', 4699000000.00, 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800', '381 mã lực', 'Tự động 8 cấp Steptronic', 'Xăng Mild-Hybrid', 'Sedan hạng sang cao cấp đầy công nghệ của BMW.'),
('VinFast VF8 Plus', 'VinFast', 1270000000.00, 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800', 'Điện đôi (402 HP)', 'Tự động', 'Điện', 'SUV điện phân khúc D mạnh mẽ, trang bị nhiều tính năng trợ lái thông minh ADAS.'),
('VinFast VF5 Plus', 'VinFast', 468000000.00, 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=800', 'Điện đơn (134 HP)', 'Tự động', 'Điện', 'Mẫu A-SUV chạy điện nhỏ gọn, tối ưu cho nhu cầu di chuyển đô thị hàng ngày.'),
('Toyota Camry 2.5Q', 'Toyota', 1405000000.00, 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=800', '2.5L 4-cylinders', 'Tự động 8 cấp', 'Xăng', 'Mẫu sedan hạng D biểu tượng cho sự bền bỉ, sang trọng và êm ái.'),
('Toyota Corolla Cross 1.8HEV', 'Toyota', 905000000.00, 'https://images.unsplash.com/photo-1590362891991-f776e747a588?w=800', '1.8L Hybrid', 'Vô cấp e-CVT', 'Xăng Hybrid', 'SUV đô thị tiết kiệm nhiên liệu tối ưu với động cơ Hybrid tiên tiến.'),
('Ford Ranger Raptor 3.0 V6', 'Ford', 1299000000.00, 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800', '3.0L V6 Twin-Turbo', 'Tự động 10 cấp', 'Xăng', 'Vua bán tải hiệu năng cao, trang bị phuộc FOX trượt địa hình chuyên nghiệp.'),
('Ford Everest Titanium+ 4x4', 'Ford', 1468000000.00, 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=800', '2.0L Bi-Turbo', 'Tự động 10 cấp', 'Dầu (Diesel)', 'SUV 7 chỗ hầm hố, cách âm tốt và giàu công nghệ an toàn hàng đầu.'),
('Hyundai Tucson 2.0 Diesel', 'Hyundai', 959000000.00, 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800', '2.0L Smartstream', 'Tự động 8 cấp', 'Dầu (Diesel)', 'Crossover thiết kế táo bạo, vận hành bốc và tiết kiệm nhiên liệu.'),
('Hyundai Accent 1.5 AT', 'Hyundai', 489000000.00, 'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=800', '1.5L MPi', 'Vô cấp iVT', 'Xăng', 'Sedan hạng B phổ thông, tiện nghi phong phú trong tầm giá.'),
('Honda CR-V e:HEV RS', 'Honda', 1259000000.00, 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800', '2.0L Hybrid', 'Vô cấp e-CVT', 'Xăng Hybrid', 'SUV 5 chỗ thể thao, trải nghiệm lái phấn khích chuẩn Honda Sensing.'),
('Mazda CX-5 2.0 Premium', 'Mazda', 829000000.00, 'https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?w=800', '2.0L SkyActiv-G', 'Tự động 6 cấp', 'Xăng', 'Mẫu Crossover bán chạy nhất phân khúc nhờ thiết kế KODO tinh tế.'),
('Kia Carnival 2.2D Signature', 'Kia', 1759000000.00, 'https://images.unsplash.com/photo-1563720223185-11003d516935?w=800', '2.2L Smartstream', 'Tự động 8 cấp', 'Dầu (Diesel)', 'Xe gia đình hạng sang (MPV) rộng rãi, trang bị đầy đủ như một khoang thương gia.'),
('Audi Q7 45 TFSI quattro', 'Audi', 3700000000.00, 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800', '2.0L Turbo', 'Tự động 8 cấp Tiptronic', 'Xăng', 'SUV hạng sang 7 chỗ dẫn động 4 bánh toàn thời gian danh tiếng.'),
('Lexus RX350 Luxury', 'Lexus', 4330000000.00, 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800', '2.4L Turbo', 'Tự động 8 cấp', 'Xăng', 'Mẫu SUV xe sang Nhật Bản êm ái, cách âm vượt trội và giữ giá tốt.'),
('Lamborghini Urus S', 'Lamborghini', 16500000000.00, 'https://images.unsplash.com/photo-1617788138017-80ad40651399?w=800', '4.0L V8 Twin-Turbo', 'Tự động 8 cấp', 'Xăng', 'Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây.'),
('Ferrari F8 Tributo', 'Ferrari', 19000000000.00, 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800', '3.9L V8 Twin-Turbo', 'Tự động 7 cấp ly hợp kép', 'Xăng', 'Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm.');