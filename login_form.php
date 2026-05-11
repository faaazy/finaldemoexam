<?php
require_once("init.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("header.php"); ?>

    <?php if(!isset($_SESSION["isLogged"])): ?>

        <form action="login.php" method="post">
            <h1>Авторизация</h1>

            <label for="login">Логин</label>
            <input type="text" name="login" required minlength="6" placeholder="login123">

            <label for="password">Пароль</label>
            <input type="password" name="password" required minlength="6" placeholder="********">

            <button>Войти</button>
            <p>Еще не зарегистрированы? <a href="index.php">Регистрация</a></p>
        </form>

    <?php endif; ?>

    <?php showMessage(); ?>

</body>
</html>