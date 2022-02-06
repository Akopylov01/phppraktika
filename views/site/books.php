<h1>Список книг</h1>
<ol>
    <?php
    foreach ($books as $book) {
        echo '<li>' . $book->author . '</li>';
        echo '<img src="$book->image"';
        echo '<li>' . $book->title . '</li>';
        echo '<li>' . $book->genre . '</li>';
        echo '<li>' . $book->category . '</li>';
        echo '<li>' . $book->year . '</li>';
        echo '<li>' . $book->isNew . '</li>';
        echo '<li>' . $book->cost . '</li>';
        echo '<li>' . $book->annotation . '</li>';
    }
    ?>
</ol>