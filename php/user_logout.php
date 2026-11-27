<?php
session_start();
unset($_SESSION['user_logged_in'], $_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_phone'], $_SESSION['user_email']);

header("Content-Type: application/json; charset=UTF-8");
if (isset($_GET['redirect']) && $_GET['redirect'] === '1') {
    header('Location: ../index.html');
    exit();
}
echo json_encode(["status" => "success", "message" => "Đã đăng xuất tài khoản khách hàng."], JSON_UNESCAPED_UNICODE);