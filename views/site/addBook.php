<h3><?= $message ?? ''; ?></h3>
<form action="<?= app()->route->getUrl('/addBook') ?>" class="auth" method="post" enctype="multipart/form-data">
    <div class="auth_fields">
        <h2>Добавить книгу</h2>
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

        <select name="author" class="select_form">
            <?php
            foreach ($auth as $a) {
                echo '<option value="$a->id">' . $a->id . $a->FIO . '</option>';
            }
            ?>
        </select>
        <input type="file" name="image" id="input__file"  class="input input__file" placeholder="Изображение">
        <label class="input_new_file" for="input__file">Выберите файл</label>
        <input type="text" name="title" placeholder="Название">
        <input type="text" name="genre" placeholder="Жанр">
        <input type="text" name="category" placeholder="Категория">
        <input type="text" name="year" placeholder="Год">
        <div class="field_new_book">
            <label>Новая?</label><select class="select_form_book" name="new">
                <option value="Новая">ДА</option>
                <option value="Неновая">НЕТ</option>
            </select>
        </div>
        <input type="text" name="cost" placeholder="Цена">
        <input type="text" name="annotation" placeholder="Аннотация">
        <input class="button" type="submit" value="Добавить">
    </div>
</form>