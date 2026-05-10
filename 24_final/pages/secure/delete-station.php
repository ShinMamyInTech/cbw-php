<?php
 
$id = $_GET['id'] ?? null;
 
//wenn keine ID übergeben wurde, zurück zur Übersicht
if (!$id) {
    header("Location: index.php?site=show-stations");
    exit;
}
 
$stmt = $pdo->prepare("SELECT * FROM stations WHERE id = :id");
$stmt->execute(['id' => $id]);
$station = $stmt->fetch();
 
if (!$station) {
    header("Location: index.php?site=show-stations");
    exit;
}
 
//Altes Logo löschen, damit es nicht auf dem Server bleibt, wenn die Station gelöscht wird
deleteOldLogo($station['logo']);
 
 
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM stations WHERE id = :id");
    $stmt->execute(['id' => $id]);
}
 
 
header("Location: index.php?site=show-stations");
exit;
 
 