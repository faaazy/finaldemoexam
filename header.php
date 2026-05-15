<header>
    <nav>
        <div class="logo"><a href="index.php">Банкетам.Нет</a></div>
        <?php if(isset($_SESSION["isLogged"])): ?>
        <ul class="header__row">
            <?php if(isset($_SESSION["isAdmin"])): ?>
                <li><a href="admin.php">Админ-панель</a></li>
            <?php else: ?>
                <li><a href="profile.php">Личный кабинет</a></li>
                <li><a href="app_form.php">Оформить заявку</a></li>
            <?php endif; ?>
                <li><a href="exit.php" class="btn-exit">Выход</a></li>
        </ul>
        <?php endif; ?>
    </nav>
</header>