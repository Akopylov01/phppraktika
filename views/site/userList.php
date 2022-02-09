<h1>Список пользователей</h1>
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