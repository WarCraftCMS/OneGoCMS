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

if (!isset($_GET['page'])) {
    $page = 'home';
} else {
    if (preg_match('/[^a-zA-Z]/', $_GET['page'])) {
        $page = 'home';
    } else {
        $page = $_GET['page'];
    }
}

$global = new GlobalFunctions();
$server = new ServerInfo();

$config_object = new gen_config();
$config = $config_object->get_config();

$user_rank = null;
if (isset($_SESSION['username'])) {
    $account = new Account($_SESSION['username']);
    $user_rank = $account->get_rank();
}

?>



<!DOCTYPE html>
<html class="bg-custom-dark1">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0WKXNHKSLR"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-0WKXNHKSLR');
    </script>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/css/main.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/all.css" rel="stylesheet" />
    <title>OneGo WoW - Free WoW Private Haste Server (2024) | Home</title>

</head>

<body class="bg-custom-dark1">
    <div class="container mx-auto">
        <div class="container top-3 md:top-8 navbar bg-base-100 rounded-lg bg-indigo-950/90 z-auto">
            <div class="w-full hidden md:flex">
                <div class="flex-1">
                    <a href="?page=home" class="btn btn-ghost hover:bg-indigo-900/50 text-xl text-white">
                        <img src="assets/images/logo.png" alt="logo" class="h-10" />
                        OneGo WoW
                    </a>
                </div>
                <div class="flex-none">
                    <ul class="menu menu-horizontal px-1">
                        <li>
         <?php // Check if the user is logged in
            if (!isset($_SESSION['username'])) {
                // User is logged in, display the "Once logged in" box
            ?>
                            <details>
                                <summary class="hover:bg-indigo-600 hover:text-white focus:bg-indigo-700">
                                    Аккаунт
                                </summary>
                                <ul class="p-2 bg-indigo-950 rounded-t-none min-w-40">
                                    <li><a href="?page=login" class="hover:bg-indigo-900/80">Вход</a></li>
                                    <li><a href="?page=register" class="hover:bg-indigo-900/80">Регистрация</a></li>
                                </ul>
                            </details>
         <?php
            } else {
                ?>
                         <details>
                                <summary class="hover:bg-indigo-600 hover:text-white focus:bg-indigo-700">
                                    <?= $_SESSION['username'] ?>
                                </summary>
                                <ul class="p-2 bg-indigo-950 rounded-t-none min-w-40">
                                    <li><a href="?page=account" class="hover:bg-indigo-900/80">Кабинет</a></li>
                                    <?php
                                        if ($user_rank >= 1) {
                                        ?>
                                            <li><a href="/admin" class="hover:bg-indigo-900/80">Админ</a></li>
                                        <?php
                                        }
          ?>
                                    <li><a href="?page=logout" class="hover:bg-indigo-900/80">Выход</a></li>
                                </ul>
                            </details>
         <?php
            }
            ?>
                        </li>
                        <li>
                            <a class="bg-cyan-800 hover:bg-cyan-800 text-white mx-2">
                                Общий Онлайн: <?= $server->get_online_players(); ?>
                            </a>
                        </li>
                        <li>
                            <a href="" class="bg-cyan-600 hover:bg-cyan-700 text-white mx-2">
                                О сервере
                            </a>
                        </li>
                        <li>
                            <a href="?page=howtoplay" class="bg-rose-700 hover:bg-rose-900 text-white mx-2">
                                Как начать играть?
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

                  <?php
         $page = $_GET['page'] ?? 'home'; // Default to home if no page parameter is set
         $page_parts = explode('/', $page);
         
         foreach ($page_parts as &$part) {
             $part = preg_replace('/[^a-z0-9]/i', '', $part);
         }
         unset($part);
         
         $page_path = implode('/', $page_parts) . '.php';
         
         if (file_exists('pages/' . $page_path)) {
             include 'pages/' . $page_path;
         } else {
             include 'pages/404.php';
         }
         ?>


    <footer class="footer p-10 bg-slate-950 text-base-content">
        <aside class="text-center mx-auto">
            <img src="assets/images/logo.png" alt="logo" class="h-20 mx-auto" />
            <p>
                <br />&copy; 2024 OneGo WoW. All rights reserved.
            </p>
        </aside>
    </footer>
</body>

</html>