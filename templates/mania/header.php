<!DOCTYPE html><html lang="ru-RU"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= $template_path ?>favicon.ico" rel="shortcut icon" type="image/x-icon">
    <title>OneGo WoW - Free WoW Private Haste Server (2024) | Home</title>
    <link href="<?= $template_path ?>css/new.css" rel="stylesheet">
    <link href="<?= $template_path ?>css/style.css" rel="stylesheet">
    <link href="<?= $template_path ?>css/style_media.css" rel="stylesheet">
    <link href="<?= $template_path ?>css/font-awesome.css" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <div class="navigation-bg">
        <nav class="flex-sbc">
            <div class="links flex-sc">


                <!--<div class="link"></div>-->
                <a href="?page=home" class="link active">ГЛАВНАЯ</a>
                <a href="?page=status" class="link ">СТАТУС</a>
                <?php
                if (!isset($_SESSION['username'])) { ?>
                <a href="?page=register" class="link ">РЕГИСТРАЦИЯ</a>
                <?php } else { ?>
                 <div class="link">
                    <div class="open-drop-box flex-cc">АККАУНТ <i class="fa fa-caret-down" aria-hidden="true"></i></div>
                    <div class="drop-box">
                        <a href="?page=account" class="link">ЛИЧНЫЙ КАБИНЕТ</a>
                        <a href="?page=donate" class="link">ПОЖЕРТВОВАТЬ</a>
                        <a href="?page=store" class="link">МАГАЗИН</a>
                        <a href="?page=vote" class="link">ГОЛОСОВАТЬ</a>
                    </div>
                </div>
                <?php } ?>
                <a href="?page=howtoplay" class="link ">КАК НАЧАТЬ</a>
                <?php if ($user_rank >= 1) { ?>
                    <a href="/admin" class="link">Админ</a>
                <?php } ?>


<?php
                            if (!isset($_SESSION['username'])) { ?>
                <a href="?page=login" class="cp-btn  flex-cc">
                    <img src="<?= $template_path ?>images/login_icon.png" class="icon">
                    <div class="info">
                       <div class="name">Вход</div>
                    </div>
                </a>
               <?php } else { ?>
                <a href="?page=account" class="cp-btn logged flex-cc">
                    <img src="<?= $template_path ?>images/login_icon.png" class="icon">
                    <div class="info">
                        <div class="desc">Логин:</div>                        
                        <div class="name"><?= $_SESSION['username'] ?></div>
                    </div>
                </a>
                 <?php } ?>
            </div>
            <a href="index.php" class="logo flex-cc"><img src="<?= $template_path ?>images/nav_logo.png" alt=""></a>
            <div class="open-navigation"><i></i></div>
        </nav>
    </div>
    <div class="header-bg ">
        <header>
            <div class="header-content">
                <a href="index.php" class="logo"><img src="<?= $template_path ?>images/logo.png" alt=""></a>
                <div class="status-server flex-cc">
                    <div class="server flex-cc">
                        <div class="name"><b><?= $server->get_realm_name(); ?></b></div>
                        <div class="icon flex-cc"><?= $server->get_status_server2(); ?></div>
                        <div class="online"><b><?= $server->get_online_players(); ?></b></div>
                    </div>
                    <div class="realmist flex-cc">set realmlist logon.wow.net.kg</div>
                </div>
            </div>
        </header>
    </div>

<div class="content-bg">