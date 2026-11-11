<?php
session_start();
require_once 'db.php';

$msg = '';

// Xử lý thêm dữ liệu huấn luyện mới
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $keywords = strtolower(trim($_POST['keywords']));
    $response = trim($_POST['response']);

    if (!empty($keywords) && !empty($response)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO bot_knowledge (keywords, response) VALUES (?, ?)");
            $stmt->execute([$keywords, $response]);
            $msg = "Đã lưu từ khóa huấn luyện thành công!";
        } catch (PDOException $e) {
            $msg = "Lỗi khi lưu dữ liệu: " . $e->getMessage();
        }
    } else {
        $msg = "Vui lòng nhập đầy đủ thông tin!";
    }
}

// Xử lý xóa từ khóa
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM bot_knowledge WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: train_bot.php');
    exit();
}

// Lấy danh sách dữ liệu tri thức bot đang có
$knowledges = [];
try {
    $stmt = $pdo->query("SELECT * FROM bot_knowledge ORDER BY id DESC");
    $knowledges = $stmt->fetchAll();
} catch (PDOException $e) {
    // Nếu chưa có bảng bot_knowledge thì báo lỗi nhẹ
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Huấn Luyện AI Chatbot - Showroom 4TL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6 font-sans">
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex justify-between items-center bg-gray-800 p-4 rounded-xl border border-gray-700">
            <h1 class="text-xl font-bold text-red-500">Huấn Luyện AI Chatbot (Train Bot)</h1>
            <a href="admin.html" class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded text-sm transition">Quay về Admin</a>
        </div>

        <!-- Form Thêm Tri Thức Mới -->
        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-xl">
            <h2 class="text-lg font-semibold mb-4 text-gray-200">Thêm Dữ Liệu Phản Hồi Mới</h2>
            <?php if ($msg): ?>
                <p class="text-emerald-400 mb-4 text-sm"><?= htmlspecialchars($msg) ?></p>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                <input type="hidden" name="action" value="add">
                <div>
                    <label class="block text-gray-400 text-sm mb-1">Từ khóa nhận biết (phân cách bằng dấu phẩy)</label>
                    <input type="text" name="keywords" placeholder="Ví dụ: gia, bao nhieu, chi phi" required class="w-full bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500">
                </div>
                <div>
                    <label class="block text-gray-400 text-sm mb-1">Câu trả lời phản hồi tự động</label>
                    <textarea name="response" rows="3" placeholder="Ví dụ: Giá siêu xe dao động từ $200,000 đến $3,000,000..." required class="w-full bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500"></textarea>
                </div>
                <button type="submit" class="bg-red-600 hover:bg-red-700 px-6 py-2.5 rounded font-bold transition">
                    + Lưu Dữ Liệu Train
                </button>
            </form>
        </div>

        <!-- Bảng Danh Sách Tri Thức Đang Có -->
        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-xl overflow-x-auto">
            <h2 class="text-lg font-semibold mb-4 text-gray-200">Danh Sách Từ Khóa Đã Huấn Luyện</h2>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-700 text-gray-400 text-sm">
                        <th class="p-3">ID</th>
                        <th class="p-3">Từ khóa (Keywords)</th>
                        <th class="p-3">Câu phản hồi (Response)</th>
                        <th class="p-3 text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/50">
                    <?php if (empty($knowledges)): ?>
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">Chưa có dữ liệu tri thức nào.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($knowledges as $k): ?>
                            <tr class="hover:bg-gray-750">
                                <td class="p-3 text-sm text-gray-400"><?= $k['id'] ?></td>
                                <td class="p-3 text-red-400 font-medium"><?= htmlspecialchars($k['keywords']) ?></td>
                                <td class="p-3 text-gray-300 text-sm"><?= htmlspecialchars($k['response']) ?></td>
                                <td class="p-3 text-right">
                                    <a href="train_bot.php?delete=<?= $k['id'] ?>" onclick="return confirm('Bạn có muốn xóa từ khóa này?');" class="text-red-400 hover:text-red-300 text-sm font-medium">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>