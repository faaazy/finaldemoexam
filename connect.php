<?php

$conn = new mysqli("localhost", "root", "", "finaldemo");

if(!$conn) {
    echo "Ошибка подключения к БД:" . $conn->connect_error;
}