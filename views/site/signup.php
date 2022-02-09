<h3 class="message"><?php
    if($message) {
        echo $message;
    }
    ?>
</h3>
<form class="auth" method="post">
    <div class="auth_fields">
        <h2>Добавление нового пользователя</h2>
        <input type="text" name="FIO" placeholder="ФИО">
        <input type="text" name="address" placeholder="Адрес">
        <input type="text" name="phone" placeholder="Телефон">
        <select class="select_form" name="role">
            <?php
            foreach ($roles as $role) {
                if($flag) {
                    echo '<option>' . $role->id .' '. $role->role . '</option>';
                }
                else if ($role->id!=1 && $role->id!=2){
                    echo '<option>' . $role->id .' '.$role->role . '</option>';
                }
            }
            ?>
        </select>
        <input class="button" type="submit" value="Зарегистрироваться">
    </div>
</form>

