<?php
require_once("init.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Банкетам.Нет</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("header.php"); ?>

    <?php if(isset($_SESSION["isLogged"])): ?>
    <div class="slider">
        <div class="slider-track" id="track">
            <img src="./course-5.jpg" alt="">
            <img src="./course-5.jpg" alt="">
            <img src="./course-5.jpg" alt="">
            <img src="./course-5.jpg" alt="">
        </div>
        <button class="slider-btn prev"><</button>
        <button class="slider-btn next">></button>
    </div>

    <p class="welcome">Добро пожаловать в Банкетам.Нет - Организуем мероприятия любой сложности!</p>

    <div class="advantages">
        <div class="adv-item">
            <span class="adv-num">10+</span>
            <span class="adv-texs">Лет опыта</span>
        </div>
        <div class="adv-item">
            <span class="adv-num">500+</span>
            <span class="adv-texs">Мероприятий</span>
        </div>
        <div class="adv-item">
            <span class="adv-num">100%</span>
            <span class="adv-texs">Довольный</span>
        </div>
        <div class="adv-item">
            <span class="adv-num">24/7</span>
            <span class="adv-texs">Поддержка</span>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!isset($_SESSION["isLogged"])): ?>

        <form action="register.php" method="post">
            <h1>Регистрация</h1>

            <label for="login">Логин</label>
            <input type="text" name="login" required minlength="6" placeholder="login123">

            <label for="password">Пароль</label>
            <input type="password" name="password" required minlength="8" placeholder="********">

            <label for="fio">ФИО</label>
            <input type="text" name="fio" required placeholder="Иванов Иван Иванович">

            <label for="phone">Телефон</label>
            <input type="tel" name="phone" required placeholder="89001234567" maxlength="11">

            <label for="email">Email</label>
            <input type="email" name="email" required placeholder="example@email.com">

            <button>Регистрация</button>
            <p>Уже зарегистрированы? <a href="login_form.php">Авторизация</a></p>
        </form>

    <?php endif; ?>

    <?php showMessage(); ?>

    <script>
        const total = 4;
        let current = 0;
        let timer = setInterval(() => move(1), 3000);

        function move(step) {
            const track = document.getElementById("track");
            if(!track) return;

            current = (total + current + step) % total;
            track.style.transform = `translateX(-${current * 100}%)`;
            
            clearInterval(timer);
            timer = setInterval(() => move(1), 3000);
        }
    </script>
</body>
</html>