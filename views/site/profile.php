<h1>Профиль пользователя</h1>
<div class="books_list_container">
    <?php
    foreach ($profile as $p){
        echo '<div class="books_list">';
        echo '<div class="book_description">';
        echo '<p>Ваш читательский номер: ' . $p->login .'</p>';
        echo '<p>ФИО: ' .$p->FIO . '</p>';
        echo '<p>Адрес: ' . $p->address . '</p>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>
