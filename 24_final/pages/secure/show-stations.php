<?php

$user_id = $_SESSION['user_id'];



if (isAdmin()) {
    $sql = "SELECT s.id, s.logo, s.name, s.stream_url, s.web_url, s.api_key, g.name AS genre_name
        FROM stations s
        JOIN genres g ON s.genre_id = g.id
        ORDER BY g.name, s.name;";
 
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
} else {
    $sql = "SELECT s.id, s.logo, s.name, s.stream_url, s.web_url, s.api_key, g.name AS genre_name
        FROM stations s
        JOIN genres g ON s.genre_id = g.id
        WHERE s.user_id = :user_id
        ORDER BY g.name, s.name;";
 
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id
    ]);
}
 

$stations = $stmt->fetchAll();


require_once INCLUDES_PATH . "/partials/header.php"

?>


<main class="flex-grow-1">

    <div class="container py-4">

        <h1>Stationen</h1>

        <table class="table table-dark table-striped align-middle">
            <tr>
                <th>ID</th>
                <th>Logo</th>
                <th>Name</th>
                <th>Genre</th>
                <th>StreamUrl</th>
                <th>Weburl</th>
                <th>Aktionen</th>
            </tr>

            <?php foreach ($stations as $station): ?>

                <tr>
                    <td>
                        <?= e($station['id']) ?>
                    </td>
                    <td>
                        <img height="50" src="<?= 'uploads/' . e($station['logo'])  ?>" alt="<?= e($station['name']) ?>">
                    </td>
                    <td>
                        <?= e($station['name']) ?>
                    </td>
                    <td>
                        <?= e($station['genre_name']) ?>
                    </td>

                    <td>
                        <audio controls>
                            <source src="<?= e($station['stream_url']) ?>" type="audio/mpeg">
                        </audio>

                    </td>

                    <td>
                        <?= e(data: $station['web_url']) ?>
                    </td>

                    <td>
                        

                        <a class="btn btn-sm btn-danger" href="index.php?site=delete-station&id=<?=$station['id'] ?>">Löschen</a>
                        <a class="btn btn-sm btn-light" href="index.php?site=edit-station&id=<?= $station['id'] ?>">Bearbeiten</a>
                    </td>

                    <td>
<textarea><?= '<iframe src="' . BASE_URL . '/player/player.php?api_key=' . e($station['api_key'] ?? '') . '" width="500" height="500"></iframe>' ?></textarea>                    </td>
                    


                </tr>

            <?php endforeach; ?>

        </table>



    </div>

</main>







<?php require_once INCLUDES_PATH . "/partials/footer.php" ?>