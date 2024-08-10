<?php
$global->check_logged_in();
$store = new Store();
$account_id = $_SESSION['account_id'];
$account = new Account($_SESSION['username']);
$check = true;

if (isset($_POST['buy_now'])) {
    $character = $_POST['character'];
    $product_id = $_POST['product_id'];
    $quantity = 1;

    $check = $store->process_direct_purchase($account_id, $character, $product_id, $quantity);
}

if (isset($_SESSION['success_message'])) {
    echo '<div class="text-center">';
    echo '<div class="alert alert-dismissible alert-success">';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    echo '<strong>Отличная работа!</strong> ' . $_SESSION['success_message'];
    echo '</div>';
    echo '</div>';
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error'])) {
    echo '<div class="text-center">';
    echo '<div class="alert alert-dismissible alert-danger">';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    echo '<strong>Эй, там!</strong> ' . $_SESSION['error'];
    echo '</div>';
    echo '</div>';
    unset($_SESSION['error']);
}

$category = isset($_GET['category']) ? $_GET['category'] : 1;

$categories = $store->get_categories();
$items = $store->get_items($category);
$character = new Character();
$characters = $character->get_characters($account->get_id());
?>

<div class="hero min-h-screen hero15">
    <div class="grid grid-cols-1 gap-4">
        <?php foreach ($items as $item) : ?>
            <div class="card bordered shadow-lg bg-indigo-900/10 group hover:bg-indigo-950/70 transition duration-500 ease-in-out">
                <figure class="px-10 pt-10">
                    <img src="https://masterwow.net/images/shop_donor_token.png" 
                         alt="<?= htmlspecialchars($item['title']) ?>" 
                         class="mask mask-squircle max-w-40 max-h-40 brightness-50 transition duration-500 ease-in-out group-hover:brightness-100">
                </figure>
                <div class="card-body w-full">
                    <h2 class="card-title text-center mx-auto text-amber-500">
                        <a href="http://wotlk.cavernoftime.com/item=<?= htmlspecialchars($item['item_id']) ?>" class="item">
                            <?= htmlspecialchars($item['title']) ?>
                        </a>
                    </h2>
                    <div class="text-center mx-auto">
                        <span class="text-xl font-bold">Цена: <span class="text-green-500"><?= htmlspecialchars($item['donor_points']) ?></span></span>
                    </div>
                    <p class=""><?= htmlspecialchars($item['description']) ?></p>
                    <div class="card-actions text-center mx-auto">
                        <form action="" method="POST">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['item_id']); ?>">
                            <select name="character" class="select select-bordered w-full">
                                <?php foreach ($characters as $char) : ?>
                                    <option value="<?= htmlspecialchars($char['name']) ?>"><?= htmlspecialchars($char['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" name="buy_now" class="btn bg-cyan-600 hover:bg-cyan-700 text-white">Купить сейчас</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
