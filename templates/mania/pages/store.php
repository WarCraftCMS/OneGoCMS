<?php
if (isset($GLOBALS['global'])) {
    $GLOBALS['global']->check_logged_in();
}

$store = new Store();
$account_id = $_SESSION['account_id'];
$account = new Account($_SESSION['username']);

$successMessage = '';
$errorMessage = '';

if (isset($_POST['buy_now'])) {
    $character = $_POST['character'];
    $product_id = $_POST['product_id'];
    $quantity = 1;

    if ($store->process_direct_purchase($account_id, $character, $product_id, $quantity)) {
        $_SESSION['success_message'] = 'Вы успешно приобрели предмет!';
    } else {
        $errorMessage = $_SESSION['error'] ?? 'У вас недостаточно донат монет!';
    }

    header('Location: ?page=store');
    exit();
}

if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error'];
    unset($_SESSION['error']);
}

$category = isset($_GET['category']) ? $_GET['category'] : 1;

$categories = $store->get_categories();
$items = $store->get_items($category);

$character = new Character();
$characters = $character->get_characters($account->get_id());
?>

<div class="content inner-content flex-ss">
    <div class="cp-nav">
        <div class="user-info">
            <div class="desc">Вы вошли как:</div>
            <div class="name flex-sc"><?= $account->get_username(); ?> <a class="exit_button" href="?page=logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Выход</a></div>
            <div class="balance coins">Баланс: <span><balance class="balance_panel"><?= htmlspecialchars($account->get_account_currency()['donor_points']) ?></balance> GGP</span></div>
            <div class="balance coins">Голоса: <span><balance class="balance_panel"><?= $account->get_account_currency()['vote_points'] ?></balance> GGP</span></div>
        </div>

        <div class="nav flex-cc">
            <a class="flex-sc active" href="?page=account"><div class="icon flex-cc"><i class="fa fa-user" aria-hidden="true"></i></div>Учетная Запись</a>
            <a class="flex-sc" href="?page=donate"><div class="icon flex-cc"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>Пожертвовать</a>
            <a class="flex-sc" href="?page=store"><div class="icon flex-cc"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>Магазин</a>
            <a class="flex-sc" href="?page=vote"><div class="icon flex-cc"><i class="fa fa-thumbs-up" aria-hidden="true"></i></div>Голосовать</a>
        </div>
    </div>

    <div class="cp-content">
        <div class="cp-title flex-cc">МАГАЗИН</div>

        <div>
            <br>
            <center> 
            <table>
                <tr><td><font color="orange"> Внимание:</font></td></tr>
                <tr><td></td></tr>
                <tr><td><li>Услуги выполняются в автоматическом режиме!</li></td></tr>
                <tr><td><li>Выбраный предмет придёт на внутриигровую почту!</li></td></tr>
            </table>
            </center> 
            <br>
        </div>

        <div class="item-list flex-ss">
            <?php foreach ($items as $item) : ?>
                <div class="item flex-cs">
                    <img src="https://wowgg.org/uploads/shop/Gold.png" alt="<?= htmlspecialchars($item['title']) ?>" class="icon">
                    <a href="http://wotlk.cavernoftime.com/item=<?= htmlspecialchars($item['item_id']) ?>" class="name"><?= htmlspecialchars($item['title']) ?></a>
                    <div class="desc" title="<?= htmlspecialchars($item['description']) ?>"><?= htmlspecialchars($item['description']) ?></div>
                    <div class="price"><?= htmlspecialchars($item['donor_points']) ?> GGP</div>

                    <div class="shop_top flex-sbc">
                        <form action="" method='post' class="flex-sbc" style="width: 100%; margin: 0 auto;">
                            <div class="select" style="width: 100%; margin-bottom: 20px;">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['item_id']); ?>">
                                <select name="character" required>
                                     <?php foreach ($characters as $char) : ?>
                                        <option value="<?= htmlspecialchars($char['name']) ?>"><?= htmlspecialchars($char['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div>
                             </div>
                            <button type="submit" name="buy_now" class="blue-button flex-cc shop_button">ПОЛУЧИТЬ</button>
                        </form>         
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php if ($successMessage) : ?>
    <div class="text-center">
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Отличная работа!</strong> <?= htmlspecialchars($successMessage) ?>
        </div>
    </div>
<?php endif; ?>

<?php if ($errorMessage) : ?>
    <div class="text-center">
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Эй, там!</strong> <?= htmlspecialchars($errorMessage) ?>
        </div>
    </div>
<?php endif; ?>