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

    $store->process_direct_purchase($account_id, $character, $product_id, $quantity);
    
    $_SESSION['success_message'] = 'Вы успешно приобрели предмет!';
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

    <div class="hero min-h-screen hero15">
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="hero-content text-center text-neutral-content w-full">
                <div class="container">
            <div class="mx-auto max-w-5xl mt-36 2xl:pt-0">
                <h1 class="mb-5 text-4xl font-bold text-white text-shadow_dark">
                    Shop & Donation
                </h1>
                 <div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">
    <div class="grid-shop grid-cols-1 gap-4">
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
    </div>
        </div>
            </div>
        </div>
            </div>
<?php if ($successMessage) : ?>
    <div class="text-center">
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Отличная работа!</strong> <?= $successMessage ?>
        </div>
    </div>
<?php endif; ?>

<?php if ($errorMessage) : ?>
    <div class="text-center">
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Эй, там!</strong> <?= $errorMessage ?>
        </div>
    </div>
<?php endif; ?>
