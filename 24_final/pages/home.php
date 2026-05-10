<?php
require_once INCLUDES_PATH . "/components/bs_components.php";

$stmt_genres = $pdo->query("SELECT * FROM genres");
$genres = $stmt_genres->fetchAll(PDO::FETCH_ASSOC);

$data = [];
foreach ($genres as $index => $genre) {
    $data[] = [
        'title' => $genre['name'],
        'body' => 'Listen to ' . $genre['name'] . ' music',
        'show' => $index === 0,
    ];
}
?>

<?php require_once INCLUDES_PATH . "/partials/header.php" ?>



<main class="flex-grow-1">

    <div class="container py-4">

        <h1>Home</h1>

        <img height="100" src="<?php echo IMG_URL ?>/1.jpg" alt="">
        <?= accordion($data) ?>
    </div>

</main>







<?php require_once INCLUDES_PATH . "/partials/footer.php" ?>