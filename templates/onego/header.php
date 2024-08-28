<!DOCTYPE html>
<html class="bg-custom-dark1">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?= $template_path ?>css/main.css" rel="stylesheet" />
    <link href="<?= $template_path ?>css/style.css" rel="stylesheet" />
    <link href="<?= $template_path ?>css/all.css" rel="stylesheet" />
    <link href="<?= $template_path ?>css/theme.css" rel="stylesheet" />
    <script src="<?= $template_path ?>js/test.js"></script>
    <title>OneGo WoW - Free WoW Private Haste Server (2024) | Home</title>
</head>
<body class="bg-custom-dark1">
    <div class="container mx-auto">
        <div class="container top-3 md:top-8 navbar bg-base-100 rounded-lg bg-indigo-950/90 z-auto">
            <div class="w-full hidden md:flex">
                <div class="flex-1">
                    <a href="?page=home" class="btn btn-ghost hover:bg-indigo-900/50 text-xl text-white">
                        <img src="<?= $template_path ?>images/logo.png" alt="logo" class="h-10" />
                        OneGo WoW
                    </a>
                </div>
                <div class="flex-none">
                    <ul class="menu menu-horizontal px-1">
                        <li>
                            <?php
                            if (!isset($_SESSION['username'])) { ?>
                                <details>
                                    <summary class="hover:bg-indigo-600 hover:text-white focus:bg-indigo-700">Аккаунт</summary>
                                    <ul class="p-2 bg-indigo-950 rounded-t-none min-w-40">
                                        <li><a href="?page=login" class="hover:bg-indigo-900/80">Вход</a></li>
                                        <li><a href="?page=register" class="hover:bg-indigo-900/80">Регистрация</a></li>
                                    </ul>
                                </details>
                            <?php } else { ?>
                                <details>
                                    <summary class="hover:bg-indigo-600 hover:text-white focus:bg-indigo-700">
                                        <?= $_SESSION['username'] ?>
                                    </summary>
                                    <ul class="p-2 bg-indigo-950 rounded-t-none min-w-40">
                                        <li><a href="?page=account" class="hover:bg-indigo-900/80">Кабинет</a></li>
                                        <?php if ($user_rank >= 1) { ?>
                                            <li><a href="/admin" class="hover:bg-indigo-900/80">Админ</a></li>
                                        <?php } ?>
                                        <li><a href="?page=logout" class="hover:bg-indigo-900/80">Выход</a></li>
                                    </ul>
                                </details>
                            <?php } ?>
                        </li>
                        <li>
                            <a href="" class="bg-cyan-600 hover:bg-cyan-700 text-white mx-2">О сервере</a>
                        </li>
                        <li>
                            <a href="?page=howtoplay" class="bg-rose-700 hover:bg-rose-900 text-white mx-2">Как начать играть?</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>