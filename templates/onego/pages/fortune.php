<?php
$global->check_logged_in();
$store = new Store();

$user_id = $_SESSION['account_id'];

if (isset($_POST['spin_wheel'])) {
    $currency_type = $_POST['currency_type'];
    $use_donor_points = ($currency_type === 'donor');

    if ($store->spin_wheel($user_id, $use_donor_points)) {
        echo '<div class="absolute-center">';
        echo '<div class="alert alert-dismissible alert-success">';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
        echo '<strong>Поздравляем!</strong> Вы выиграли приз!';
        echo '</div>';
        echo '</div>';
    } else {
        if (isset($_SESSION['error'])) {
            echo '<div class="absolute-center">';
            echo '<div class="alert alert-dismissible alert-danger">';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            echo '<strong>Извините!</strong> ' . $_SESSION['error'];
            echo '</div>';
            echo '</div>';
            unset($_SESSION['error']);
        }
    }
}

$fortuneItems = $store->get_fortune_items_with_details();
?>

<div class="hero min-h-screen hero14">
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="container mx-auto">
            <div class="max-w-3xl my-36">
                <h2 class="mt-10 text-3xl font-semibold text-white"></h2>
                <div class="mt-5 p-5 text-white bg-slate-950/60 rounded-lg">
                    <h3 class="mb-3"><?= $translations['try_your_luck'] ?></h3>
                    <form method="POST" action="" class="flex items-center justify-between">
                        <div class="mr-5">
                            <select name="currency_type" class="bg-white p-2 rounded">
                                <option value="donor" selected><?= $translations['donor_coins'] ?></option>
                                <option value="vote"><?= $translations['voting_coins'] ?></option>
                            </select>
                        </div>
                        <button type="submit" name="spin_wheel" class="btn bg-primary text-white hover:bg-primary-dark transition-colors"><?= $translations['spin_the_wheel'] ?></button>
                    </form>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-5">
                        <?php if (!empty($fortuneItems)): ?>
                            <?php for ($i = 0; $i < count($fortuneItems); $i += 2): ?>
                                <div class="flex justify-between">
                                    <?php for ($j = 0; $j < 2; $j++): ?>
                                        <?php if (isset($fortuneItems[$i + $j])): ?>
                                            <div class="bg-white p-2 rounded shadow">
                                                <a href='<?= $translations['wowhead_item'] ?><?= htmlspecialchars($fortuneItems[$i + $j]['item_id']) ?>' data-wh-icon-size="slow" data-wh-rename-link="true" target='_blank'>
                                                    <span class="tooltiptext"></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                            <?php endfor; ?>
                        <?php else: ?>
                            <p><?= $translations['no_items_fortune'] ?></p>
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

