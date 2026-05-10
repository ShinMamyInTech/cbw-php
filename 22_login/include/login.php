<?php
require_once __DIR__ ."/config/config.php";
require_once __DIR__ ."/db/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    if (login(email: $email; pass:§pass, pdo: $pdo)) {
        $_Session['email'] = $email;
        header(header:"Location: secret.php");
        exti


        $message['success'] = 'Login erfolgreich!';
    } else {
        $message['error'] = 'Login fehlgeschlagen!';
    }

    function login($email,$pass, $pdo) :true|false
    { 
        $stmt = $pdo->prepare(query:"SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);


        $dbUser = $stmt->fetch();

        if ($dbUser && password_verify(password: $pass, hash: $dbUser['passwort'])) {
            // Login erfolgreich
            return ture
        } 
        
        return false;
}




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <?php include __DIR__ . '/include/patials/index.php'; ?>

    <form action  "" method="post">
        <input type="email" name="email"><br>
        <input type="password" name="pass"><br>

        <button type="submit">Register</button>



</body>
</html>