<?php
$stmt_genres = $pdo->query("SELECT * FROM genres");
$genres = $stmt_genres->fetchAll(PDO::FETCH_ASSOC);

require_once INCLUDES_PATH . "/partials/header.php";

//debugger ($_POST);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST['name'] ?? '';
    $genre_id = $_POST['genre_id'] ?? '';
    $stream_url = $_POST['stream_url'] ?? '';
    $web_url = $_POST['web_url'] ?? '';
    $user_id = $_SESSION['user_id'] ?? null;


    if (!empty($name) && !empty($genre_id) && !empty($stream_url) && !empty($web_url) && !empty($user_id)) {

        $logoData =  uploadImage('image');

        if (empty($logoData['error'])) {
            try {
                $api_key = bin2hex(random_bytes(32));
                $stmt = $pdo->prepare("INSERT INTO stations (name,genre_id,stream_url,web_url,logo,user_id,api_key)
                 VALUES (:name,:genre_id,:stream_url,:web_url,:logo,:user_id,:api_key)");
                $stmt->execute([
                    'name' => $name,
                    'genre_id' => $genre_id,
                    'stream_url' => $stream_url,
                    'web_url' => $web_url,
                    'logo' => $logoData['logo'],
                    'user_id' => $user_id,
                    'api_key' => $api_key
                ]);

                header("location: index.php?site=show-stations");
            } catch (PDOException $e) {
                $message['error'] = "Etwas ist schief gelaufen!";
            }
        }
    }
}






?>


<main class="flex-grow-1">

    <div class="container py-4">

        <h1 class=" mb-3">Station hinzufügen</h1>


        <?php if (empty($genres)): ?>
            <div class="alert alert-warning" role="alert">
                Kein genre verfügbar. Bitte fügen Sie zuerst ein
                <a class="alert-link" href="index.php?site=create-genre">Gerne</a> hinzu!
            </div>
        <?php else: ?>

            <?= $message['error'] ?? '' ?>

            <form method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <!-- genre dropdown -->
                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <select class="form-select" name="genre_id">
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?= htmlspecialchars($genre['id']) ?>">
                                <?= htmlspecialchars($genre['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- stream url -->
                <div class="mb-3">
                    <label class="form-label">Stream Url</label>
                    <input type="url" name="stream_url" value="http://xxxxx.de" class="form-control" required>
                </div>

                <!-- web url -->
                <div class="mb-3">
                    <label class="form-label">Web Url</label>
                    <input type="url" name="web_url" value="http://xxxxx.de" class="form-control" required>
                </div>

                <!-- Logo -->
                <div class="mb-3">
                    <label class="form-label">logo</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button type="submit" class="btn btn-secondary">
                    speichern
                </button>




            </form>

        <?php endif; ?>

    </div>

</main>



<?php require_once INCLUDES_PATH . "/partials/footer.php" ?>