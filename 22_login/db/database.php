<?php
$pdo = new PDO(dsn:"mysql:host=localhost;dbname=php_cbw" , username:"root", password:"");
$pdo->setAttribute(attribute: PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);