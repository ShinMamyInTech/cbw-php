<?php
require_once __DIR__ ."/config/config.php";
require_once __DIR__ ."/db/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = password_hash(password: $_POST['pass'], algo: PASSWORD_DEFAULT);


    try{

        $stmt = $pdo->prepare(query:"INSERT INTO users (email, pass) VALUES (?, ?)");
        $stmt->execute([ $email, $pass]);
    } catch (PDOException) {
        $message['success']

    }

  

}


?>


<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>  
    <h1>Register</h1>
    <?php include __DIR__ . '/include/patials/index.php'; ?>

    <form action  "" method="post">
        <?php if ($message): ?>
            <?php if ($message['error'] === 'success'): ?>
                <p style="color: red;"><?php echo $message['Regestierung nicht erfolgt!']; ?></p>




        <input type="email" name="email"><br>
        <input type="password" name="pass"><br>

        <button type="submit">Register</button>
    </form>    

</body>

</html>

