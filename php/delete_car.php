<?php
require_once 'auth_check.php';
requireAdminApi();

require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if (!$pdo) {
    echo json_encode(["status" => "error", "message" => "Chưa kết nối được CSDL MySQL"], JSON_UNESCAPED_UNICODE);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
$id = intval($_GET['id'] ?? $input['id'] ?? 0);

if ($id <= 0) {
    echo json_encode(["status" => "error", "message" => "ID xe không hợp lệ!"], JSON_UNESCAPED_UNICODE);
    exit();
}

try {
    $stmt = $pdo->prepare("DELETE FROM cars WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["status" => "success", "message" => "Xóa xe thành công!"], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["status" => "error", "message" => "Không tìm thấy xe cần xóa hoặc xe đã bị xóa trước đó."], JSON_UNESCAPED_UNICODE);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Lỗi CSDL: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>