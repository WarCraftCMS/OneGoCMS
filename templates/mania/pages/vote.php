<?php
session_start();

$global->check_logged_in();
$account = new Account($_SESSION['username']);

if (isset($_POST['change_password'])) {
    header("Location: ?page=changepassword");
    exit();
}

$vote_result = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote'])) {
    $vote_site = $_POST['vote_site'];
    $vote_result = $account->vote($vote_site);

    if (is_array($vote_result) && isset($vote_result['url'])) {
        header("Location: " . $vote_result['url']);
        exit();
    } else {
        $vote_result = $vote_result;
    }
}

$vote_sites = $account->get_vote_sites();
?>



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
        </div>        
        <div class="cp-content">
            <div class="cp-title flex-cc">Голосовать</div>
              <?php foreach ($vote_sites as $site): ?>
            <div class="vote-buttons flex-sbs">
                <form method="POST" action="">
                        <input type="hidden" name="vote_site" value="<?= htmlspecialchars($site['url']) ?>">
                        <button type="submit" name="vote" class="blue-button flex-cc vote-not-callback"><?= htmlspecialchars($site['name']) ?></button>
                </form>
            </div>
            <?php endforeach; ?>
            <br>
                                    <?php
                        if (!empty($vote_result)) {
                            echo '<p>' . htmlspecialchars($vote_result) . '</p>';
                        }
                        ?>
            <center>    
                <table width="95%">
                    <tr> 
                        <td>
                            <p><font color="orange"> ВНИМАНИЕ:</font> Бонус поинты за голосование начисляются раз в сутки в 00:00 по МСК!</p>
                        </td>
                    </tr>
                </table>
            </center>
        </div>
    </div>