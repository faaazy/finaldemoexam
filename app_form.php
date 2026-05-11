<?php
require_once("init.php");
requireAuth();
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

    <form action="app_send.php" method="post">
        <h1>Оформление заявки</h1>

        <label for="place">Место проведения</label>
        <select name="place" id="place" required>
            <option>Зал</option>
            <option>Ресторан</option>
            <option>Летняя веранда</option>
            <option>Закрытая веранда</option>
        </select>

        <label for="date">Дата начала</label>
        <input type="date" name="date_start" id="date" required>

        <label for="payment_method">Способ оплаты</label>
        <select name="payment_method" id="payment_method" required>
            <option>Карта</option>
            <option>Наличные</option>
            <option>Перевод</option>
        </select>

        <button type="submit">Оформить</button>        
    </form>

    <?php showMessage(); ?>
</body>
</html>