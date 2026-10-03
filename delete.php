<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM trails WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: read.php');
exit;
?>