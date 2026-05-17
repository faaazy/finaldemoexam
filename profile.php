<?php
require_once("init.php");

$id_user = $_SESSION["id_user"];

$apps = $conn->query("SELECT * FROM app WHERE id_user='$id_user'");
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

    <h1>Личный кабинет</h1>

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

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Место</th>
                    <th>Дата начала</th>
                    <th>Способ оплаты</th>
                    <th>Статус</th>
                    <th>Отзыв</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $apps->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row["place"] ?></td>
                        <td><?= $row["date_start"] ?></td>
                        <td><?= $row["payment_method"] ?></td>
                        <td><?= $row["status"] ?></td>
                        <td>
                            <button <?= $row["status"] === "Новая" ? "disabled" : "" ?> class='btn-rate'>Оценить</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

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
            track.style.transform = `translateX(-${current * 100}%)`

            clearInterval(timer);
            timer = setInterval(() => move(1), 4000);
        }
    </script>
</body>
</html>