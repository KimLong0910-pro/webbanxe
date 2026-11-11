<?php
require_once 'db.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$car = null;
if ($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $brand = trim($_POST['brand']);
        $price = $_POST['price'];
        $image = trim($_POST['image']);
        $engine = trim($_POST['engine']);
        $transmission = trim($_POST['transmission']);
        $fuel = trim($_POST['fuel']);
        $description = trim($_POST['description']);

        $stmt = $pdo->prepare("UPDATE cars SET name=?, brand=?, price=?, image=?, engine=?, transmission=?, fuel=?, description=? WHERE id=?");
        $stmt->execute([$name, $brand, $price, $image, $engine, $transmission, $fuel, $description, $id]);
        
        header("Location: admin.html");
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM cars WHERE id = ?");
    $stmt->execute([$id]);
    $car = $stmt->fetch();
}

if (!$car) {
    // Fallback default car if testing without active MySQL
    $car = [
        'id' => $id,
        'name' => 'Siêu Xe Mẫu',
        'brand' => 'Showroom 4TL',
        'price' => 2000000000,
        'image' => 'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800',
        'engine' => '3.0L Twin-Turbo (450 HP)',
        'transmission' => 'Tự động 8 cấp',
        'fuel' => 'Xăng',
        'description' => 'Mẫu xe sang thể thao hiệu năng cao đang được trưng bày tại Showroom 4TL.'
    ];
}
?>
<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Xe #<?= $id ?> - SHOWROOM 4TL</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-[#0b0f19] text-gray-100 p-4 sm:p-8 font-sans min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full bg-slate-900/90 backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-white/10 shadow-2xl space-y-6">
        
        <div class="flex justify-between items-center border-b border-white/10 pb-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center text-white">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black text-white font-heading">CHỈNH SỬA THÔNG TIN XE</h1>
                    <span class="text-xs text-gray-400">Mã định danh: #<?= htmlspecialchars($car['id']) ?></span>
                </div>
            </div>
            <a href="admin.html" class="text-xs text-gray-400 hover:text-white transition">&larr; Quay lại Admin</a>
        </div>
        
        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Tên xe / Model</label>
                <input type="text" name="name" value="<?= htmlspecialchars($car['name']) ?>" required class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Hãng sản xuất</label>
                <input type="text" name="brand" value="<?= htmlspecialchars($car['brand']) ?>" required class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Giá bán (VNĐ)</label>
                <input type="number" step="100000" name="price" value="<?= $car['price'] ?>" required class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Loại nhiên liệu</label>
                <input type="text" name="fuel" value="<?= htmlspecialchars($car['fuel'] ?? 'Xăng') ?>" class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Động cơ & Công suất</label>
                <input type="text" name="engine" value="<?= htmlspecialchars($car['engine'] ?? '') ?>" class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Hộp số</label>
                <input type="text" name="transmission" value="<?= htmlspecialchars($car['transmission'] ?? '') ?>" class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-400 mb-1 font-bold">URL Hình ảnh</label>
                <input type="text" name="image" value="<?= htmlspecialchars($car['image']) ?>" required class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-400 mb-1 font-bold">Mô tả chi tiết</label>
                <textarea name="description" rows="3" class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500"><?= htmlspecialchars($car['description'] ?? '') ?></textarea>
            </div>
            
            <div class="md:col-span-2 flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3.5 rounded-xl font-bold transition shadow-lg shadow-red-600/30 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-check"></i> Lưu Cập Nhật
                </button>
                <a href="admin.html" class="bg-slate-800 hover:bg-slate-700 text-gray-300 px-6 py-3.5 rounded-xl text-center font-bold border border-white/10 transition">
                    Hủy
                </a>
            </div>
        </form>
    </div>
</body>
</html>
