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
    <?php include("header.php") ?>

    <main>
    <?php if(isset($_SESSION["isLogged"])): ?>
        <h1>Банкетные залы</h1>

        <div class="slider">
            <div class="slider-track" id="track">
                <img src="./course-5.jpg" alt="">
                <img src="./course-5.jpg" alt="">
                <img src="./course-5.jpg" alt="">
                <img src="./course-5.jpg" alt="">
            </div>
            <button onclick="move(-1)" class="slider-btn prev"><</button>
            <button onclick="move(1)" class="slider-btn next">></button>
        </div>

        <p class="welcome-text">Добро пожаловть в Банкетам.Нет - Организация праздников любой сложности!</p>

        <div class="advantages">
            <div class="adv-item">
                <span class="adv-num">10+</span>
                <span class="adv-text">Лет опыта</span>
            </div>
            <div class="adv-item">
                <span class="adv-num">100%</span>
                <span class="adv-text">Довольных клиентов</span>
            </div>
            <div class="adv-item">
                <span class="adv-num">24/7</span>
                <span class="adv-text">Поддержка</span>
            </div>
            <div class="adv-item">
                <span class="adv-num">500+</span>
                <span class="adv-text">Мероприятий</span>
            </div>
        </div>
    <?php endif; ?>

    <?php if(!isset($_SESSION["isLogged"])): ?>
        <form action="register.php" method="post">
            <h1>Регистрация</h1>

            <label for="login">Логин</label>
            <input type="text" name="login" id="login" required minlength="6">

            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" required minlength="8">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="fio">ФИО</label>
            <input type="text" id="fio" name="fio" required>

            <label for="phone">Номер телефона</label>
            <input type="tel" id="phone" name="phone" minlength="11" maxlength="11" required>

            <button type="submit">Зарегистрироваться</button>
            <p>Уже зарегистрированы? <a href="login_form.php">Авторизация</a></p>
        </form>
    <?php endif; ?>
    </main>

    <?php showMessage(); ?>

    <script>
        const total = 4;
        let current = 0;
        let timer = setInterval(() => move(1), 4000);

        function move(step) {
            const track = document.getElementById("track");
            if(!track) return;

            current = (total + current + step) % total;
            track.style.transform = `translateX(-${current * 100}%)`;

            clearInterval(timer);
            timer = setInterval(() => move(1), 4000);
        }
    </script>
</body>
</html>