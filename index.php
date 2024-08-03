<?php
   // Redirect to install page if install.lock is not found.
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
   
   $config_object = new gen_config();
   $config = $config_object->get_config();
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

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "url": "",
        "logo": "",
        "contactPoint": [{
            "@type": "ContactPoint",
            "email": "support@masterwow.net",
            "contactType": "customer service",
            "availableLanguage": ["en"]
        }],
        "sameAs": [
            ""
        ]
    }
    </script>
</head>

<body class="bg-custom-dark1">
    <div class="container mx-auto">
        <div class="container top-3 md:top-8 navbar bg-base-100 rounded-lg bg-indigo-950/90 z-auto">
            <div class="w-full hidden md:flex">
                <div class="flex-1">
                    <a href="?page=home" class="btn btn-ghost hover:bg-indigo-900/50 text-xl text-white">
                        <img src="https://masterwow.net/images/logo_sm.webp" alt="logo" class="h-10" />
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
                                    Аккаунт
                                </summary>
                                <ul class="p-2 bg-indigo-950 rounded-t-none min-w-40">
                                    <li><a href="?page=account" class="hover:bg-indigo-900/80">Кабинет</a></li>
                                    <li><a href="?page=logout" class="hover:bg-indigo-900/80">Выход</a></li>
                                </ul>
                            </details>
         <?php
            }
            ?>
                        </li>
                        <li>
                            <a href="" class="bg-rose-700 hover:bg-rose-900 text-white mx-2">
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
            <img src="assets/images/logo_sm.webp" alt="logo" class="h-20 mx-auto" />
            <p>
                Powered and Designed by
                <a href="https://masterking32.com" target="_blank" class="text-amber-600">
                    MasterkinG32
                </a>
                <br />&copy; 2024 MasterWoW. All rights reserved.
            </p>
        </aside>
        <nav>
            <h6 class="footer-title">Services</h6>
            <a href="https://masterwow.net/how-to-play" class="link link-hover">How to Play</a>
        </nav>
        <nav>
            <h6 class="footer-title">Account</h6>
            <a href="https://masterwow.net/sign-in" class="link link-hover">Sign In</a>
            <a href="https://masterwow.net/sign-up" class="link link-hover">Sing Up</a>
            <a href="https://masterwow.net/restore-password" class="link link-hover">Restore Password</a>
            <a href="https://masterwow.net/account-management" class="link link-hover">Account management</a>
        </nav>
        <nav>
            <h6 class="footer-title">MasterWoW</h6>
            <a href="https://masterwow.net/contact" class="link link-hover">Contact</a>
            <a href="https://masterwow.net/terms-of-use" class="link link-hover">Terms of use</a>
            <a href="https://masterwow.net/privacy-policy" class="link link-hover">Privacy policy</a>
        </nav>
    </footer>
</body>

</html>