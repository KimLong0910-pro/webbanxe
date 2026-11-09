<?php
require_once 'db.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt =$conn->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->bind_param("i", $id);$stmt->execute();
$result =$stmt->get_result();
$car =$result->fetch_assoc();

if (!$car) {
    die("<div style='background:#111;color:#fff;padding:50px;text-align:center;'><h2>Không tìm thấy xe!</h2><a href='index.php' style='color:red;'>Quay lại trang chủ</a></div>");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><= htmlspecialchars($car['name']) ?> - Showroom 4TL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white font-sans p-6">
    <div class="max-w-4xl mx-auto bg-gray-800 border border-gray-700 rounded-2xl overflow-hidden shadow-2xl p-6 md:p-10">
        <a href="index.php" class="inline-block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded text-sm mb-6 transition"><i class="fa-solid fa-arrow-left me-2"></i>Quay lại trang chủ</a>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <img src="<?= htmlspecialchars($car['image']) ?>" class="w-full h-80 object-cover rounded-xl border border-gray-700" alt="">
            <div>
                <span class="bg-red-600/20 text-red-400 px-3 py-1 rounded text-xs font-bold"><?= htmlspecialchars($car['brand']) ?></span>
                <h1 class="text-3xl font-extrabold mt-2 mb-2"><?= htmlspecialchars($car['name']) ?></h1>
                <p class="text-3xl font-black text-red-500 mb-6"><?= number_format($car['price'], 0, ',', '.') ?> VNĐ</p>
                
                <ul class="space-y-3 text-sm text-gray-300 mb-6 border-t border-b border-gray-700 py-4">
                    <li><strong class="text-white">Động cơ:</strong> <?= htmlspecialchars($car['engine']) ?></li>
                    <li><strong class="text-white">Hộp số:</strong> <?= htmlspecialchars($car['transmission']) ?></li>
                    <li><strong class="text-white">Nhiên liệu:</strong> <?= htmlspecialchars($car['fuel']) ?></li>
                </ul>

                <div class="flex gap-4">
                    <a href="tel:0765650114" class="flex-1 bg-red-600 hover:bg-red-700 text-center py-3 rounded-xl font-bold transition"><i class="fa-solid fa-phone me-2"></i>Gọi: 0765650114</a>
                    <a href="mailto:anh.2574802012312@vanlanguni.vn" class="bg-gray-700 hover:bg-gray-600 px-5 py-3 rounded-xl font-bold transition text-center"><i class="fa-solid fa-envelope"></i></a>
                </div>
            </div>
        </div>

        <div class="mt-8 border-t border-gray-700 pt-6">
            <h3 class="text-xl font-bold mb-3 text-red-500">Mô tả chi tiết xe</h3>
            <p class="text-gray-300 leading-relaxed"><?= nl2br(htmlspecialchars($car['description'])) ?></p>
        </div>
    </div>
</body>
</html>