<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/config/config.php";
require_once INCLUDES_PATH . '/functions/auth.php';
require_once DB_PATH . "/database.php";

require_once INCLUDES_PATH . "/functions/helper.php";

loadPage();

//debugger($_SESSION);
