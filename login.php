<?php 
require_once("init.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];
    
    if($login === "Admin26" && $password === "Demo20") {
        $_SESSION["isAdmin"] = true;
        $_SESSION["isLogged"] = true;

        redirectMsg("Вы успешно вошли в систему", "admin.php");
    }

    $check = $conn->query("SELECT * FROM users WHERE login='$login' AND password='$password'");

    if($check->num_rows > 0) {
        $user = $check->fetch_assoc();
        $_SESSION["id_user"] = $user["id"];

        $_SESSION["isLogged"] = true;

        redirectMsg("Вы успешно авторизовались!", "index.php");
    } else {
        redirectMsg("Неверный логин или пароль!", "index.php");
    }
}