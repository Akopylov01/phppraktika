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
    echo '<h1>Ваши забронированные книги</h1>';
    foreach ($issuedBook as $ib){
        echo '<div class="userBookList">';
        echo '<p>Номер книги: ' . $ib->book_id .'</p>';
        echo '<p>Дата брони: ' . $ib->date_issue .'</p>';
        echo '</div>';
    }
    ?>
</div>
