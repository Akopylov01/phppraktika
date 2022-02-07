<h3><?= $message ?? ''; ?></h3>
<form class="auth" method="post">
    <div class="auth_fields">
        <h2>Добавить книгу</h2>
        <select name="author" class="select_form">
            <?php
            foreach ($authors as $author) {
                echo '<option>' . $author->id . $author->FIO . '</option>';
            }
            ?>
        </select>
        <input type="file" name="image" id="input__file"  class="input input__file" placeholder="Изображение">
        <label class="input_new_file" for="input__file">Выберите файл</label>
        <input type="text" name="title" placeholder="Название">
        <input type="text" name="genre" placeholder="Жанр">
        <input type="text" name="category" placeholder="Категория">
        <input type="date" name="year" placeholder="Год">
        <div class="field_new_book">
            <label>Новая?</label><select class="select_form_book" name="isNew">
                <option value="Новая">True</option>
                <option value="Неновая">False</option>
            </select>
        </div>
        <input type="text" name="cost" placeholder="Цена">
        <input type="text" name="annotation" placeholder="Аннотация">
        <input class="button" type="submit" value="Добавить">
    </div>
</form>