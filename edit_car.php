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

$input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
$id = intval($input['id'] ?? 0);
$name = trim($input['name'] ?? '');
$brand = trim($input['brand'] ?? '');
$price = floatval($input['price'] ?? 0);
$image = trim($input['image'] ?? '');
$engine = trim($input['engine'] ?? '');
$transmission = trim($input['transmission'] ?? '');
$fuel = trim($input['fuel'] ?? '');
$description = trim($input['description'] ?? '');

if ($id <= 0 || empty($name) || empty($brand)) {
    echo json_encode(["status" => "error", "message" => "Dữ liệu cập nhật không hợp lệ"], JSON_UNESCAPED_UNICODE);
    exit();
}

if (!$pdo) {
    echo json_encode(["status" => "error", "message" => "Chưa kết nối được CSDL MySQL"], JSON_UNESCAPED_UNICODE);
    exit();
}

try {
    $stmt = $pdo->prepare("UPDATE cars SET name=?, brand=?, price=?, image=?, engine=?, transmission=?, fuel=?, description=? WHERE id=?");
    $stmt->execute([$name, $brand, $price, $image, $engine, $transmission, $fuel, $description, $id]);
    echo json_encode(["status" => "success", "message" => "Cập nhật thông tin xe thành công!"], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Lỗi CSDL: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>