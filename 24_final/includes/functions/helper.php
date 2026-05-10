<?php
function includeScripts(array $scripts)
{
    if (!empty($scripts) && is_array($scripts)) {
        foreach ($scripts as $script) {
            echo "<script src='" . JS_URL . "/$script'></script>";
        }
    }
}



function deleteOldLogo(string $logoName)
{
    $filePath = UPLOADS_PATH . '/' . $logoName;
    if (file_exists($filePath)) {
        unlink($filePath);
    };
}
 

function loadPage()
{
    global $pdo;
    $site = $_GET['site'] ?? 'home';
    $filePath =  PAGES_PATH . "/$site.php";
    $securePath =  PAGES_PATH . "/secure/$site.php";

    if (file_exists($filePath)) {
        require_once $filePath;
    } elseif (file_exists($securePath)) {
        require_once $securePath;
    } else {
        require_once PAGES_PATH . "/404.php";
    }
}


function debugger(mixed $data, $pretty = true)
{
    if ($pretty) {
        echo '<pre>';
    }
    print_r($data ?? []);

    if ($pretty) {
        echo '</pre><hr>';
    } else {
        echo '<hr>';
    }
}


function cleanInput(string $data): string
{
    return trim($data ?? '');
}

function e(string $data): string
{
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
}


function uploadImage(string $inputName)
{

    if (!isset($_FILES[$inputName])) {
        return ['logo' => null, 'error' => 'keine datei hochgeladen'];
    }

    $file = $_FILES[$inputName];

    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    $maxSize = 5000000; //5000000 = 5mb
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    $errorMessage = '';

    $uniqFileName = null;

    if ($fileError === 0) {
        if ($fileSize < $maxSize) {

            if (checkMimeType($fileTmpName, $allowedTypes)) {
                $uniqFileName = uniqid('img_', true);
                move_uploaded_file($fileTmpName, UPLOADS_PATH . '/' .  $uniqFileName . '.jpg');
            } else {
                $errorMessage = 'Keine gültige Bilddatei!';
            }
        } else {
            $errorMessage = 'Datei ist zu groß!';
        }
    } else {
        $errorMessage = 'Fehler beim Hochladen der datei!';
    }

    return ['logo' => $uniqFileName . '.jpg', 'error' => $errorMessage];
}

function checkMimeType(string $fileTmpName, array $allowedTypes): bool
{
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $fileTmpName);
    $isAllowed = in_array($mimeType, $allowedTypes);
    return $isAllowed;
}
