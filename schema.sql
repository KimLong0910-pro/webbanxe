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

INSERT INTO cars (name, brand, price, image, engine, transmission, fuel, description) VALUES
('VinFast VF3 (Best Seller)', 'VinFast', 240000000.00, 'https://vinfastquan12.com.vn/wp-content/uploads/2025/02/VinFast_VF3_Mau_trang.webp', 'Điện đơn', 'Tự động', 'Điện', 'Mẫu xe điện đô thị mini màu trắng thời thượng, là tâm điểm bán chạy nhất (Best Seller) tại Showroom 4TL.'),
('Mercedes-Benz C-Class C300', 'Mercedes-Benz', 2099000000.00, 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=800', '2.0L Turbo', 'Tự động 9 cấp', 'Xăng', 'Dòng xe sang ấn tượng, trang bị hiện đại tại Showroom 4TL.'),
('Porsche 911 Carrera S', 'Porsche', 8500000000.00, 'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800', '3.0L Twin-Turbo', 'Tự động 8 cấp PDK', 'Xăng', 'Mẫu xe thể thao huyền thoại mang lại cảm giác lái đỉnh cao.'),
('Mercedes-AMG G63', 'Mercedes-Benz', 11750000000.00, 'https://images.unsplash.com/photo-1520050206274-a1ae44613e6d?w=800', '585 mã lực', 'Tự động 9 cấp AMG', 'Xăng', 'Mẫu SUV địa hình hạng sang đẳng cấp biểu tượng.'),
('BMW 740i Pure Excellence', 'BMW', 4699000000.00, 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800', '381 mã lực', 'Tự động 8 cấp Steptronic', 'Xăng Mild-Hybrid', 'Sedan hạng sang cao cấp đầy công nghệ của BMW.');