<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

$sql = "SELECT * FROM cars ORDER BY id DESC";
$result = $conn->query($sql);
$cars = [];

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $row['price'] = (float)$row['price'];
        $cars[] = $row;
    }
}

echo json_encode($cars, JSON_UNESCAPED_UNICODE);
?>