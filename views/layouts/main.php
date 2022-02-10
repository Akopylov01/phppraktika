<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Pop it MVC</title>
</head>
<body>
<header class="header">
    <a class="logo" href="<?= app()->route->getUrl('/') ?>">Библиотека</a>
    <nav>
        <form class="search_form" action="<?= app()->route->getUrl('/searchBook') ?>" method="get">
            <input class="search_input" type="search" name="search" placeholder="Введите название или жанр книги">
            <input class="search_button" name="search_button" type="submit" value="Найти">
        </form>
        <a href="<?= app()->route->getUrl('/') ?>">Главная</a>
        <a href="<?= app()->route->getUrl('/books') ?>">Книги</a>
        <?php
        if (app()->auth::check() && app()->auth::isStuff()):
        ?>
        <a href="<?= app()->route->getUrl('/userList')?>">Список пользователей</a>
        <div class="dropdown">
            <button class="dropbtn">Библиотекарь</button>
            <div class="dropdown-content">
                <a href="<?= app()->route->getUrl('/addAuthor')?>">Добавить автора</a>
                <a href="<?= app()->route->getUrl('/addBook')?>">Добавить книгу</a>
                <a href="<?= app()->route->getUrl('/signup') ?>">Добавить пользователя</a>
            </div>
        </div>
        <?php
        endif;
        ?>
        <?php
        if (app()->auth::check() && app()->auth::isAdmin()):
            ?>
            <div class="dropdown">
                <button class="dropbtn">Админ</button>
                <div class="dropdown-content">
                    <a href="<?= app()->route->getUrl('/userList')?>">Список пользователей</a>
                    <a href="<?= app()->route->getUrl('/signup') ?>">Добавить пользователя</a>
                </div>
            </div>
        <?php
        endif;
        ?>
        <?php
        if (!app()->auth::check()):
            ?>
            <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
        <?php
        else:
            ?>
            <a href="<?= app()->route->getUrl('/profile')?>">Профиль</a>
            <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->login ?>)</a>
        <?php
        endif;
        ?>

    </nav>

</header>
<main>
    <?= $content ?? '' ?>
</main>
<footer class="footer">
    <div class="left_footer">
        <p>Следите за новостями</p>
        <!--        <img src="../../public/img/facebook.png" alt="" width="30px">-->
        <!--        <img src="../../public/img/vk.png.png" alt="" width="30px">-->
        <!--        <img src="../../public/img/instagram.png" alt="" width="30px">-->
    </div>
    <div class="right_footer">
        <a href="">example@mail.ru</a>  <a href="">8-913-412-32-12</a>
    </div>
</footer>
</body>
</html>
