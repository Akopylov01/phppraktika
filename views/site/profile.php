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
        foreach ($books as $book){
            if($ib->book_id == $book->id) {
                echo '<p>Название книги: ' . $book->title . '</p>';
            }
        }

        echo '<p>Дата брони: ' . $ib->date_issue .'</p>';
        if ($ib->date_return!="0000-00-00"){
            echo '<p>Дата возврата: ' . $ib->date_return .'</p>';
        }

        echo '</div>';


    }
    ?>
</div>
