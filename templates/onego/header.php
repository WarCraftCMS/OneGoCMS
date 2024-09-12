<!DOCTYPE html>
<html class="bg-custom-dark1">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="enot" content="bc282825" />
    <link href="<?= $template_path ?>css/main.css" rel="stylesheet" />
    <link href="<?= $template_path ?>css/style.css" rel="stylesheet" />
    <link href="<?= $template_path ?>css/all.css" rel="stylesheet" />
    <link href="<?= $template_path ?>css/theme.css" rel="stylesheet" />
    <script src="https://www.google.com/recaptcha/api.js" ></script>
    <script src="../assets/js/all.js" ></script>
    <script src="<?= $template_path ?>js/test.js"></script>
    <title><?= $web_title ?></title>
	<style>
	.tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 100px;
  background-color: rgba(40, 40, 40, 0.8);
  border: 2px solid black;
  color: #b3b3cc;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;

  position: absolute;
  bottom: -10px; /* Adjust this value as needed */
  margin-left: -53px; /* Center align the tooltip */
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
	</style>
</head>
<body class="bg-custom-dark1">
    <div class="container mx-auto">
        <div class="container top-3 md:top-8 navbar bg-base-100 rounded-lg bg-indigo-950/90 z-auto">
            <div class="w-full hidden md:flex">
                <div class="flex-1">
                    <a href="/?page=home" class="btn btn-ghost hover:bg-indigo-900/50 text-xl text-white">
                        <img src="<?= $template_path ?>images/logo.png" alt="logo" class="h-10" />
                        <?= $web_title ?>
                    </a>
                </div>
                <div class="flex-none">
                    <ul class="menu menu-horizontal px-1">
                        <li>
                            <?php
                            if (!isset($_SESSION['username'])) { ?>
                                <details>
                                    <summary class="hover:bg-indigo-600 hover:text-white focus:bg-indigo-700"><?= $translations['account'] ?></summary>
                                    <ul class="p-2 bg-indigo-950 rounded-t-none min-w-40">
                                        <li><a href="?page=login" class="hover:bg-indigo-900/80"><?= $translations['login'] ?></a></li>
                                        <li><a href="?page=register" class="hover:bg-indigo-900/80"><?= $translations['register'] ?></a></li>
                                    </ul>
                                </details>
                            <?php } else { ?>
                                <details>
                                    <summary class="hover:bg-indigo-600 hover:text-white focus:bg-indigo-700">
                                        <?= $_SESSION['username'] ?>
                                    </summary>
                                    <ul class="p-2 bg-indigo-950 rounded-t-none min-w-40">
                                        <li><a href="?page=account" class="hover:bg-indigo-900/80"><?= $translations['dashboard'] ?></a></li>
                                        <?php if ($user_rank >= 1) { ?>
                                            <li><a href="/admin" class="hover:bg-indigo-900/80"><?= $translations['admin'] ?></a></li>
                                        <?php } ?>
                                        <li><a href="?page=logout" class="hover:bg-indigo-900/80"><?= $translations['logout'] ?></a></li>
                                    </ul>
                                </details>
                            <?php } ?>
                        </li>
                        <li>
                            <a href="" class="bg-cyan-600 hover:bg-cyan-700 text-white mx-2"><?= $translations['about_server'] ?></a>
                        </li>
                        <li>
                            <a href="?page=howtoplay" class="bg-rose-700 hover:bg-rose-900 text-white mx-2"><?= $translations['how_to_play'] ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>