<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pop it MVC</title>
</head>
<body>
<style>
    html, body {
        margin: 0;
        padding: 0;
    }
    *, *:before, *:after {
        box-sizing: border-box;
    }
    .header{
        display: flex;
        width: 100%;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        box-shadow: 0px 0px 5px 0px #000000;
    }
    .header a{
        text-decoration: none;
        color: black;
    }
    .header a:hover{
        color: #737373;
    }
    .logo{
        font-size: 36px;
    }
    nav a{
        font-size: 18px;
        padding-right: 5px;
    }
    .auth{
        display: flex;
        justify-content: center;
    }
    .auth_fields{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .auth_fields input{
        margin-bottom: 20px;
        height: 30px;
        text-align: center;
        border:0;
        box-shadow:0 0 5px 0px #000000;
        width: 175px;
    }
    .button{
        width: 175px;
        background-color: #000;
        color: white;
    }
    .button:hover{
        cursor: pointer;
    }
    .search_button{
        background-color: #000;
        color: white;
        margin-right: 30px;
    }
    .footer{
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #E5E5E5;
        /*position: absolute;*/
        /*bottom: 0;*/
        width: 100%;
        /*left: 0;*/
        padding: 0px 30px 0px 30px;
    }
    .right_footer a{
        padding-right: 15px;
        text-decoration: none;
        color: black;
    }
    .right_footer a:hover{
        color: #737373;
    }
    .select_form{
        margin-bottom: 20px;
        height: 30px;
        text-align: center;
        width: 175px;
        border:0;
        box-shadow:0 0 5px 0px #000000;
    }
    .input__file {
        opacity: 0;
        visibility: hidden;
        position: absolute;
    }
    .input_new_file{
        margin-bottom: 20px;
        height: 30px;
        text-align: center;
        border:0;
        box-shadow:0 0 5px 0px #000000;
        width: 175px;
        cursor: pointer;

    }
    .field_new_book{
        margin-bottom: 20px;
        height: 30px;
        text-align: center;
        border:0;
        box-shadow:0 0 5px 0px #000000;
        width: 175px;
    }
    .select_form_book{
        height: 30px;
        text-align: center;
        width: 88px;
        border:0;
        color: #737373;
        cursor: pointer;
    }
    .field_new_book{
        display: flex;
        justify-content: space-around;
        align-items: center;
        color: #737373;
    }
    .authors_list{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .books_list img{
        border: 1px solid black;
        width: 225px;
        margin-right: 10px;
        height: 225px;
    }
    .books_list{
        display: flex;
        margin-left: 50px;
        align-items: center;
        height: 225px;
        margin-bottom: 50px;
    }
    .book_description{
        height: 225px;
    }

    </style>
<header class="header">

    <a class="logo" href="<?= app()->route->getUrl('/hello') ?>">Библиотека</a>
    <nav>
        <input class="search_input" type="search" name="search" placeholder="Поиск по сайту">
        <input class="search_button" type="submit" value="Найти">
        <a href="<?= app()->route->getUrl('/hello') ?>">Главная</a>
        <a href="<?= app()->route->getUrl('/books') ?>">Книги</a>
        <?php
        if (app()->auth::check() && app()->auth::isStuff()):
        ?>
            <a href="<?= app()->route->getUrl('/addAuthor')?>">Добавить автора</a>
            <a href="<?= app()->route->getUrl('/addBook')?>">Добавить книгу</a>
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
            <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->login ?>)</a>
        <?php
        endif;
        ?>
        <?php
        if (app()->auth::check() && app()->auth::isAdmin()):
            ?>
            <a href="<?= app()->route->getUrl('/signup') ?>">Добавить пользователя</a>
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
