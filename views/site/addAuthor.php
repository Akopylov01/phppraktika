<h3><?= $message ?? ''; ?></h3>
    <form class="auth" method="post">
        <div class="auth_fields">
            <h2>Добавить автора</h2>
            <input type="text" name="FIO" placeholder="ФИО">
            <input class="button" type="submit" value="Добавить">
        </div>
    </form>
<div class="authors_list">
    <h1>Уже имеющиеся авторы</h1>
    <ol>
        <?php
        foreach ($authors as $author) {
            echo '<li>' . $author->FIO . '</li>';
        }
        ?>
    </ol>
</div>