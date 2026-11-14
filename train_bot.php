<?php
require_once 'auth_check.php';
requireAdminApi();
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if (!$pdo) {
    echo json_encode(["status" => "error", "message" => "Chưa kết nối được CSDL MySQL", "data" => []], JSON_UNESCAPED_UNICODE);
    exit();
}

$action = $_GET['action'] ?? '';
$input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
if (empty($action) && isset($input['action'])) {
    $action = $input['action'];
}

try {
    if ($action === 'list' || ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($action))) {
        $stmt = $pdo->query("SELECT * FROM bot_knowledge ORDER BY id DESC");
        $knowledges = $stmt->fetchAll();
        echo json_encode(["status" => "success", "data" => $knowledges], JSON_UNESCAPED_UNICODE);

    } elseif ($action === 'add') {
        $keywords = mb_strtolower(trim($input['keywords'] ?? ''), 'UTF-8');
        $response = trim($input['response'] ?? '');

        if (empty($keywords) || empty($response)) {
            echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ từ khóa và câu trả lời!"], JSON_UNESCAPED_UNICODE);
            exit();
        }

        $stmt = $pdo->prepare("INSERT INTO bot_knowledge (keywords, response) VALUES (?, ?)");
        $stmt->execute([$keywords, $response]);
        echo json_encode(["status" => "success", "message" => "Đã lưu từ khóa huấn luyện thành công!"], JSON_UNESCAPED_UNICODE);

    } elseif ($action === 'delete') {
        $id = intval($_GET['id'] ?? $input['id'] ?? 0);
        if ($id <= 0) {
            echo json_encode(["status" => "error", "message" => "ID không hợp lệ!"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $stmt = $pdo->prepare("DELETE FROM bot_knowledge WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(["status" => "success", "message" => "Đã xóa từ khóa!"], JSON_UNESCAPED_UNICODE);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Lỗi CSDL: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>