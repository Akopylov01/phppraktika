
<h3><?= $message ?? ''; ?></h3>

<h3><?= app()->auth->user()->name ?? ''; ?></h3>
<?php
if (!app()->auth::check()):
    ?>
    <form class="auth" method="post">
        <div class="auth_fields">
            <h2>Авторизация</h2>
            <input type="text" name="login" placeholder="Логин">
            <input type="password" name="password" placeholder="Пароль">
            <input class ="button" type="submit" value="Войти">
        </div>
    </form>
<?php endif;