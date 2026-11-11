<?php
require_once 'db.php';
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $engine = $_POST['engine'];
    $transmission = $_POST['transmission'];
    $fuel = $_POST['fuel'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO cars (name, brand, price, image, engine, transmission, fuel, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsssss", $name, $brand, $price, $image, $engine, $transmission, $fuel, $description);
    
    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        $msg = "Lỗi khi thêm xe!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Xe Mới - Showroom 4TL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6 font-sans">
    <div class="max-w-2xl mx-auto bg-gray-800 p-8 rounded-2xl border border-gray-700 shadow-xl">
        <h1 class="text-2xl font-bold mb-6 text-red-500">Thêm Sản Phẩm Xe Mới</h1>
        <?php if($msg): ?><p class="text-red-400 mb-4"><?= $msg ?></p><?php endif; ?>
        
        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="name" placeholder="Tên xe (VD: VinFast VF9)" required class="bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500">
            <input type="text" name="brand" placeholder="Hãng xe (VD: VinFast)" required class="bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500">
            <input type="number" step="0.01" name="price" placeholder="Giá xe (VNĐ)" required class="bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500">
            <input type="text" name="image" placeholder="Link URL hình ảnh xe" required class="bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500">
            <input type="text" name="engine" placeholder="Động cơ (VD: Điện đôi)" class="bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500">
            <input type="text" name="transmission" placeholder="Hộp số (VD: Tự động)" class="bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500">
            <input type="text" name="fuel" placeholder="Nhiên liệu (VD: Điện)" class="bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500 md:col-span-2">
            <textarea name="description" placeholder="Mô tả chi tiết về xe..." rows="4" class="bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500 md:col-span-2"></textarea>
            
            <div class="md:col-span-2 flex gap-4 mt-2">
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 py-3 rounded font-bold transition">Lưu Xe Vào CSDL</button>
                <a href="admin.php" class="bg-gray-700 hover:bg-gray-600 px-6 py-3 rounded text-center transition">Hủy</a>
            </div>
        </form>
    </div>
</body>
</html>