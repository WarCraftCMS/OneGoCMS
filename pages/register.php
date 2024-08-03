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

<!-- HEADER -->
    <header class="header header--start">
        <div class="content-area">
            <div class="auth">

                                <div class="auth__box">
                    <div class="auth__box-border">
                        <img class="auth__box-border-top" src="assets/images/border-icon-top.png" alt="">
                    </div>
                    <h2 class="auth__box-title">Создайте аккаунт</h2>
                    <div class="auth__box-content">
                
                <form class="form" method="POST">                
                    <div class="form__group">
                        <label>Логин</label>
                        <div class="form__group-input">
                                    <input type="text" id="name" name="username" placeholder="Введите свой логин" required>
                                </div>
                                    
                                            </div>
                    <div class="form__group">
                        <label>E-mail</label>
                        <div class="form__group-input">
                        <input type="text" class="form-control form-control-lg "
                               id="email" name="email" placeholder="Введите E-Mail" value="">
                                            </div>
                    </div>

                    <div class="form__group">
                        <label>Пароль</label>
                                <small>( используйте латинские буквы и введите не менее 8 символов )</small>
                        <div class="form__group-input">
                            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch is-hidden" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" id="password" name="password" placeholder="Введите пароль">
                                                    </div>
                    </div>

                    <div class="form__group">
                                <label>Подтвердите пароль</label>
                                <small>( используйте латинские буквы и введите не менее 8 символов )</small>
                        <div class="form__group-input">
                            <a tabindex="-1" href="#" data-target="password_confirmation">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password"
                                   id="password_confirmation" name="password_confirmation"
                                   placeholder="Введите пароль ещё раз">
                                                    </div>
                                                    <br />
                            <div class="checkbox-block">
                                <input name="ok" type="checkbox" value="1" checked="checked" id="privacy-policy" required>
                                <label class="checked" for="privacy-policy">
                                    <div class="square"></div>
                                    Я согласен с <a tabindex="-1" href="">пользовательским соглашением</a> &amp;
                                <a tabindex="-1" href="">политикой конфиденциальности</a>.
                                </label>
                            </div>                        </div>
                            <div class="form__group">
                                <div class="form__links">
                                    У Вас уже есть аккаунт? <a href="?page=login">Авторизоваться</a><br></div>
                            </div>
                         <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary mx-auto d-block mt-3 change-password-button"><span>Зарегистрироваться</span></button>
                                                                       
                        </div>
                         <p class="msg none"></p>

                         
                </form>
                        

                    </div>
                </div>
                
                <div class="auth__box">
                    <div class="auth__box-border">
                        <img class="auth__box-border-top" src="../template/indra/images/border-icon-top.png" alt="">
                    </div>
                    <h2 class="auth__box-title">Скачай файлы</h2>
                    <div class="auth__box-content">
                        <div class="download">
                            <a class="download__button" href="https://wow.net.kg/Launcher.zip">
                                <img src="assets/images/start__item-download.png">
                                <div>
                                    <span>Игровой Лаунчер v1.0</span>
                                </div>
                            </a>
                            <a class="download__button" href="https://wow.net.kg/world-of-warcraft-wrath-of-the-lich-king.torrent">
                                <img src="assets/images/start__item-download.png">
                                <div>
                                    <span>Скачать клиент игры</span>
                                    <span>Торрент файл</span>
                                </div>
                            </a>

                            <h3>КАК НАЧАТЬ ИГРАТЬ В WoW 3.3.5?</h3>

<ol>
    <li>Создайте мастер аккаунт</li>
    <li>Войдите в личный кабинет</li>
    <li>Скачайте Launcher и распакуйте его в любое для вас место</li>
    <li>Запустите Launcher и укажите папку с клиентов wow 3.3.5</li>
</ol>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <!-- END HEADER -->

<!--<div class="custom-container">
    <div class="custom-card mx-auto mt-4">
        <div class="card-body px-4 py-3">
            <h2 class="text-center title text-white mb-4" style="color:var(--title-text)!important;">REGISTER ACCOUNT</h2>
            <hr class="custom-hr mb-4" style="border-color: var(--main-border);">
            <form method="post">
                <div class="form-group mx-auto mt-2">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                </div>
                <div class="form-group mx-auto mt-2">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="form-group mx-auto mt-2">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="form-group mx-auto mt-2">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary mx-auto d-block mt-3 change-password-button" style="width:43%;">Register Account</button>
            </form>
            <p class="text-center text-white mt-3">Already have an account? Login <a href="?page=login" style="color: var(--page-text)">Here</a></p>
        </div>
    </div>
</div>-->
