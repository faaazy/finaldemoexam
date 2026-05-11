<?php
session_start();
require_once("connect.php");

function showMessage() {
    if(isset($_SESSION["msg"])) {
        echo "<p class='message'>{$_SESSION['msg']}</p>";
        unset($_SESSION["msg"]);
    }
}

function requireAuth() {
    if(!isset($_SESSION["isLogged"])) {
        header("Location: index.php");
        exit;
    }
}

function requireAdmin() {
    if(!isset($_SESSION["isAdmin"])) {
        header("Location: index.php");
        exit;
    }
}

