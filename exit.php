<?php
require_once("init.php");
session_destroy();
redirectMsg("Вы успешно вышли", "index.php");
?>
