<?php
require_once("init.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_user = intval($_SESSION["id_user"]);
    $place = $_POST["place"];
    $date_start = $_POST["date_start"];
    $payment_method = $_POST["payment_method"];

    $sql = "INSERT INTO app (id_user, place, date_start, payment_method)
    VALUES ('$id_user', '$place', '$date_start', '$payment_method')";

    if($conn->query($sql)) {
        $_SESSION["msg"] = "Заявка успешно отправлена!";

        header("Location: index.php");
        exit;
    } else {    
        $_SESSION["msg"] = "Ваша заявка не отправлена";

        header("Location: app_form.php");
        exit;
    }


}