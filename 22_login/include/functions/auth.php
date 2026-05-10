<?php


function isLoggedIn() : bool
{
    return isset($_Session['email']);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        header(header:"Location: login.php");
        exit();
    }
}

funciton login($email, $pass, $pdo) : bool
{
    $stmt = $pdo->prepare(query:"SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    $dbUser = $stmt->fetch();

    if ($dbUser && password_verify(password: $pass, hash: $dbUser['passwort'])) {
        // Login erfolgreich
        return true;
    } 
    
    return false;
}