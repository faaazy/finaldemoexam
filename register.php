<?php
require_once("init.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];
    $fio = $_POST["fio"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    $check = $conn->query("SELECT * FROM users WHERE login='$login'");
    if($check->num_rows > 0) {  
        redirectMsg("Данный логин уже занят", "index.php");
    }

    $sql = "INSERT INTO users (login, password, fio, phone, email) 
    VALUES ('$login', '$password', '$fio', '$phone', '$email')";

    if($conn->query($sql)) {
        $_SESSION["isLogged"] = true;
        $_SESSION["id_user"] = $conn->insert_id;
        
        redirectMsg("Вы успешно зарегистрировались", "index.php");
    } else {
        redirectMsg("Ошибка регистрации" . $conn->error, "index.php");
    }
}