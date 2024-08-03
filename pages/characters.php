<?php
$global->check_logged_in();
$account = new Account($_SESSION['username']);

if (isset($_POST['change_password'])) {
   header("Location: ?page=changepassword");
   exit();
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
         <?php
            $character = new Character();
            $characters = $character->get_characters($_SESSION['account_id']);
            foreach ($characters as $character) {
            ?>
<table _ngcontent-cpw-c6="" cellpadding="0" cellspacing="0" class="inner-table main-table" width="100%">

<tr _ngcontent-cpw-c6="">
   <?= $character['name']; ?>
      <img src="assets/images/race/<?= $character['race']; ?>.png" alt="<?= $character['race']; ?>">
               <img src="assets/images/class/<?= $character['class']; ?>.png" alt="<?= $character['class']; ?>">
               <?= $character['class']; ?>
               <?= $character['level']; ?>
</tr>


</table>
         <?php
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