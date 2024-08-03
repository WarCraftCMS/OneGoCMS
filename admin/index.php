<?php
session_start();
foreach (glob("engine/configs/*.php") as $filename) {
    require_once $filename;
}
foreach (glob("functions/*.php") as $filename) {
    require_once $filename;
}

if (!isset($_GET['page']))
    $page = 'dashboard';
else {
    if (preg_match('/[^a-zA-Z]/', $_GET['page']))
        $page = 'dashboard';
    else
        $page = $_GET['page'];
}

require_once '../engine/functions/account.php';
require_once '../engine/functions/database.php';
$account = new Account($_SESSION['username']);
$rank = $account->get_rank();

if ($rank < 1) {
    header("Location: /?page=home");
    exit();
}

$stats = new Dashboard();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/backend.css">
    <link rel="stylesheet" href="../assets/css/dashlite.css">
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/theme.css">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script src="../assets/js/jquery-2.1.1.min.js"></script>
    <script src="../assets/js/ckeditor.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7N5B4KFFK9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7N5B4KFFK9');
</script>
</head>
    <body class="nk-body bg-lighter npc-general has-sidebar ">
   <div class="nk-app-root">
        <!-- main @s  -->
        <div class="nk-main ">
            <!-- sidebar @s  -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="/admin" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="../assets/images/wow-logo-white.png" srcset="../assets/images/wow-logo-white.png 2x" alt="logo">
                            <img class="logo-dark logo-img" src="../assets/images/wow-logo-white.png" srcset="../assets/images/wow-logo-white.png 2x" alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-menu-trigger mr-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div>
                <!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title text-primary-alt">Контент сайта</h6>
                                    </li>
                                    <!-- .nk-menu-item -->
                                    <li class="nk-menu-item">
                                        <a href="/admin/?page=dashboard" class="nk-menu-link ">
                                            <span class="nk-menu-text">Главная</span>
                                        </a>
                                    </li>

                                    <!-- .nk-menu-item -->
                                    <li class="nk-menu-item">
                                        <a href="/admin/?page=news" class="nk-menu-link ">
                                            <span class="nk-menu-text">Новости</span>
                                        </a>
                                    </li>


                                    
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Администрирование</h6>
                                </li>

                                                            <!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="/admin/?page=accounts" class="nk-menu-link" data-original-title="" title="">
                                        <span class="nk-menu-text">Пользователи</span>
                                        <span class="nk-menu-badge"><?php echo $stats->total_accounts(); ?></span>
                                    </a>
                                    <!-- .nk-menu-sub -->
                                </li>


                                <!-- .nk-menu-item -->
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Статус серверов</h6>
                                </li>

                                
                                 <!-- .nk-menu-item -->
                                        <li class="nk-menu-item has-sub">
                                            <a href="#" class="nk-menu-link" data-original-title="" title="">
                                                <span class="nk-menu-text">Пустое меню</span>
                                            </a>
                                            <!-- .nk-menu-sub -->
                                        </li>
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->


            </div>
            <!-- sidebar @e  -->
            <!-- wrap @s  -->
            <div class="nk-wrap ">
                <!-- main header @s  -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="/backend" class="logo-link">
                                    <img class="logo-light logo-img" src="../assets/images/wow-logo-white.png" srcset="../assets/images/wow-logo-white.png 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="../assets/images/wow-logo-white.png" srcset="../assets/images/wow-logo-white.png 2x" alt="logo-dark">
                                    <span class="nio-version">General</span>
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-news d-none d-xl-block">
                                <div class="nk-news-list">

                                        <div class="nk-news-text">
                                            
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        </div>

                                </div>
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">

                                <ul class="nk-quick-nav">

                                <li class="dropdown user-dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <div class="user-toggle">
            <div class="user-avatar sm"></div>
            <div class="user-info d-none d-md-block">
                                    <div class="user-status">Администратор</div>
                                <div class="user-name"><?= $_SESSION['username'] ?></div>
            </div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
            <div class="user-card">
                <div class="user-avatar">
                </div>
                <div class="user-info">
                    <span class="lead-text"><?= $_SESSION['username'] ?></span>
                    <span class="sub-text"></span>
                </div>
            </div>
        </div>
        
        <div class="dropdown-inner">
            <ul class="link-list">
                <li><a href="/?page=home"><span>На сайт</span></a></li>
                <li><a href="/admin/?page=logout"><span>Выход</span></a></li>
            </ul>
        </div>
    </div>
</li>


                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e  -->

                <!-- content @s  -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
            <?php

            if (file_exists('pages/' . $page . '.php')) {
                include 'pages/' . $page . '.php';
            } else {
                include 'pages/404.php';
            }
            ?>


    <!-- .nk-block -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e  -->



                <!-- footer @s  -->
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; 2024 <a href="https://wow.net.kg" title="" target="_blank" rel="dofollow">OneGo WoW</a> by <a href="https://wow.net.kg" title="Website development / Разработка сайта — Aizen" target="_blank" rel="dofollow">Aizen</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e  -->
            </div>
            <!-- wrap @e  -->
        </div>
        <!-- main @e  -->
    </div>
    <!-- app-root @e  -->



    </body>
        <script>
        $(document).ready(function() {
            $("#color_mode").on("change", function () {
                if($(this).prop("checked") == true){
                    //window.location.href = 'https://wow.wizardcp.com/settheme/dark';
                    $.get('/settheme/dark');
                    $('link[href="assets/css/theme.css"]').attr('href', 'assets/css/backend-dark.css?ver=2');
                }
                else if($(this).prop("checked") == false){
                    //window.location.href = 'https://wow.wizardcp.com/settheme/light';
                    $.get('/settheme/light');
                    $('link[href="assets/css/backend-dark.css?ver=2"]').attr('href', 'assets/css/theme.css');
                }
            })
        });
    </script>



<!-- JavaScript -->
<script src="../assets/js/bundle.js?ver=1.0.0"></script>
<script src="../assets/js/scripts.js?ver=1.0.0"></script>
<script src="../assets/js/charts/gd-general.js?ver=1.0.0"></script>





</body>