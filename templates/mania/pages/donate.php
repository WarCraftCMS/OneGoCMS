    <div class="content inner-content flex-ss">
            <div class="cp-nav">
            <div class="user-info">
                <div class="desc">Вы вошли как:</div>
                <div class="name flex-sc"><?= $account->get_username(); ?> <a class="exit_button" href="?page=logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Выход</a></div>
                <div class="balance coins">Баланс: <span><balance class="balance_panel"><?= $account->get_account_currency()['donor_points'] ?></balance> GGP</span></div>
                <div class="balance coins">Голоса: <span><balance class="balance_panel"><?= $account->get_account_currency()['vote_points'] ?></balance> GGP</span></div>
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
            <div class="cp-title flex-cc">Пожертвовать</div>
            <div class="cp-form-block">
                <div class="donate-form">

                    <h2>Принимаем:</br>Банковские карты (Visa, MasterCard и т.д.).</br>Киви, Юмани, SteamPay и т.д.</h2>
                    <form class="inner-form" method="post">
                        <div class="line">
                            <div class="icon flex-cc"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>
                            <input type="text" name="amount" placeholder="Количество GGP">
                        </div>
                        <div class="line"><div class="price">1 GGP = 1 RUB</div></div>
                        <button class="blue-button flex-cc" name="donate-button">Пожертвовать</button>
                    </form>


                    <h2>Резервный способ:</br>Банковские карты (Visa, MasterCard и т.д.).</br>Киви, Юмани и т.д.</h2>
                    <form class="inner-form" method="post">
                        <div class="line">
                            <div class="icon flex-cc"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>
                            <input type="text" name="amount" placeholder="Количество GGP">
                        </div>
                        <div class="line"><div class="price">1 GGP = 1 RUB</div></div>
                        <button class="blue-button flex-cc" name="donate-button88888">Пожертвовать</button>
                    </form>

<!--
                    <h2>Для пожертвования с Украинских карт выбирайте способ оплаты USD!</h2>
                    <h2>Конвертация будет выполнена по курсу вашего банка!</h2>
                    <h2>Иногда может потребоваться использование VPN!</h2>
                    <h2><img style="height: 100px; width: 200px;" src="..\uploads\files\dark_big_logo_32.png"></h2>
-->



<!--
</br></br></br></br></br>

<form class="inner-form" method="POST" action="https://yoomoney.ru/quickpay/confirm.xml">
<input type="hidden" name="receiver" value="4100111024786747">
<input type="hidden" name="formcomment" value="пожертвование для wowgg.org">
<input type="hidden" name="short-dest" value="пожертвование для wowgg.org">
<input type="hidden" name="label" value="g18962">
<input type="hidden" name="quickpay-form" value="donate">
<input type="hidden" name="targets" value="пожертвование для wowgg.org">
<input type="hidden" name="comment" value="пожертвование для wowgg.org">
<input type="hidden" name="need-fio" value="false">
<input type="hidden" name="need-email" value="false">
<input type="hidden" name="need-phone" value="false">
<input type="hidden" name="need-address" value="false">

<input type="hidden" name="paymentType" value="AC">

<div class="line">
    <div class="icon flex-cc"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>
    <input type="text" name="sum" data-type="number" placeholder="Количество GGP">
</div>
<div class="line"><div class="price">1 GGP = 1 RUB</div></div>
-->
<!--
<div class="select" style="width: 80%; margin-bottom: 20px;">
    <select name="paymentType">
        <option value="" selected="" disabled="">Способ оплаты:</option>
        <option value="AC">Банковской картой</option>
        <option value="PC">ЮМани (Яндекс Деньги)</option>
    </select>
    <div class="arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div>
</div>
-->
<!--
<button class="blue-button flex-cc" type="submit">Пожертвовать</button>
</form>
-->



                </div>
            </div>
        </div>
    </div>