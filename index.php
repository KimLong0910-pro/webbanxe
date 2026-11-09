<?php
require_once 'db.php';

// Xử lý bộ lọc tìm kiếm và sắp xếp
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$brand_filter = isset($_GET['brand']) ? $conn->real_escape_string($_GET['brand']) : '';
$price_filter = isset($_GET['price']) ? $_GET['price'] : '';
$sort_order = isset($_GET['sort']) ? $_GET['sort'] : '';

$sql = "SELECT * FROM cars WHERE 1=1";
if (!empty($search)) {
    $sql .= " AND name LIKE '%$search%'";
}
if (!empty($brand_filter)) {
    $sql .= " AND brand = '$brand_filter'";
}
if (!empty($price_filter)) {
    if ($price_filter == 'under_2b') {
        $sql .= " AND price < 2000000000";
    } elseif ($price_filter == '2b_5b') {
        $sql .= " AND price BETWEEN 2000000000 AND 5000000000";
    } elseif ($price_filter == 'above_5b') {
        $sql .= " AND price > 5000000000";
    }
}

// Xử lý sắp xếp (Ưu tiên ghim VinFast VF3 lên đầu)
if ($sort_order == 'price_asc') {
    $sql .= " ORDER BY CASE WHEN name LIKE '%VinFast VF3%' THEN 0 ELSE 1 END, price ASC";
} elseif ($sort_order == 'price_desc') {
    $sql .= " ORDER BY CASE WHEN name LIKE '%VinFast VF3%' THEN 0 ELSE 1 END, price DESC";
} else {
    $sql .= " ORDER BY CASE WHEN name LIKE '%VinFast VF3%' THEN 0 ELSE 1 END, id DESC";
}

$result = $conn->query($sql);

$cars_array = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cars_array[] = $row;
    }
}

