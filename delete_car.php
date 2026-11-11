<?php
require_once 'db.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM cars WHERE id = $id");
}
header("Location: admin.php");
exit();
?>