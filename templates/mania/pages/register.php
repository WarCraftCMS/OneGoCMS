<?php
$global->check_logged_in();
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
            <input type="hidden" name="_csrf-frontend" value="ppLWq12VfZ5lC6TV7DeScKDOaO6JenF1VBGU9LzM9TPX85voM_IxzCFykIW7X-cz-potv8JKMzNiW9-l5pO5Vw==">
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
            <!--
            <div class="line">
                <div class="icon flex-cc"><i class="fa fa-users" aria-hidden="true"></i></div>
                <div class="form-group field-signupform-recruiter">
                    <input type="text" id="signupform-recruiter" class="form-control" name="SignupForm[recruiter]" placeholder="Код приглашения">
                    <p class="help-block help-block-error"></p>
                </div>
            </div>
            -->
            <div class="line flex-cc capcha">
                <div class="form-group field-signupform-recaptcha">
                    <input type="hidden" id="signupform-recaptcha" class="form-control" name="SignupForm[reCaptcha]">
                    <div id="signupform-recaptcha-recaptcha-login-signup" class="g-recaptcha" data-sitekey="6LfAX-IUAAAAACd7FqWAktcLgHM5nAQd78em9OCf" data-theme="dark" data-input-id="signupform-recaptcha" data-form-id="login-signup"></div>
                    <p class="help-block help-block-error"></p>
                </div>
            </div>
            <button type="submit" class="blue-button flex-cc" name="submit">СОЗДАТЬ АККАУНТ</button>
            <script type="text/javascript">document.getElementById('signupform-username').value = "";</script>
            <script type="text/javascript">document.getElementById('signupform-password').value = "";</script>
            <script type="text/javascript">document.getElementById('signupform-password_repeat').value = "";</script>
            <script type="text/javascript">document.getElementById('signupform-email').value = "";</script>
        </form>
    </div>