<?php
if (!file_exists('engine/install.lock')) {
    header('Location: install');
    exit;
}

if (!isset($_SESSION)) {
    session_start();
}

foreach (glob("engine/functions/*.php") as $filename) {
    require_once $filename;
}

foreach (glob("engine/configs/*.php") as $filename) {
    require_once $filename;
}

$page = $_GET['page'] ?? 'home';
if (preg_match('/[^a-zA-Z]/', $page)) {
    $page = 'home';
}

if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password'])) {
    $login = new Login($_POST['username'], $_POST['password']);
    
    if ($login->login()) {
        header("Location: ?page=account");
        exit();
    }
}

if (isset($_POST['change_password'])) {
    header("Location: ?page=changepassword");
    exit();
}

if (isset($_POST['submit_item_action'])) {
    $user_id = $_SESSION['account_id'] ?? null;
    if ($user_id) {
        $store = new Store();
        $itemManager = new ItemManager();
        $item_id = intval($_POST['item_id']);
        $action = $_POST['action'];
        $character = isset($_POST['character']) ? trim($_POST['character']) : null;
        
        if ($itemManager->handleItemAction($user_id, $item_id, $action, $character)) {
            header('Location: ?page=bag');
            exit();
        }
    }
}

if (isset($_POST['remove_from_cart'])) {
    $store = new Store();
    $store->remove_from_cart($_POST['id']);
    header("Location: ?page=cart");
    exit();
}

if (isset($_POST['buy_now'])) {
    $account_id = $_SESSION['account_id'] ?? null;
    if ($account_id) {
        $store = new Store();
        $character = $_POST['character'];
        $product_id = $_POST['product_id'];
        $quantity = 1;

        if ($store->process_direct_purchase($account_id, $character, $product_id, $quantity)) {
            $_SESSION['success_message'] = 'Вы успешно приобрели предмет!';
        } else {
            $_SESSION['error'] = $_SESSION['error'] ?? 'У вас недостаточно донат монет!';
        }
        header('Location: ?page=store');
        exit();
    }
}

if (isset($_POST['vote'])) {
    $account = new Account($_SESSION['username']);
    $vote_site = $_POST['vote_site'];
    $vote_result = $account->vote($vote_site);

    if (is_array($vote_result) && isset($vote_result['url'])) {
        header("Location: " . $vote_result['url']);
        exit();
    }
}

if (isset($_POST['unstick'])) {
    $character = new Character();
    $guid = $_POST['guid'];
    if ($character->teleport_to_home($guid)) {
        $_SESSION['success_message'] = 'Персонаж успешно телепортирован домой!';
    } else {
        $_SESSION['error'] = 'Не удалось телепортировать персонажа.';
    }
    header("Location: ?page=characters");
    exit();
}

if ($page === 'logout') {
    session_destroy();
    header("Location: ?page=home");
    exit();
}

if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirmation'])) {
    $reg = new Registration($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_confirmation']);
    $reg->register_checks();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_password']) && isset($_POST['confirm_password']) && isset($_POST['old_password'])) {
    if ($_POST['new_password'] == $_POST['confirm_password']) {
        $account = new Account($_SESSION['username']);
        $change_password_status = $account->change_password($_POST['old_password'], $_POST['new_password']);
        if ($change_password_status == "success") {
            $_SESSION['success_message'] = 'Password has been successfully changed.';
        } else {
            $_SESSION['error'] = 'Failed to change password. Please make sure your old password is correct.';
        }
    } else {
        $_SESSION['error'] = 'New password and confirmed password do not match.';
    }
    header("Location: ?page=changepassword");
    exit();
}

if (isset($_POST['donate_now'])) {
    $donation = new Donation($_SESSION['username']);
    $donation_amount = $_POST['donation_amount'];
    $donation->createDonation($donation_amount);
}

require_once __DIR__ . '/engine/configs/db_config.php';

$config_object = new Configuration();
$db = $config_object->getDatabaseConnection('website');

$result = $db->query("SELECT template_name FROM templates WHERE id = 1");
$template = '1';

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $template = htmlspecialchars($row['template_name'], ENT_QUOTES, 'UTF-8');
}

if (isset($_GET['template'])) {
    $template = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['template']);
}

$global = new GlobalFunctions();
$server = new ServerInfo();

$user_rank = null;
if (isset($_SESSION['username'])) {
    $account = new Account($_SESSION['username']);
    $user_rank = $account->get_rank();
}

$template_path = 'templates/' . $template . '/';
$page_template_path = $template_path . 'pages/';

$lang = 'ru';

$result = $db->query("SELECT lang_code FROM languages WHERE is_active = 1");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lang = htmlspecialchars($row['lang_code'], ENT_QUOTES, 'UTF-8');
}

$_SESSION['lang'] = $lang;

$translations = require("lang/$lang.php");

include $template_path . 'header.php';
include $template_path . 'content.php';
include $template_path . 'footer.php';

$db->close();
?>
