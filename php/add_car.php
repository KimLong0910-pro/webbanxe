<?php
require_once 'auth_check.php';
requireAdminApi();

require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Phương thức không hợp lệ"], JSON_UNESCAPED_UNICODE);
    exit();
}

$name = trim($_POST['name'] ?? '');
$brand = trim($_POST['brand'] ?? '');
$price = floatval($_POST['price'] ?? 0);
$engine = trim($_POST['engine'] ?? '');
$transmission = trim($_POST['transmission'] ?? '');
$fuel = trim($_POST['fuel'] ?? '');
$image = trim($_POST['image'] ?? '');
$description = trim($_POST['description'] ?? '');

if (empty($image)) {
    $image = 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800';
}

if (empty($name) || empty($brand)) {
    echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ tên xe và hãng xe!"], JSON_UNESCAPED_UNICODE);
    exit();
}

if (!$pdo) {
    echo json_encode(["status" => "error", "message" => "Chưa kết nối được CSDL MySQL"], JSON_UNESCAPED_UNICODE);
    exit();
}

try {
    $stmt = $pdo->prepare("INSERT INTO cars (name, brand, price, engine, transmission, fuel, image, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $brand, $price, $engine, $transmission, $fuel, $image, $description]);
    echo json_encode(["status" => "success", "message" => "Thêm xe thành công"], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Lỗi CSDL: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>