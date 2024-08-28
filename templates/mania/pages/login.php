<?php
   if (isset($_POST['submit'])) {
       $login = new Login($_POST['username'], $_POST['password']);
       //$login->login_checks();
   
       if ($login->login()) {
           header("Location: ?page=account");
           exit();
       }
   }
   
   if (isset($_SESSION['error'])) {
       echo "<div class='alert alert-danger text-center' role='alert'>" . $_SESSION['error'] . "</div>";
       unset($_SESSION['error']);
   }
   
   ?>

    <div class="content inner-content">
        <div class="inner-title flex-cc">ВХОД</div>
        <form id="login-form" class="inner-form" action="" method="post">

            <input type="hidden" name="_csrf-frontend" value="a7CohQNpo24cvDxdCg7dIePWNMC2C7QuEdGPd8ElGioa0eXGbQ7vPFjFCA1dZqhiuYJxkf079mgnm8Qmm3pWTg==">
            <div class="line">
                <div class="icon flex-cc"><i class="fa fa-user" aria-hidden="true"></i></div>
                <div class="form-group field-loginform-username required">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Введите Логин" />
                    <p class="help-block help-block-error"></p>
                </div>
            </div>
            <div class="line">
                <div class="icon flex-cc"><i class="fa fa-lock" aria-hidden="true"></i></div>
                <div class="form-group field-loginform-password required">
                    <input type="password" name="password" class="form-control" placeholder="Введите свой пароль" />
                    <p class="help-block help-block-error"></p>
                </div>
            </div>
            <button type="submit" class="blue-button flex-cc" name="submit">ВХОД</button>
        </form>
    </div>
