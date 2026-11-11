<?php
require_once 'db.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

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

if (!$car) { die("Không tìm thấy xe!"); }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Thông Tin Xe - Showroom 4TL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6 font-sans">
    <div class="max-w-2xl mx-auto bg-gray-800 p-8 rounded-2xl border border-gray-700 shadow-xl">
        <h1 class="text-2xl font-bold mb-6 text-red-500">Chỉnh Sửa Thông Tin Xe</h1>
        
        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="name" value="<?= htmlspecialchars($car['name']) ?>" required class="bg-gray-700 p-3 rounded border border-gray-600">
            <input type="text" name="brand" value="<?= htmlspecialchars($car['brand']) ?>" required class="bg-gray-700 p-3 rounded border border-gray-600">
            <input type="number" step="0.01" name="price" value="<?= $car['price'] ?>" required class="bg-gray-700 p-3 rounded border border-gray-600">
            <input type="text" name="image" value="<?= htmlspecialchars($car['image']) ?>" required class="bg-gray-700 p-3 rounded border border-gray-600">
            <input type="text" name="engine" value="<?= htmlspecialchars($car['engine']) ?>" class="bg-gray-700 p-3 rounded border border-gray-600">
            <input type="text" name="transmission" value="<?= htmlspecialchars($car['transmission']) ?>" class="bg-gray-700 p-3 rounded border border-gray-600">
            <input type="text" name="fuel" value="<?= htmlspecialchars($car['fuel']) ?>" class="bg-gray-700 p-3 rounded border border-gray-600 md:col-span-2">
            <textarea name="description" rows="4" class="bg-gray-700 p-3 rounded border border-gray-600 md:col-span-2"><?= htmlspecialchars($car['description']) ?></textarea>
            
            <div class="md:col-span-2 flex gap-4 mt-2">
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 py-3 rounded font-bold transition">Cập Nhật Thay Đổi</button>
                <a href="admin.html" class="bg-gray-700 hover:bg-gray-600 px-6 py-3 rounded text-center transition">Hủy</a>
            </div>
        </form>
    </div>
</body>
</html>