<?php
require_once("init.php");
requireAuth();

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $place = $_POST["place"];
    $date_start = $_POST["date_start"];
    $payment_method = $_POST["payment_method"];
    $id_user = $_SESSION["id_user"];

    $sql = "INSERT INTO app(id_user, place, date_start, payment_method)
    VALUES ('$id_user', '$place', '$date_start', '$payment_method')";

    if($conn->query($sql)) {
        $_SESSION["msg"] = "Вы успешно отправили заявку";

        header("Location: index.php");
        exit;
    } else {
        $_SESSION["msg"] = "Ошибка заявки";

        header("Location: index.php");
        exit;
    }
}