// Lấy danh sách thương hiệu để đưa vào dropdown lọc
$brands_result = $conn->query("SELECT DISTINCT brand FROM cars");
$brands = [];
while($b = $brands_result->fetch_assoc()) {
    $brands[] = $b['brand'];
}
?>
<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showroom Xe 4TL - Đẳng Cấp & Tốc Độ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white dark:bg-gray-950 text-gray-900 dark:text-white font-sans transition-colors duration-300 selection:bg-red-600 selection:text-white">

    <!-- Header / Navbar -->
    <header class="bg-white/90 dark:bg-black/90 backdrop-blur-md sticky top-0 z-50 border-b border-gray-200 dark:border-gray-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-red-600 p-2 rounded-xl text-white font-black text-xl"><i class="fa-solid fa-car-side"></i></div>
                <div>
                    <h1 class="text-2xl font-black tracking-wider">SHOWROOM <span class="text-red-500">4TL</span></h1>
                    <p class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-widest">Đỉnh Cao Xe Sang</p>
                </div>
            </div>
            
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-600 dark:text-gray-300">
                <a href="#" class="hover:text-red-500 transition">Trang Chủ</a>
                <a href="#car-list" class="hover:text-red-500 transition">Danh Sách Xe</a>
                <a href="#map-section" class="hover:text-red-500 transition">Vị Trí</a>
                <a href="#contact" class="hover:text-red-500 transition">Liên Hệ</a>
            </nav>

            <div class="flex items-center gap-3">
                <!-- Nút bật tắt Dark/Light Mode -->
                <button onclick="toggleTheme()" class="bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-700 px-3.5 py-2.5 rounded-xl text-sm transition text-yellow-500 dark:text-yellow-400" title="Chuyển đổi giao diện Sáng/Tối">
                    <i id="themeIcon" class="fa-solid fa-sun"></i>
                </button>

                <a href="tel:0765650114" class="hidden sm:flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-xl font-bold text-sm transition shadow-lg shadow-red-600/30">
                    <i class="fa-solid fa-phone"></i> 0765650114
                </a>
                <a href="admin.php" class="bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-700 px-4 py-2.5 rounded-xl text-sm font-semibold transition flex items-center gap-2">
                    <i class="fa-solid fa-user-gear text-red-500 dark:text-red-400"></i> Quản Trị
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-900 dark:to-black py-16 lg:py-24 border-b border-gray-200 dark:border-gray-800 overflow-hidden transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="bg-red-600/20 text-red-600 dark:text-red-400 border border-red-500/30 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider">Showroom 4TL - Uy Tín Hàng Đầu</span>
                <h2 class="text-4xl lg:text-6xl font-black mt-4 mb-6 leading-tight">Khám Phá Sức Mạnh & Đẳng Cấp Thương Hiệu</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-8 text-base leading-relaxed">Showroom 4TL chuyên phân phối các dòng xe ô tô hạng sang và xe điện thông minh nhập khẩu. Cam kết chất lượng, bảo hành chính hãng, hỗ trợ trả góp lên đến 80%.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="#car-list" class="bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3.5 rounded-xl transition flex items-center gap-2 shadow-lg shadow-red-600/30">
                        Xem Danh Sách Xe <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="mailto:anh.2574802012312@vanlanguni.vn" class="bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-700 font-bold px-6 py-3.5 rounded-xl transition flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-red-500"></i> Nhận Báo Giá
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-orange-600 rounded-3xl blur opacity-25"></div>
                <div class="relative bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800" class="w-full h-80 object-cover" alt="Showroom Car">
                </div>
            </div>
        </div>
    </section>

    <!-- Danh sách sản phẩm & Bộ lọc -->
    <main id="car-list" class="max-w-7xl mx-auto px-4 py-16">
        <div class="text-center mb-10">
            <h3 class="text-3xl lg:text-4xl font-black mb-2 tracking-wide">DANH SÁCH XE DÀNH CHO BẠN</h3>
            <div class="w-16 h-1 bg-red-600 mx-auto rounded-full mb-4"></div>
            <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-sm">Lựa chọn các mẫu xe thể thao, SUV cao cấp và sedan hạng sang được tuyển chọn kỹ lưỡng tại Showroom 4TL.</p>
        </div>

        <!-- Thanh Tìm Kiếm & Bộ Lọc / Sắp Xếp -->
        <div class="bg-gray-100 dark:bg-gray-900/90 border border-gray-200 dark:border-gray-800 p-6 rounded-3xl shadow-2xl mb-12 transition-colors duration-300">
            <form method="GET" action="#car-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-center">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Tìm tên xe..." class="w-full bg-white dark:bg-gray-950 border border-gray-300 dark:border-gray-800 placeholder-gray-400 pl-11 pr-4 py-3.5 rounded-xl text-sm focus:outline-none focus:border-red-500 transition">
                </div>

                <div>
                    <select name="brand" class="w-full bg-white dark:bg-gray-950 border border-gray-300 dark:border-gray-800 px-4 py-3.5 rounded-xl text-sm focus:outline-none focus:border-red-500 transition">
                        <option value="">Tất cả thương hiệu</option>
                        <?php foreach($brands as $b): ?>
                            <option value="<?= htmlspecialchars($b) ?>" <?= $brand_filter == $b ? 'selected' : '' ?>><?= htmlspecialchars($b) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <select name="price" class="w-full bg-white dark:bg-gray-950 border border-gray-300 dark:border-gray-800 px-4 py-3.5 rounded-xl text-sm focus:outline-none focus:border-red-500 transition">
                        <option value="">Tất cả mức giá</option>
                        <option value="under_2b" <?= $price_filter == 'under_2b' ? 'selected' : '' ?>>Dưới 2 Tỷ VNĐ</option>
                        <option value="2b_5b" <?= $price_filter == '2b_5b' ? 'selected' : '' ?>>Từ 2 Tỷ - 5 Tỷ VNĐ</option>
                        <option value="above_5b" <?= $price_filter == 'above_5b' ? 'selected' : '' ?>>Trên 5 Tỷ VNĐ</option>
                    </select>
                </div>

                <div>
                    <select name="sort" class="w-full bg-white dark:bg-gray-950 border border-gray-300 dark:border-gray-800 px-4 py-3.5 rounded-xl text-sm focus:outline-none focus:border-red-500 transition">
                        <option value="">Sắp xếp theo giá</option>
                        <option value="price_asc" <?= $sort_order == 'price_asc' ? 'selected' : '' ?>>Giá: Thấp đến Cao</option>
                        <option value="price_desc" <?= $sort_order == 'price_desc' ? 'selected' : '' ?>>Giá: Cao đến Thấp</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 px-3 rounded-xl text-sm transition shadow-lg shadow-red-600/30 text-center">
                        <i class="fa-solid fa-filter me-1"></i> Lọc
                    </button>
                    <a href="index.php#car-list" class="bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-700 px-4 py-3.5 rounded-xl text-sm font-semibold transition flex items-center justify-center" title="Đặt lại bộ lọc">
                        <i class="fa-solid fa-rotate-right"></i>
                    </a>
                </div>
            </form>
        </div>

        <!-- Lưới hiển thị xe -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (count($cars_array) > 0): ?>
                <?php foreach($cars_array as $car): ?>
                    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden hover:border-red-500 transition duration-300 shadow-xl group flex flex-col justify-between relative">
                        
                        <!-- Huy hiệu Best Seller và Trả trước 36% nếu là VinFast VF3 -->
                        <?php if (strpos($car['name'], 'VinFast VF3') !== false): ?>
                            <div class="absolute top-3 left-3 z-10 flex flex-col gap-1.5 items-start">
                                <span class="bg-red-600 text-white text-[11px] px-3 py-1 rounded-full font-black uppercase tracking-wider shadow-lg flex items-center gap-1">
                                    <i class="fa-solid fa-fire"></i> Best Seller
                                </span>
                                <span class="bg-amber-500 text-black text-[11px] px-3 py-1 rounded-full font-black uppercase tracking-wider shadow-lg flex items-center gap-1">
                                    <i class="fa-solid fa-percentage"></i> Trả trước 36%
                                </span>
                            </div>
                        <?php endif; ?>

                        <div>
                            <div class="relative overflow-hidden">
                                <img src="<?= htmlspecialchars($car['image']) ?>" class="w-full h-60 object-cover group-hover:scale-105 transition duration-500" alt="">
                                <span class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-red-400 border border-red-500/30 text-xs px-3 py-1 rounded-full font-bold uppercase">
                                    <?= htmlspecialchars($car['brand']) ?>
                                </span>
                            </div>
                            <div class="p-6">
                                <h4 class="text-xl font-bold mb-1 group-hover:text-red-500 transition"><?= htmlspecialchars($car['name']) ?></h4>
                                <p class="text-2xl font-black text-red-600 dark:text-red-500 mb-4"><?= number_format($car['price'], 0, ',', '.') ?> VNĐ</p>
                                
                                <div class="grid grid-cols-3 gap-2 text-xs text-gray-600 dark:text-gray-400 mb-6 bg-gray-100 dark:bg-black/40 border border-gray-200 dark:border-gray-800 p-3 rounded-xl text-center">
                                    <div><i class="fa-solid fa-microchip text-red-500 block mb-1"></i><?= htmlspecialchars($car['engine']) ?></div>
                                    <div><i class="fa-solid fa-gears text-red-500 block mb-1"></i><?= htmlspecialchars($car['transmission']) ?></div>
                                    <div><i class="fa-solid fa-gas-pump text-red-500 block mb-1"></i><?= htmlspecialchars($car['fuel']) ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 pt-0 flex flex-col gap-2">
                            <button onclick='openModal(<?= json_encode($car) ?>)' class="w-full bg-red-600 hover:bg-red-700 text-center py-3 rounded-xl text-sm font-bold transition shadow-md shadow-red-600/20 flex items-center justify-center gap-2 text-white">
                                <i class="fa-solid fa-circle-info"></i> Xem Chi Tiết
                            </button>
                            <div class="flex gap-2">
                                <a href="tel:0765650114" class="flex-1 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-700 text-center py-2.5 rounded-xl text-xs font-semibold transition"><i class="fa-solid fa-phone text-red-500 me-1"></i> Gọi</a>
                                <a href="mailto:anh.2574802012312@vanlanguni.vn" class="flex-1 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-700 text-center py-2.5 rounded-xl text-xs font-semibold transition"><i class="fa-solid fa-envelope text-red-500 me-1"></i> Email</a>
                                <button onclick="openDepositModal('<?= htmlspecialchars($car['name']) ?>', '<?= number_format($car['price'] * 0.1, 0, ',', '.') ?> VNĐ')" class="flex-1 bg-red-600 hover:bg-red-700 text-center py-2.5 rounded-xl text-xs font-bold transition text-white shadow-md shadow-red-600/30">
                                    <i class="fa-solid fa-qrcode me-1"></i> Cọc
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center py-16 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl">
                    <i class="fa-solid fa-car-burst text-4xl text-gray-400 mb-3"></i>
                    <p class="text-gray-500 dark:text-gray-400 text-lg">Không tìm thấy mẫu xe phù hợp với yêu cầu của bro.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Google Maps Section -->
    <section id="map-section" class="max-w-7xl mx-auto px-4 py-12 border-t border-gray-200 dark:border-gray-800">
        <div class="text-center mb-8">
            <span class="text-red-500 font-bold uppercase tracking-widest text-xs">Chỉ đường đến showroom</span>
            <h3 class="text-3xl font-black mt-1 mb-2">VỊ TRÍ SHOWROOM 4TL TRÊN BẢN ĐỒ</h3>
            <p class="text-gray-600 dark:text-gray-400 text-sm">Địa chỉ: 95 Lê Văn Lương, Tân Hưng, Quận 7, TP. Hồ Chí Minh</p>
        </div>
        <div class="rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-800 shadow-2xl h-[450px]">
            <iframe 
                src="https://maps.google.com/maps?q=95%20L%C3%AA%20V%C4%83n%20L%C6%B0%C6%A1ng,%20T%C3%A2n%20H%C6%B0ng,%20Qu%E1%BA%ADn%207,%20H%E1%BB%ᅩ%20Ch%C3%AD%20Minh&t=&z=17&ie=UTF8&iwloc=&output=embed" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-100 dark:bg-black border-t border-gray-200 dark:border-gray-800 py-12 text-gray-600 dark:text-gray-400 text-sm transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div>
                <h4 class="font-bold text-lg mb-3">SHOWROOM Ô TÔ 4TL</h4>
                <p class="leading-relaxed">Đơn vị uy tín hàng đầu cung cấp các dòng xe hơi cao cấp, xe điện đô thị thời thượng tại TP. Hồ Chí Minh.</p>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-3">Thông Tin Liên Hệ</h4>
                <p class="mb-2"><i class="fa-solid fa-location-dot text-red-500 me-2"></i>95 Lê Văn Lương, Tân Hưng, Quận 7, TP.HCM</p>
                <p class="mb-2"><i class="fa-solid fa-phone text-red-500 me-2"></i>0765650114</p>
                <p><i class="fa-solid fa-envelope text-red-500 me-2"></i>anh.2574802012312@vanlanguni.vn</p>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-3">Giờ Mở Cửa</h4>
                <p class="mb-1">Thứ Hai - Chủ Nhật: 08:00 - 20:00</p>
                <p class="text-xs text-gray-500">Phục vụ tất cả các ngày trong tuần kể cả ngày lễ.</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 pt-6 border-t border-gray-200 dark:border-gray-900 text-center text-xs text-gray-500">
            &copy; 2026 Showroom Ô Tô 4TL. All rights reserved. Designed for Van Lang University Project.
        </div>
    </footer>

    <!-- Modal Popup Chi Tiết Xe -->
    <div id="carModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm hidden flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 w-full max-w-3xl rounded-3xl overflow-hidden shadow-2xl relative transform transition-all">
            <button onclick="closeModal()" class="absolute top-4 right-4 bg-gray-200 dark:bg-black/60 hover:bg-red-600 hover:text-white w-10 h-10 rounded-full flex items-center justify-center transition z-10">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>

            <div class="p-6 md:p-8 max-h-[90vh] overflow-y-auto">
                <div class="mb-6 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800">
                    <img id="modalImage" src="" class="w-full h-72 object-cover" alt="Car Detail">
                </div>

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-gray-100 dark:bg-black/40 border border-gray-200 dark:border-gray-800 p-5 rounded-2xl mb-6">
                    <div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Giá bán niêm yết tại Showroom 4TL</span>
                        <h2 id="modalPrice" class="text-2xl md:text-3xl font-black text-red-600 dark:text-red-500 mt-0.5"></h2>
                    </div>
                    <div class="flex gap-3 w-full md:w-auto">
                        <a href="tel:0765650114" class="flex-1 md:flex-none bg-red-600 hover:bg-red-700 px-5 py-3 rounded-xl font-bold text-sm transition flex items-center justify-center gap-2 shadow-lg shadow-red-600/30 text-white">
                            <i class="fa-solid fa-phone"></i> Gọi Tư Vấn Ngay
                        </a>
                        <a href="mailto:anh.2574802012312@vanlanguni.vn" class="flex-1 md:flex-none bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-700 px-5 py-3 rounded-xl font-bold text-sm transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-envelope text-red-500 dark:text-red-400"></i> Gửi Email
                        </a>
                    </div>
                </div>

                <div class="mb-6">
                    <span id="modalBrand" class="text-xs bg-red-600/20 text-red-600 dark:text-red-400 border border-red-500/30 px-3 py-1 rounded-full font-bold uppercase"></span>
                    <h3 id="modalName" class="text-2xl font-black mt-2"></h3>
                </div>

                <div class="mb-6">
                    <h4 class="text-base font-bold mb-3 text-red-600 dark:text-red-400 flex items-center gap-2">
                        <i class="fa-solid fa-sliders"></i> Thông Số Kỹ Thuật Chi Tiết
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="bg-gray-100 dark:bg-black/40 border border-gray-200 dark:border-gray-800 p-3.5 rounded-xl">
                            <span class="text-xs text-gray-500 dark:text-gray-400 block mb-1">Động Cơ:</span>
                            <strong id="modalEngine" class="text-sm"></strong>
                        </div>
                        <div class="bg-gray-100 dark:bg-black/40 border border-gray-200 dark:border-gray-800 p-3.5 rounded-xl">
                            <span class="text-xs text-gray-500 dark:text-gray-400 block mb-1">Hộp Số:</span>
                            <strong id="modalTransmission" class="text-sm"></strong>
                        </div>
                        <div class="bg-gray-100 dark:bg-black/40 border border-gray-200 dark:border-gray-800 p-3.5 rounded-xl">
                            <span class="text-xs text-gray-500 dark:text-gray-400 block mb-1">Nhiên Liệu:</span>
                            <strong id="modalFuel" class="text-sm"></strong>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-base font-bold mb-2 text-red-600 dark:text-red-400 flex items-center gap-2">
                        <i class="fa-solid fa-circle-info"></i> Mô Tả & Đánh Giá Xe
                    </h4>
                    <p id="modalDesc" class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed bg-gray-100 dark:bg-black/40 border border-gray-200 dark:border-gray-800 p-4 rounded-xl"></p>
                </div>

                <div class="mt-8 text-right">
                    <button onclick="closeModal()" class="bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-700 px-6 py-2.5 rounded-xl text-sm font-semibold transition">
                        Đóng Window
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal QR Code Đặt Cọc -->
    <div id="depositModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 w-full max-w-md rounded-3xl overflow-hidden shadow-2xl relative p-6 text-center">
            <button onclick="closeDepositModal()" class="absolute top-4 right-4 bg-gray-200 dark:bg-black/60 hover:bg-red-600 hover:text-white w-9 h-9 rounded-full flex items-center justify-center transition">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <h3 class="text-xl font-black mb-1"><i class="fa-solid fa-qrcode text-red-500 me-2"></i> QUÉT MÃ QR ĐẶT CỌC</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Thanh toán tiền cọc xe nhanh chóng qua ứng dụng ngân hàng</p>

            <div class="bg-white p-4 rounded-2xl inline-block shadow-lg mb-4 border border-gray-200">
                <img src="qrcode.jpg" alt="QR Code Dat Coc" class="w-64 h-auto mx-auto rounded-lg">
            </div>

            <div class="bg-gray-100 dark:bg-black/40 border border-gray-200 dark:border-gray-800 p-3.5 rounded-xl text-left text-xs space-y-1.5 mb-5">
                <p class="text-gray-500 dark:text-gray-400">Xe đặt cọc: <strong id="depositCarName" class="text-gray-900 dark:text-white"></strong></p>
                <p class="text-gray-500 dark:text-gray-400">Số tiền cọc tối thiểu (10%): <strong id="depositAmount" class="text-red-600 dark:text-red-500 font-bold"></strong></p>
                <p class="text-gray-500 dark:text-gray-400">Chủ tài khoản: <strong class="text-gray-900 dark:text-white">VU NGO QUOC ANH</strong></p>
                <p class="text-gray-500 dark:text-gray-400">Số tài khoản MB Bank: <strong class="text-gray-900 dark:text-white">080820079</strong></p>
            </div>

            <button onclick="closeDepositModal()" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl text-sm transition shadow-lg shadow-red-600/30">
                Đã Hoàn Tất Chuyển Khoản
            </button>
        </div>
    </div>

    <script>
        // Kiểm tra trạng thái giao diện đã lưu (Dark / Light Mode)
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
            document.getElementById('themeIcon').className = "fa-solid fa-moon text-gray-700";
        } else {
            document.documentElement.classList.add('dark');
            document.getElementById('themeIcon').className = "fa-solid fa-sun text-yellow-400";
        }

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                document.getElementById('themeIcon').className = "fa-solid fa-moon text-gray-700";
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                document.getElementById('themeIcon').className = "fa-solid fa-sun text-yellow-400";
            }
        }

        function openModal(car) {
            document.getElementById('modalImage').src = car.image;
            document.getElementById('modalBrand').innerText = car.brand;
            document.getElementById('modalName').innerText = car.name;
            document.getElementById('modalPrice').innerText = Number(car.price).toLocaleString('vi-VN') + ' VNĐ';
            document.getElementById('modalEngine').innerText = car.engine || 'Đang cập nhật';
            document.getElementById('modalTransmission').innerText = car.transmission || 'Đang cập nhật';
            document.getElementById('modalFuel').innerText = car.fuel || 'Đang cập nhật';
            document.getElementById('modalDesc').innerText = car.description || 'Chưa có mô tả chi tiết cho dòng xe này.';
            
            document.getElementById('carModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('carModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openDepositModal(carName, amount) {
            document.getElementById('depositCarName').innerText = carName;
            document.getElementById('depositAmount').innerText = amount;
            document.getElementById('depositModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDepositModal() {
            document.getElementById('depositModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            let modal = document.getElementById('carModal');
            let depositModal = document.getElementById('depositModal');
            if (event.target == modal) {
                closeModal();
            }
            if (event.target == depositModal) {
                closeDepositModal();
            }
        }
    </script>
</body>
</html>