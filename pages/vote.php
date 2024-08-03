<?php
session_start();

$global->check_logged_in();
$account = new Account($_SESSION['username']);

if (isset($_POST['change_password'])) {
   header("Location: ?page=changepassword");
   exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote'])) {
    $vote_result = $account->get_vote_mmotop();
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
                <div class="balance">Голосований: <span><?= $account->get_vote_currency()['votes'] ?> монет</span></div>
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

<div>
                <br>
                <center> 
                <table>
                    <tbody><tr>
                        <td><img alt="wow.png" src="../assets/img/icons/wow.png"><font color="orange"> Примечание:</font> Раз в день вы можете голосовать за сервер и получать по 1 голосу. </td>
                    </tr>
                    <tr>
                        <td> </td>
                    </tr>
                    
                </tbody></table>
                </center> 
                <br>
            </div>
<div class="shop_top">  
                </div>
                <div class="vote-buttons flex-sbs">
                        <?php
                        $vote_status = $account->is_banned();
                        if ($vote_status === "Good standing") {
                        ?>
                            <form method="POST" action="">
                                <button type="submit" name="vote" class="blue-button flex-cc">
                        <i><img src="../assets/img/vote/mmotop.png" height="56" width="88"></i></button>
                            </form>
                        <?php
                        } else {
                            echo '<p>Вы не можете голосовать, так как ваш аккаунт забанен.</p>';
                        }

                        if (isset($vote_result)) {
                            echo '<p>' . $vote_result . '</p>';
                        }
                        ?>
                </div>
            </div>
        </div>
 </div>
  </div>
        <!--end header-->
</body>
</html>