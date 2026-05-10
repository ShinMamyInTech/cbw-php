<?php

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM genres WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

header("Location: index.php?site=create-genre");
exit;
