<?php
session_start();
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        // Cho phép đăng nhập nhanh admin/admin123 hoặc so sánh qua CSDL
        if (($username === 'admin' && ($password === 'admin123' || $password === 'admin'))) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user'] = $username;
            header('Location: admin.html');
            exit();
        }

        if ($pdo) {
            try {
                $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->execute([$username]);
                $user = $stmt->fetch();

                if ($user && (password_verify($password, $user['password']) || $password === $user['password'])) {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_user'] = $user['username'];
                    header('Location: admin.html');
                    exit();
                } else {
                    $error = 'Tài khoản hoặc mật khẩu không chính xác!';
                }
            } catch (Exception $e) {
                $error = 'Lỗi truy vấn: ' . $e->getMessage();
            }
        } else {
            $error = 'Tài khoản hoặc mật khẩu không chính xác!';
        }
    } else {
        $error = 'Vui lòng nhập đầy đủ tài khoản và mật khẩu!';
    }
}
?>
<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Quản Trị - SHOWROOM 4TL</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-[#0b0f19] text-gray-100 min-h-screen flex items-center justify-center p-4 font-sans hero-gradient-mesh">

    <div class="w-full max-w-md bg-slate-900/90 backdrop-blur-xl p-8 rounded-3xl border border-white/10 shadow-2xl space-y-6">
        
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-red-600 to-red-800 flex items-center justify-center text-white mx-auto shadow-lg shadow-red-600/30">
                <i class="fa-solid fa-lock text-xl"></i>
            </div>
            <h1 class="text-2xl font-black text-white font-heading tracking-wide">CỔNG QUẢN TRỊ VIÊN</h1>
            <p class="text-xs text-gray-400">Đăng nhập tài khoản điều hành Showroom 4TL</p>
        </div>

        <?php if ($error): ?>
            <div class="bg-red-500/10 border border-red-500/40 text-red-400 p-3.5 rounded-2xl text-xs text-center flex items-center justify-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4 text-xs">
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Tài khoản quản trị</label>
                <div class="relative">
                    <i class="fa-solid fa-user absolute left-3.5 top-3.5 text-gray-400"></i>
                    <input type="text" name="username" required placeholder="Nhập tài khoản (VD: admin)" class="w-full pl-10 pr-4 py-3 bg-slate-800 border border-white/10 rounded-xl text-white focus:outline-none focus:border-red-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-gray-400 mb-1 font-bold">Mật khẩu</label>
                <div class="relative">
                    <i class="fa-solid fa-key absolute left-3.5 top-3.5 text-gray-400"></i>
                    <input type="password" name="password" required placeholder="Nhập mật khẩu (VD: admin123)" class="w-full pl-10 pr-4 py-3 bg-slate-800 border border-white/10 rounded-xl text-white focus:outline-none focus:border-red-500 transition">
                </div>
            </div>

            <div class="p-3 rounded-xl bg-slate-950/60 border border-white/5 text-[11px] text-gray-400">
                <span class="text-yellow-400 font-bold">Gợi ý đăng nhập thử nghiệm:</span><br>
                Tài khoản: <code class="text-white font-mono">admin</code> | Mật khẩu: <code class="text-white font-mono">admin123</code>
            </div>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-red-600/30 flex items-center justify-center gap-2">
                <i class="fa-solid fa-right-to-bracket"></i> Đăng Nhập Hệ Thống
            </button>
        </form>

        <div class="text-center pt-2 border-t border-white/10">
            <a href="index.html" class="text-xs text-gray-400 hover:text-white transition flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Quay lại trang chủ Showroom
            </a>
        </div>

    </div>

</body>
</html>
