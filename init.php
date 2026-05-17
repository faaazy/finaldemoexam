<?php
$conn = new mysqli("localhost", "root", "", "finaldemo");

if(!$conn) {
    echo "Ошибка подключения:" . $conn->connect_error;
    exit;
}

session_start();

function showMessage() {
    if(isset($_SESSION["msg"])) {
        echo "<p class='message'>{$_SESSION['msg']}</p>";
        unset($_SESSION["msg"]);
    }
}

function redirectMsg($msg, $link) {
    $_SESSION["msg"] = $msg;
    
    header("Location: $link");
    exit;
}