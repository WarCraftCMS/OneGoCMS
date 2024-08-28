<?php
$global->check_logged_in();
$account = new Account($_SESSION['username']);
if (isset($_POST['change_password'])) 
{
   header("Location: ?page=changepassword");
   exit();
}



?>




    <div class="content inner-content flex-ss">
            <div class="cp-nav">
            <div class="user-info">
                <div class="desc">Вы вошли как:</div>
                <div class="name flex-sc"><?= $account->get_username(); ?> <a class="exit_button" href="?page=logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Выход</a></div>
                <div class="balance coins">Баланс: <span><balance class="balance_panel"><?= $account->get_donor_points(); ?></balance> GGP</span></div>
                <div class="balance coins">Голоса: <span><balance class="balance_panel"><?= $account->get_vote_points(); ?></balance> GGP</span></div>
                            </div>

            <div class="nav flex-cc">
                <a class="flex-sc active" href="?page=account"><div class="icon flex-cc"><i class="fa fa-user" aria-hidden="true"></i></div>Учетная Запись</a>
                <a class="flex-sc " href="?page=donate"><div class="icon flex-cc"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>Пожертвовать</a>
                <a class="flex-sc " href="?page=store"><div class="icon flex-cc"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>Магазин</a>
                <a class="flex-sc " href="?page=vote"><div class="icon flex-cc"><i class="fa fa-thumbs-up" aria-hidden="true"></i></div>Голосовать</a>
                <!--<a class="flex-sc " href="reward.php"><div class="icon flex-cc"><i class="fa fa-repeat" aria-hidden="true"></i></div>Награды</a>-->
                <!--<a class="flex-sc " href="refer.php"><div class="icon flex-cc"><i class="fa fa-exchange" aria-hidden="true"></i></div>Пригласить Друга</a>-->
                <!-- <a class="flex-sc" href="prime.php"><div class="icon flex-cc"><i class="fa fa-repeat" aria-hidden="true"></i></div>Подписка</a> -->
                <!-- <a class="flex-sc" href="transfer.php"><div class="icon flex-cc"><i class="fa fa-exchange" aria-hidden="true"></i></div>Transfer coins</a> -->
                <!-- <a class="flex-sc" href="promo.php"><div class="icon flex-cc"><i class="fa fa-tags" aria-hidden="true"></i></div>Промо код</a> -->
            </div>
        </div>        <div class="cp-content">
            <div class="cp-title flex-cc">Личный Кабинет</div>
            <div class="cp-banners flex-sbc">
                <a class="banner flex-cc" href="?page=store"><img class="bg" src="<?= $template_path ?>images/banner_1_bg.png"><span class="text">МАГАЗИН</span></a>
                <a class="banner flex-cc" href="?page=vote"><img class="bg" src="<?= $template_path ?>images/banner_2_bg.png"><span class="text">ГОЛОСОВАТЬ</span></a>
                <a class="banner flex-cc" href="?page=donate"><img class="bg" src="<?= $template_path ?>images/banner_3_bg.png"><span class="text">ДОНАТ</span></a>
            </div>
            <div class="cp-form-block">
                <div class="title">Смена Пароля</div>
                    <form method="post" action="" class="inner-form">
                    <input type="hidden" name="_csrf-frontend" value="pYOQsFLNr5m0HFuZXm9wsjwfsZ_ghA2pY6VbrB2FtS7ps_XqDYX9q_VXCulzIjzjf1LU27HdR5EUyDjoKcvjfQ==">
                    <div class="line">
                        <div class="icon flex-cc"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        <div class="form-group field-changepasswordform-password_current required">
                            <input type="password" id="old_password" class="form-control" name="old_password" placeholder="Текущий пароль" aria-required="true">
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="line">
                        <div class="icon flex-cc"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        <div class="form-group field-changepasswordform-password required">
                            <input type="password" id="new_password" class="form-control" name="new_password" placeholder="Новый пароль" aria-required="true">
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="line">
                        <div class="icon flex-cc"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        <div class="form-group field-changepasswordform-password_repeat required">
                            <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Повторите новый пароль" aria-required="true">
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <button type="submit" name="changepassword" class="blue-button flex-cc" name="submit">Сменить Пароль</button>
                </form>
            </div>

        </div>
    </div>