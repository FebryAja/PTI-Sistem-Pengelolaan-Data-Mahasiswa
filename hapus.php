<?php
session_start();
require_once "config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header("Location: index.php");
exit;
?>