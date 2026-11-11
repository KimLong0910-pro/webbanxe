<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $price = $_POST['price'] ?? 0;
    $engine = $_POST['engine'] ?? '';
    $transmission = $_POST['transmission'] ?? '';
    $fuel = $_POST['fuel'] ?? '';
    $image = $_POST['image'] ?? 'default.jpg';
    $description = $_POST['description'] ?? '';

    if (!empty($name) && !empty($brand)) {
        $stmt = $conn->prepare("INSERT INTO cars (name, brand, price, engine, transmission, fuel, image, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsssss", $name, $brand, $price, $engine, $transmission, $fuel, $image, $description);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Thêm xe thành công"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Lỗi: " . $stmt->error]);
        }
    }
}
?>