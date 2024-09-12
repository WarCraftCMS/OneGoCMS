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

$lang = 'en';

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
