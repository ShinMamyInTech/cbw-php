<?php
requireAdmin();

$message = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';




    if (!empty($name)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO genres (name) VALUES (:name)");
            $stmt->execute(['name' => $name]);
            $message['success'] = "Genre Angelegt!";
        } catch (PDOException $e) {
            $message['error'] = "Etwas ist schief gelaufen!";
        }
    }
}

$stmt_genres = $pdo->query("SELECT * FROM genres");
$genres = $stmt_genres->fetchAll(PDO::FETCH_ASSOC);


require_once INCLUDES_PATH . "/partials/header.php"
?>




<main class="flex-grow-1">

    <div class="container py-4">

        <h1 class="h3 mb-3">Genre hinzufügen</h1>
        <?php if ($message): ?>
            <?php if (isset($message['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($message['error']); ?>
                </div>
            <?php endif; ?>
            <?php if (isset($message['success'])): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo htmlspecialchars($message['success']); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <form method="post" class="mb-4">

            <div class="mb-3">
                <label class="form-label">Genre</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-secondary">
                Speichern
            </button>

        </form>

        <h2>vorhandenen Genres</h2>
        <ul class="list-group">

            <?php foreach ($genres as $genre): ?>


                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?= htmlspecialchars($genre['name'])  ?></span>

                    <div>
                        <a class="btn btn-sm btn-secondary" href="index.php?site=edit-genre&id=<?= $genre['id'] ?>">Bearbeiten</a>

                        <a class="btn btn-sm btn-danger" href="index.php?site=delete-genre&id=<?= $genre['id'] ?>">Löschen</a>
                    </div>

                </li>


            <?php endforeach; ?>

        </ul>

    </div>

</main>







<?php require_once INCLUDES_PATH . "/partials/footer.php" ?>