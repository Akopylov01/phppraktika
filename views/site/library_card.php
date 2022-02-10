<h1>Читательский билет пользователя</h1>
<div class="books_list_container">
    <?php
    foreach ($library_cards as $p){
        echo '<div class="books_list">';
        echo '<div class="book_description">';
        echo '<p>Читательский номер: ' . $p->library_card_id .'</p>';
        echo '<p>Активна ли?: ' .$p->isActive . '</p>';
        echo '<p>Дата открытия: ' . $p->date_issued . '</p>';
        echo '</div>';
        echo '</div>';
    }
    echo '<h1>Книги взятые пользователем</h1>';
    foreach ($issuedBook as $ib){
        echo '<div class="userBookList">';
        echo '<p>Номер книги: ' . $ib->book_id .'</p>';
        echo '<p>Дата брони: ' . $ib->date_issue .'</p>';
        echo '</div>';
    }
    ?>
</div>