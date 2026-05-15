<?php 
require_once("init.php");
requireLogin();
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

    <main>

    <form action="app_send.php" method="post">
        <h1>Заявка</h1>

        <label for="place">Помещение</label>
        <select name="place" id="place" required>
            <option>Зал</option>
            <option>Ресторан</option>
            <option>Летняя веранда</option>
            <option>Закрытая веранда</option>
        </select>
        
        <label for="date">Дата начала</label>
        <input type="date" name="date_start" id="date" required>
        
        <label for="payment">Способ оплаты</label>
        <select name="payment_method" id="payment" required>
            <option>Карта</option>
            <option>Наличные</option>
            <option>Перевод</option>
        </select>

        <button>Оформить заявку</button>
    </form>
    
    </main>

    <?php showMessage(); ?>
</body>
</html>