<?php

$message = [];

$id = $_GET['id'] ?? null;


$stmt = $pdo->prepare("SELECT * FROM genres WHERE id=:id");
$stmt->execute(['id' => $id]);
$genre = $stmt->fetch();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';

    if (!empty($name)) {
        $stmt = $pdo->prepare("UPDATE genres SET name = :name WHERE id = :id");
        $stmt->execute(['name' => $name, 'id' => $id]);
        header("Location: index.php?site=create-genre");
        exit;
    }
}


require_once INCLUDES_PATH . "/partials/header.php"
?>


<main class="flex-grow-1">

    <div class="container py-4">

        <h1 class="h3 mb-3">Genre hinzufügen</h1>

        <form method="post" class="mb-4">

            <div class="mb-3">
                <label class="form-label">Genre</label>
                <input type="text" name="name" value="<?= $genre['name'] ?>" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-secondary">
                Aktualisieren
            </button>

        </form>

    </div>

</main>







<?php require_once INCLUDES_PATH . "/partials/footer.php" ?>