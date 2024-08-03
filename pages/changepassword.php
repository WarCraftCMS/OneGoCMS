<?php
$global->check_logged_in();
$account = new Account($_SESSION['username']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['new_password'] == $_POST['confirm_password']){  // check if new password matches confirmed password
        $change_password_status = $account->change_password($_POST['old_password'], $_POST['new_password']);
        if ($change_password_status == "success") {
            echo '<div class="alert alert-success">Password has been successfully changed.</div>';
        } else {
            echo '<div class="alert alert-danger">Failed to change password. Please make sure your old password is correct.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">New password and confirmed password do not match.</div>';
    }
}
?>




<html lang="ru" class="js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Личный кабинет</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="../assets/css/panel.css">
    <link rel="stylesheet" href="../assets/css/panel_mobile.css">
    </head> 



<body>

<!--header-->
    <div class="header">         
        <div class="header__video-wrapp">
        <div class="header__video-box">
           <video class="header__video" autoplay loop muted>
              <source src="assets/images/bg.webm" type="video/webm">
          </video>
        </div>
    </div>             
<div class="content-bg">
    <div class="content inner-content flex-ss">
        <div class="cp-nav">
            <div class="user-info">
                <div class="balance coins">Бонусов: <span><?= $account->get_bonuses_currency()['bonuses'] ?> монет</span></div>
                <div class="balance">Голосований: <span> монет</span></div>
                <div class="balance">Премиум: <?= $account->is_premium(); ?><span></span></div>
            </div>
            <div class="navv flex-cc">
                <a class="flex-sc" href="?page=account"><div class="icon flex-cc"><i class="fa fa-user" aria-hidden="true"></i></div>Информация</a>                
                <a class="flex-sc" href="?page=changepassword"><div class="icon flex-cc"><i class="fa fa-key" aria-hidden="true"></i></div>Сменить пароль</a>  
                <a class="flex-sc" href="?page=characters"><div class="icon flex-cc"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>Персонажи</a>                 
                <a class="flex-sc" href=""><div class="icon flex-cc"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>Пополнить баланс</a>                               
                <a class="flex-sc" href="?page=vote"><div class="icon flex-cc"><i class="fa fa-thumbs-up" aria-hidden="true"></i></div>Голосование</a>                      
            </div>      
        </div>
        <div class="cp-content">
            <div class="cp-title flex-cc">Панель пользователя</div>
            <div class="cp-banners flex-sbc">
                <a class="banner flex-cc" href=""><img class="bg" src="../assets/img/banner_1_bg.png"><span class="text">МАГАЗИН</span></a>
                <a class="banner flex-cc" href=""><img class="bg" src="../assets/img/banner_2_bg.png"><span class="text">ГОЛОСОВАНИЕ</span></a>
                <a class="banner flex-cc" href=""><img class="bg" src="../assets/img/banner_3_bg.png"><span class="text">ПОПОЛНИТЬ</span></a>            </div>
            <div class="cp-form-block">
                <div class="title">Сменить пароль</div>
                <form method="post" action="/?page=changepassword" class="inner-form">
                    <div class="lines">
                        <div class="icon flex-cc"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        <div class="form-group field-changepasswordform-password_current required">

<input type="text" id="old_password" name="old_password" class="form-control-pass" placeholder="Текущий пароль" aria-required="true">

<div class="help-block"></div>
</div>                    </div>


                    <div class="lines">
                        <div class="icon flex-cc"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        <div class="form-group field-changepasswordform-password required">

<input type="password" id="new_password" name="new_password" class="form-control-pass" placeholder="Новый пароль" aria-required="true" aria-autocomplete="list">

<div class="help-block"></div>
</div>                    </div>


                    <div class="lines">
                        <div class="icon flex-cc"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        <div class="form-group field-changepasswordform-password_repeat required">

<input type="password" id="confirm_password" name="confirm_password" class="form-control-pass" placeholder="Повторите новый пароль" aria-required="true">

<div class="help-block"></div>
</div>                    </div>
                <button type="submit" name="submit" class="main-btn">Изменить</button>         
                </form>            
                <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                                <div class="messagesuc"><?php if(isset($messagesuc)) { echo $messagesuc; } ?></div>
                
                </div> 
    
    
    </div>
        </div>
    </div>
</div>
</div>
     
            <!--end header-->


</body>
</html>