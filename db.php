<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "web_ban_xe";

// Kết nối MySQLi
$conn = @new mysqli($host, $user, $pass, $dbname);
if ($conn && !$conn->connect_error) {
    $conn->set_charset("utf8mb4");
}

// Kết nối PDO cho các file login, edit_car
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (Exception $e) {
    $pdo = null;
}
?>