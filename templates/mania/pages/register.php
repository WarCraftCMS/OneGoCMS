<?php
if (isset($_POST['submit'])) {
    $reg = new Registration($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_confirmation']);
    $reg->register_checks();
}

if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger text-center' role='alert'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
}
?>
 <div class="content inner-content">
        <div class="inner-title flex-cc">РЕГИСТРАЦИЯ</div>
            <form method="post" action="" class="inner-form">
            <input type="hidden" name="_csrf-frontend" value="">
            <div class="line">
                <div class="icon flex-cc"><i class="fa fa-user" aria-hidden="true"></i></div>
                <div class="form-group field-signupform-username required">
                    <input type="text" id="username" class="form-control" name="username" autofocus="" placeholder="Логин" required>
                    <p class="help-block help-block-error"></p>
                </div>
            </div>
            <div class="line">
                <div class="icon flex-cc"><i class="fa fa-lock" aria-hidden="true"></i></div>
                <div class="form-group field-signupform-password required">
                    <input type="password" id="password" class="form-control" name="password" placeholder="Пароль" required>
                    <p class="help-block help-block-error"></p>
                </div>
            </div>
            <div class="line">
                <div class="icon flex-cc"><i class="fa fa-lock" aria-hidden="true"></i></div>
                <div class="form-group field-signupform-password_repeat required">
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Повторите пароль" required>
                    <p class="help-block help-block-error"></p>
                </div>
            </div>
            <div class="line">
                <div class="icon flex-cc"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                <div class="form-group field-signupform-email required">
                    <input type="email" id="email" class="form-control" name="email" placeholder="Email" required>
                    <p class="help-block help-block-error"></p>
                </div>
            </div>
            <button type="submit" class="blue-button flex-cc" name="submit">СОЗДАТЬ АККАУНТ</button>
        </form>
    </div>