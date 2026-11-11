<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM cars WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Xóa xe thành công"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi xóa bản ghi"]);
    }
}
?>