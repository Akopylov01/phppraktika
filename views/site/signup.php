<h3><?= $message ?? ''; ?></h3>
<form class="auth" method="post">
    <div class="auth_fields">
        <h2>Добавление нового пользователя</h2>
        <input type="text" name="login" placeholder="login">
        <input type="text" name="address" placeholder="Адрес">
        <select name="role">
            <?php
            foreach ($roles as $role) {
                echo '<option>' . $role->id . $role->role . '</option>';
            }
            ?>
        </select>
        <input class="button" type="submit" value="Зарегистрироваться">
    </div>
</form>

