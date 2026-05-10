<?php

$id = $_GET['id'] ?? null;

if (!$id) {
    header(header: "location: index.php?site=show-stations");
}

$stmt_genres = $pdo->query("SELECT * FROM genres");
$genres = $stmt_genres->fetchAll(PDO::FETCH_ASSOC);


$stmt = $pdo->prepare("SELECT * FROM stations WHERE id=:id");
$stmt->execute(['id' => $id]);
$station = $stmt->fetch();
 
//wenn kein datenstaz ,zurück zur übersicht
if (!$station) {
    header("location: index.php?site=show-stations");
    exit;
}

require_once INCLUDES_PATH . "/partials/header.php"

?>
<main class="flex-grow-1">

    <div class="container py-4">

        <h1>Station bearbeiten</h1>

 <form method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="<?= e(data: $station['name']) ?>" class="form-control">
                </div>

                <!-- genre dropdown -->
                <div class="mb-3">
                    <label class="form-label">Genre</label>
                     <select class="form-select" name="genre_id">
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= e($genre['id']) ?>" <?= $genre['id'] == $station['genre_id'] ? 'selected' : '' ?>>
                            <?= e($genre['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                </div>

                <!-- stream url -->
                <div class="mb-3">
                    <label class="form-label">Stream Url</label>
                    <input type="url" name="stream_url" value=<?= e(data: $station ['stream_url']) ?> class="form-control" required>
                </div>

                <!-- web url -->
                <div class="mb-3">
                    <label class="form-label">Web Url</label>
                    <input type="url" name="web_url" value=<?= e(data: $station ['web_url']) ?> class="form-control" required>
                </div>

                <!-- Logo -->
                 <div class="mb-3">
                    <label class="form-label">Aktuelles logo</label>
                    <img height="100" src="<?= e('uploads/' . $station['logo'])  ?>" alt="">
                 </div>
 
                <div class="mb-3">
                    <label class="form-label">Neues Logo</label><br>
                    <img class="img-thumbnail" style="max-width: 120px;" src="<?= e('uploads/' . $station['logo'])  ?>" alt="">
                </div>
 


                <button type="submit" class="btn btn-secondary">
                    speichern
                </button>




            </form>
    </div>        

 </main>           