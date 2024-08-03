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
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>OneGo WoW</title>
      
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <link rel="apple-touch-icon" sizes="256x256" href="assets/images/favicon.png">

    <link rel="stylesheet" href="assets/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">

    <link rel="stylesheet" type="text/css" href="assets/css/addition.css">

   </head>
   <body>
<div class="wrapper">

    <!-- NAVIGATION -->
<nav class="nav">
    <div class="content-area">

        <a href="/" class="nav__logo">
            <img src="assets/images/logo.png" alt="logo">
        </a>

        <div class="nav__links">

    <div class="nav__item">
        <a href="/" class="nav__item-text">
            <span>Аккаунт</span>
        </a>
    </div>

    <div class="nav__item">
        <a href="/Launcher.zip" class="nav__item-text">
            <span>Лаунчер</span>
        </a>
    </div>

    <div class="nav__item">
        <div class="nav__item-text">
        <a href="https://discord.gg/QD6x24Re" class="nav__item-text">
            <span>Дискорд</span>
        </a>
        </div>
    </div>


</div>


        <div class="langs flex-cc">
</div>
         <?php // Check if the user is logged in
            if (!isset($_SESSION['username'])) {
                // User is logged in, display the "Once logged in" box
            ?>
        <a href="?page=login" class="nav__auth flex-cc">
        <i class="fas fa-sign-in-alt"></i>
        <span>Кабинет</span>
    </a>
    <a href="?page=register" class="gray-btn nav__account-btn">
        <i class="fas fa-user-plus"></i>
        <span>Создать аккаунт</span>
    </a>
         <?php
            } else {
                ?>
        <div class="nav__panel">
        <a href="?page=account" class="gray-btn nav__account-btn">
            <i class="fa-solid fa-user"></i>
            <span><?= $_SESSION['username'] ?></span>
        </a>
        <a href="?page=logout" class="nav__panel-out">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
         <?php
            }
            ?>


        <div class="open-main-menu">
            <div class="open-main-menu__item"></div>
        </div>

    </div>
</nav>
<!-- END NAVIGATION -->
      
      <!-- Content Starts -->
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
        </div> 

    <footer class="footer">
            <div class="content-area flex-ss">
        <div class="footer__cpr">
            <div class="footer__cpr-years">© 2024 OneGo WoW</div>
            
<div class="footer__cpr-text">World of Warcraft © и Blizzard Entertainment © являются товарными знаками или зарегистрированными товарными знаками Blizzard Entertainment в США и/или других странах. Настоящие условия и все связанные с ними материалы, логотипы и изображения защищены авторским правом © Blizzard Entertainment. Этот сайт никоим образом не связан и не одобрен Blizzard Entertainment ©</div>
          
</footer>

</div>

<!-- SCRIPTS -->
<script>
function ChangeColor(Element) {
    if (Element.style.color == 'red') Element.style.color = 'red';
    else Element.style.color = 'red';
    return false;
}
</script>
<!-- SCRIPTS -->
<script src="assets/js/onego/jquery.min.js"></script>
<script src="assets/js/onego/navigation.js"></script>
<script src="assets/js/onego/slick.js" type="text/javascript"></script>
<script src="assets/js/onego/MVisionToggleClass.js"></script>
<script src="assets/js/onego/timer.js"></script>
<script src="assets/js/onego/scripts.js"></script>
   </body>
</html>