<h3><?= $message ?? ''; ?></h3>
<form class="auth" method="post">
    <div class="auth_fields">
        <h2>Добавить книгу</h2>
        <select name="author">
            <?php
            foreach ($authors as $author) {
                echo '<option>' . $author->id . $author->FIO . '</option>';
            }
            ?>
        </select>
        <input type="file" name="image" placeholder="Изображение">
        <input type="text" name="title" placeholder="Название">
        <input type="text" name="genre" placeholder="Жанр">
        <input type="text" name="category" placeholder="Категория">
        <input type="date" name="year" placeholder="Год">
        <select name="isNew">
            <option value="Новая">1</option>
            <option value="Неновая">0</option>
        </select>
        <input type="text" name="cost" placeholder="Цена">
        <input type="text" name="annotation" placeholder="Аннотация">
        <input class="button" type="submit" value="Добавить">
    </div>
</form>