<?php
$global->check_logged_in();
$store = new Store();
$account_id = $_SESSION['account_id'];
$cart = $store->get_cart($account_id);
$check = true;

if (isset($_POST['check-out'])) {
    $check = $store->check_cart($account_id);
}

$account = new Account($_SESSION['username']);
$character = new Character();
$characters = $character->get_characters($account->get_id());
?>
<div class="container">
    <div class="card mt-3 mx-auto" style="max-width: 700px;">
        <div class="card-body custom-card-body">
            <div class="row">
                <h3 class="custom-card-text text-center">Корзина</h3>
                <!-- Check if account has enough donor points -->
                <?php if ($check == false) : ?>
                    <div class="col text-center text-white">
                        <p>У вас недостаточно очков!</p>
                    </div>
                <?php endif; ?>
            </div>
            <hr>
            <div class="row">
                <form method="POST">
                    <table class="table mx-auto text-white" style="max-width: 500px;">
                        <thead>
                            <tr>
                                <th>Название предмета</th>
                                <th>Цена</th>
                                <th>Количество</th>
                                <th>Персонаж</th>
                                <th>Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 1000;
                            foreach ($cart as $item) :
                                $item_price = $store->get_item_price($item['product_id']);
                                $item_name = $store->get_item_name($item['product_id']);
                                $total += $item_price[1] * $item['quantity'];
                            ?>
                                <tr>
                                    <td>
                                        <a href="http://wotlk.cavernoftime.com/item=<?= $item['product_id'] ?>" class="item">
                                            <?= $item_name ?>
                                        </a>
                                    </td>
                                    <td><?php echo $item_price[1]; ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td>
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                        <select name="character" class="form-control">
                                            <?php foreach ($characters as $character) : ?>
                                                <option value="<?= $character['name'] ?>"><?= $character['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                        <input type="submit" name="remove_from_cart" value="Удалить" class="btn btn-danger">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="row">
                        <div class="col text-center text-white">
                            <p>Всего: <?php echo $total; ?> Донат монет</p>
                            <input type="submit" name="check-out" value="Проверить" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
