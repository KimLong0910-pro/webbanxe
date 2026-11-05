<?php
require_once 'config/db.php';

// Xử lý Xóa xe
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM cars WHERE id = $id");
    header("Location: admin.php");
    exit();
}

// Xử lý Thêm xe
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
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
    $stmt->execute();
    header("Location: admin.php");
    exit();
}

$cars = $conn->query("SELECT * FROM cars ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Trị Hệ Thống - Showroom 4TL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-red-500">Trang Quản Trị Xe Showroom 4TL</h1>
            <a href="index.php" class="bg-gray-700 px-4 py-2 rounded hover:bg-gray-600">Về trang chủ</a>
        </div>

        <!-- Form Thêm Xe Mới -->
        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 mb-8">
            <h2 class="text-xl font-bold mb-4">Thêm sản phẩm xe mới</h2>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="hidden" name="action" value="add">
                <input type="text" name="name" placeholder="Tên xe" required class="bg-gray-700 p-2.5 rounded border border-gray-600">
                <input type="text" name="brand" placeholder="Hãng xe (VD: Porsche, BMW)" required class="bg-gray-700 p-2.5 rounded border border-gray-600">
                <input type="number" step="0.01" name="price" placeholder="Giá xe (VNĐ)" required class="bg-gray-700 p-2.5 rounded border border-gray-600">
                <input type="text" name="image" placeholder="URL hình ảnh" required class="bg-gray-700 p-2.5 rounded border border-gray-600">
                <input type="text" name="engine" placeholder="Động cơ (VD: 2.0L Turbo)" class="bg-gray-700 p-2.5 rounded border border-gray-600">
                <input type="text" name="transmission" placeholder="Hộp số (VD: Tự động 8 cấp)" class="bg-gray-700 p-2.5 rounded border border-gray-600">
                <input type="text" name="fuel" placeholder="Nhiên liệu (VD: Xăng, Điện)" class="bg-gray-700 p-2.5 rounded border border-gray-600">
                <textarea name="description" placeholder="Mô tả chi tiết" class="bg-gray-700 p-2.5 rounded border border-gray-600 md:col-span-2"></textarea>
                <button type="submit" class="bg-red-600 hover:bg-red-700 py-3 rounded font-bold md:col-span-2">Thêm Xe Vào CSDL</button>
            </form>
        </div>

        <!-- Danh sách Quản lý (Read / Delete) -->
        <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="p-4">ID</th>
                        <th class="p-4">Tên xe</th>
                        <th class="p-4">Hãng</th>
                        <th class="p-4">Giá</th>
                        <th class="p-4">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $cars->fetch_assoc()): ?>
                    <tr class="border-t border-gray-700">
                        <td class="p-4"><?= $row['id'] ?></td>
                        <td class="p-4 font-bold"><?= htmlspecialchars($row['name']) ?></td>
                        <td class="p-4"><?= htmlspecialchars($row['brand']) ?></td>
                        <td class="p-4 text-red-400"><?= number_format($row['price'], 0, ',', '.') ?> VNĐ</td>
                        <td class="p-4">
                            <a href="admin.php?delete=<?= $row['id'] ?>" onclick="return confirm('Bro có chắc muốn xóa xe này?')" class="bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded text-xs">Xóa</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>