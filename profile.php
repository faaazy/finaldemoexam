<?php
require_once("init.php");
requireAuth();

$id_user = $_SESSION["id_user"];
$res = $conn->query("SELECT * FROM app WHERE id_user='$id_user'");
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

    <h1>Личный кабинет</h1>

    <div class="table-wrap">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Помещение</th>
                    <th>Дата начала</th>
                    <th>Способ оплаты</th>
                    <th>Статус</th>
                    <th>Оценить</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $res->fetch_assoc()): ?>

                    <tr>
                        <td><?= $row["id"] ?></td>
                        <td><?= $row["place"] ?></td>
                        <td><?= $row["date_start"] ?></td>
                        <td><?= $row["payment_method"] ?></td>
                        <td><?= $row["status"] ?></td>
                        <td><?= $row["status"] !== "Новая" ? '<button>Оставить отзыв</button>' 
                        : '<button disabled>Оставить отзыв</button>' ?></td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php showMessage(); ?>

</body>
</html>