<?php
$global->check_logged_in();

$user_id = $_SESSION['account_id'];
$store = new Store();
$itemManager = new ItemManager();
$bag_items = $store->get_user_bag_items($user_id);

if (isset($_POST['submit_item_action'])) {
    $item_id = intval($_POST['item_id']);
    $action = $_POST['action'];
    $character = isset($_POST['character']) ? trim($_POST['character']) : null;


    
    if ($itemManager->handleItemAction($user_id, $item_id, $action, $character)) {
        header('Location: ?page=bag');
        exit();
    } else {
        if (isset($_SESSION['error'])) {
            echo "<div class='error'>" . htmlspecialchars($_SESSION['error']) . "</div>";
        }
    }
}

$characterManager = new Character();
$characters = $characterManager->get_characters($user_id);
?>

<div class="hero min-h-screen hero14">
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="container mx-auto">
            <div class="max-w-3xl my-36">
                <h2 class="mt-10 text-3xl font-semibold text-white"></h2>
                <div class="mt-5 p-5 text-white bg-slate-950/60 rounded-lg">
                    <h3 class="mb-3"><?= $translations['bag'] ?></h3>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-5">
                        <?php if (!empty($bag_items)): ?>
                            <?php foreach ($bag_items as $item): ?>
                                <div class="flex justify-between">
                                    <div class="bg-white p-2 rounded shadow">
                                        <a href='<?= $translations['wowhead_item'] ?><?= htmlspecialchars($item['id']) ?>' 
                                           data-wh-icon-size="slow" data-wh-rename-link="true" target='_blank'>
                                            <span class="tooltiptext"><?= htmlspecialchars($item['name']) ?></span>
                                        </a>
                                        <form method="POST" action="">
                                            <input type="hidden" name="item_id" value="<?= htmlspecialchars($item['id']) ?>">
                                            <select name="action" class="bg-white p-2 rounded">
                                                <option value="sell"><?= $translations['sell'] ?></option>
                                                <option value="send"><?= $translations['send'] ?></option>
                                            </select>
                                            <select name="character" class="bg-white p-2 ml-2 rounded">
                                                <option value=""><?= $translations['select_a_character'] ?></option>
                                                <?php foreach ($characters as $char): ?>
                                                    <option value="<?= htmlspecialchars($char['name']) ?>"><?= htmlspecialchars($char['name']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="submit" name="submit_item_action" class="btn bg-primary text-white hover:bg-primary-dark transition-colors"><?= $translations['use'] ?></button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p><?= $translations['cart_is_empty'] ?></p>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const whTooltips = {colorLinks: true, iconizeLinks: true, renameLinks: true};
</script>
<script src="https://wow.zamimg.com/widgets/power.js"></script>
