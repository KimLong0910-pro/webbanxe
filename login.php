<?php
session_start();
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            // Kiểm tra mật khẩu (hỗ trợ cả mật khẩu mã hóa password_hash hoặc so sánh trực tiếp)
            if ($user && (password_verify($password, $user['password']) || $password === $user['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_user'] = $user['username'];
                header('Location: admin.html');
                exit();
            } else {
                $error = 'Tài khoản hoặc mật khẩu không chính xác!';
            }
        } catch (PDOException $e) {
            $error = 'Lỗi truy vấn hệ thống: ' . $e->getMessage();
        }
    } else {
        $error = 'Vui lòng nhập đầy đủ tài khoản và mật khẩu!';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập Quản Trị - Showroom 4TL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center p-6 font-sans">
    <div class="w-full max-w-md bg-gray-800 p-8 rounded-2xl border border-gray-700 shadow-xl">
        <h1 class="text-2xl font-bold mb-6 text-red-500 text-center">ĐĂNG NHẬP ADMIN</h1>
        
        <?php if ($error): ?>
            <div class="bg-red-500/10 border border-red-500 text-red-400 p-3 rounded mb-4 text-sm text-center">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-gray-400 text-sm mb-1">Tài khoản</label>
                <input type="text" name="username" required class="w-full bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500">
            </div>
            <div>
                <label class="block text-gray-400 text-sm mb-1">Mật khẩu</label>
                <input type="password" name="password" required class="w-full bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500">
            </div>
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 py-3 rounded font-bold transition mt-2">
                Đăng Nhập
            </button>
        </form>
    </div>
</body>
</html>