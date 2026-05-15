<?php

$conn = new mysqli("localhost", "root", "", "finaldemo");

if(!$conn) {
    echo "Ошибка подключения:" . $conn->connect_error;
}