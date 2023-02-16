<header class = "container-fluid">
    <div class = "container">
        <div class = "row">
            <div class = "col-4">
                <h1> <a href ="<?php echo BASE_URL ?>">Новости24</a></h1>
            </div>
            <nav class = "col-8">
                <ul>
                    <li> <a href = "<?php echo BASE_URL ?>"> Главная </a></li>
                    <li>
                        <?php if(isset($_SESSION['id'])): ?>
                            <a href = "#">
                                <i class = "fa fa-user"></i>
                                <?php echo $_SESSION['login']; ?>
                            </a>
                            <ul>
                                <?php if($_SESSION['admin']): ?>
                                    <li> <a href = ""> Админ панель </a></li>
                                <?php endif; ?>
                                <li> <a href = "<?php echo BASE_URL ."logout.php";?>"> Выход </a></li>
                            </ul>
                        <?php else: ?>
                            <a href = "<?php echo BASE_URL ."log.php"; ?>">
                                <i class = "fa fa-user"></i>
                                Вход
                            </a>
                            <ul>
                                <li> <a href = "<?php echo BASE_URL ."Registr.php"; ?>"> Регистрация </a></li>
                            </ul>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>