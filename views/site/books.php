<h1>Список книг</h1>
<div class="books_list_container">
    <?php
    foreach ($books as $book){
            echo '<div class="books_list">';
            echo '<img src=upload/' . $book->image . '>';
            echo '<div class="book_description">';
            foreach ($author as $auth) {
                if($auth->id == $book->author) {
                    echo '<p>Автор: ' . $auth->FIO . '</p>';
                }
            }
            echo '<p>Название: ' . $book->title . '</p>';
            echo '<p>Жанр: ' . $book->genre . '</p>';
            echo '<p>Категория: ' . $book->category . '</p>';
            echo '<p>Год издания: ' . $book->year . '</p>';
            echo '<p>Аннотация: ' . $book->annotation . '</p>';
            if (app()->auth::check() && app()->auth::isStuff()) {
                echo '<a href=' . app()->route->getUrl('/delBook?id=' . $book->id) . '>Удалить книгу </a>';
            }
            if (app()->auth::check() && !(app()->auth::isStuff())) {
                echo '<a href=' . app()->route->getUrl('/getBook?id=' . $book->id) . '>Забронировать книгу </a>';
            }
            echo '</div>';
            echo '</div>';
        }

    ?>
</div>
