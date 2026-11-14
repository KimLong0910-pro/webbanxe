<?php
require_once 'auth_check.php';
requireAdminApi();

require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if (!$pdo) {
    echo json_encode(["bookings" => [], "deposits" => []], JSON_UNESCAPED_UNICODE);
    exit();
}

$action = $_GET['action'] ?? 'list';

try {
    if ($action === 'list') {
        $bookings = $pdo->query("SELECT * FROM bookings ORDER BY id DESC")->fetchAll();
        $deposits = $pdo->query("SELECT * FROM deposits ORDER BY id DESC")->fetchAll();
        echo json_encode(["bookings" => $bookings, "deposits" => $deposits], JSON_UNESCAPED_UNICODE);

    } elseif ($action === 'update_status') {
        $table = (($_GET['table'] ?? '') === 'deposits') ? 'deposits' : 'bookings';
        $id = intval($_GET['id'] ?? 0);
        $status = $_GET['status'] ?? 'pending';

        $stmt = $pdo->prepare("UPDATE {$table} SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
        echo json_encode(["status" => "success"], JSON_UNESCAPED_UNICODE);

    } elseif ($action === 'delete') {
        $table = (($_GET['table'] ?? '') === 'deposits') ? 'deposits' : 'bookings';
        $id = intval($_GET['id'] ?? 0);

        $stmt = $pdo->prepare("DELETE FROM {$table} WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(["status" => "success"], JSON_UNESCAPED_UNICODE);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>