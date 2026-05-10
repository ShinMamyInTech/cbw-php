<?php
require_once __DIR__ . "/config/config.php";
require_once INCLUDES_PATH . "/functions/helper.php";
//require_once DB_PATH . "/database.php";


switch ($_GET['site']??'home'){
    
    case 'home':
        $data = [
            'lang' => 'de',
            'title' => 'Home',


        ];
        require_once PAGES_PATH . "/home.php";
        break;
    case 'about':
        require_once PAGES_PATH . "/about.php";
        break;  
    case 'contact':
        require_once PAGES_PATH . "/contact.php"; 
} 
