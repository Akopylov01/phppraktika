<div class="search_user_container">
    <h1>Список пользователей</h1>
    <form class="search_user_form" action="<?= app()->route->getUrl('/searchUser') ?>" method="get">
        <input class="search_input" type="search" name="search" placeholder="Введите номер читательского билета">
        <input class="search_button" name="search_button" type="submit" value="Найти">
    </form>
</div>

<div class="books_list_container">

    <?php
    foreach ($profiles as $p){
        echo '<div class="books_list">';
        echo '<div class="book_description">';
        echo '<p>Читательский номер: ' . $p->login .'</p>';
        echo '<p>ФИО: ' .$p->FIO . '</p>';
        echo '<p>Адрес: ' . $p->address . '</p>';
        echo '<a href=' . app()->route->getUrl('/library_card?login=' . $p->login) . '>Подробнее</a>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>