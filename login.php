<?php 
require_once("init.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $check = $conn->query("SELECT * FROM users WHERE login='$login' AND password='$password'");

    if($login === "Admin26" && $password === "Demo20") {
        $_SESSION["isAdmin"] = true;
        $_SESSION["isLogged"] = true;
        $_SESSION["msg"] = "Вы успешно авторизовались";

        header("Location: admin.php");
        exit; 
    }

    if($check->num_rows > 0) {
        $user = $check->fetch_assoc();

        $_SESSION["isLogged"] = true;
        $_SESSION["msg"] = "Вы успешно авторизовались";
        $_SESSION["id_user"] = $user["id"];

        header("Location: index.php");
        exit;
    } else {
        $_SESSION["msg"] = "Неверный логин или пароль";

        header("Location: index.php");
        exit;
    }

}