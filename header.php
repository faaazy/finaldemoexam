<header>
    <div class="logo"><a href="index.php">Банкетам.Нет</a></div>
    <?php if(isset($_SESSION["isLogged"])): ?>
    <ul class="header-row">
        <?php if(isset($_SESSION["isAdmin"])): ?>
            <a href="admin.php">Админ-панель</a>
        <?php else: ?>
            <a href="app_form.php">Создать заявку</a>
            <a href="profile.php">Личный кабинет</a>
        <?php endif; ?>
            <a href="exit.php">Выход</a>
    </ul>
    <?php endif; ?>
</header>