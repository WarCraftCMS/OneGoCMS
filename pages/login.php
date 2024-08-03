<?php
   if (isset($_POST['submit'])) {
       $login = new Login($_POST['username'], $_POST['password']);
       //$login->login_checks();
   
       if ($login->login()) {
           header("Location: ?page=home");
           exit();
       }
   }
   
   if (isset($_SESSION['error'])) {
       echo "<div class='alert alert-danger text-center' role='alert'>" . $_SESSION['error'] . "</div>";
       unset($_SESSION['error']);
   }
   
   ?>

<!-- HEADER -->
    <header class="header header--auth">
        <div class="content-area">
            <div class="auth">
                <div class="auth__box auth__box--big">
                    <div class="auth__box-border">
                        <img class="auth__box-border-top" src="../template/indra/images/border-icon-top.png" alt="">
                    </div>
                    <h2 class="auth__box-title">Вход в аккаунт</h2>
                    <div class="auth__box-content">

                        <form class="form" method="POST">                                        
                                            <div class="form-group">
                                                <div class="form__group">
                                                    <label>Логин</label>
                                                <div class="form__group-input">
                                                <input type="text" class="form-control form-control-lg"
                                                       id="username" name="username" placeholder="Введите Логин" value="">
                                            </div>
                                            </div>
                                           <br />
                                            <div class="form__group">
                                                <div class="form-label-group">
                                                    <label>Пароль</label>
                                                    <small>( используйте латинские буквы и введите не менее 8 символов )</small>
                                                <div class="form__group-input">
                                                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch is-hidden" data-target="password">
                                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                    </a>
                                                    <input type="password" name="password" placeholder="Введите свой пароль" required>
                                                    
                                                </div>
                                            </div>
                                            </div>
                                            <br />
                                                <div class="form__group">
                                                   <button type="submit" name="submit" class="btn btn-primary btn-block d-block mt-3 change-password-button"><span>Авторизоваться</span></button>
                                                   
                                                </div>
                                                <br />
                                                <div class="form__group">
                                <div class="form__links">
                                    Нет аккаунта? <a href="?page=register">Зарегистрироваться</a><br>
                                    Забыли пароль? <a class="link link-primary link-sm" tabindex="-1" href="?page=changepasswordp">Восстановить</a><br>
                                </div>
                            </div>
                            <p class="msg none"></p>
                                        </form>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- END HEADER -->          
