<?php
require_once("functions/install.php");
$install = new InstallOneGoCMS();

if (isset($_POST['install'])) {
    $install->install($_POST['web_title'], $_POST['realmlist'], $_POST['db_host'], $_POST['db_port'], $_POST['db_gameport'], $_POST['db_username'], $_POST['db_password'], $_POST['db_auth'], $_POST['db_characters'], $_POST['db_website'], $_POST['soap_url'], $_POST['soap_uri'], $_POST['soap_username'], $_POST['soap_password']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OneGoCMS Install</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
    <link rel='stylesheet' href='https://unpkg.com/swiper/swiper-bundle.min.css'>
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            background: #212121;
            margin: 0;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .swiper-container {
            position: relative;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .content {
            position: relative;
            z-index: 1;
            max-width: 400px; /* Уменьшен размер формы */
            padding: 20px; /* Уменьшены отступы */
            background: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        }
        h1, h4 {
            color: #f1f1f1;
        }
        .form-group {
            margin-bottom: 1px; /* Уменьшено расстояние между элементами формы */
        }
        .form-control {
            width: 100%;
            padding: 10px; /* Уменьшен внутренний отступ */
            border: none;
            border-radius: 8px;
            background: #333;
            color: white;
            font-size: 0.9rem; /* Уменьшен размер шрифта */
            transition: background 0.3s;
        }
        .form-control:focus {
            outline: none;
            background: #444;
        }
        .btn {
            padding: 10px 15px; /* Уменьшены отступы кнопки */
            border: none;
            border-radius: 8px;
            background: #007bff;
            color: white;
            font-size: 0.9rem; /* Уменьшен размер шрифта кнопки */
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #0056b3;
        }
        .footer {
            position: relative;
            padding: 10px; /* Уменьшены отступы нижнего колонтитула */
            background-color: rgba(0, 0, 0, 0.7);
            text-align: center;
            margin-top: auto;
        }
    </style>
</head>

<body>
    <div class="swiper-container">
        <video class="video-background" autoplay muted loop>
            <source src="./bg.mp4" type="video/mp4">
        </video>
        <div class="footer">
            <form action="" method="post" class="mt-4">
                <h4>Server name</h4>
                <div class="form-group">
                    <input type="text" class="form-control" name="web_title" placeholder="Title" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="realmlist" placeholder="logon.server.com" required>
                </div>
                <h4>MySQL Information</h4>
                <div class="form-group">
                    <input type="text" class="form-control" name="db_host" placeholder="Database Host: 127.0.0.1" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="db_username" placeholder="Database Username: root" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="db_password" placeholder="Database Password: ascent" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="db_port" placeholder="Database Port: 3306" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="db_gameport" placeholder="Game Port: 8085" required>
                </div>
                <h4>Database Information</h4>
                <div class="form-group">
                    <input type="text" class="form-control" name="db_auth" placeholder="Auth Database: auth" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="db_characters" placeholder="Characters Database: characters" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="db_website" placeholder="Website Database: website" required>
                </div>
                <h4>SOAP</h4>
                <small>This data will be used by SOAP to send items purchased from the store.</small>
                <div class="form-group">
                    <input type="text" class="form-control" name="soap_url" placeholder="127.0.0.1:7878" required>
                </div>
                <small>AC, TC and others..</small>
                <div class="form-group">
                    <input type="text" class="form-control" name="soap_uri" placeholder="AC" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="soap_username" placeholder="GM Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="soap_password" placeholder="GM Password" required>
                </div>
                <center>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" name="install">Install OneGoCMS</button>
                    </div>
                </center>
            </form>
        </div>
    </div>

    <script src='https://unpkg.com/swiper/swiper-bundle.min.js'></script>
    <script src="./script.js"></script>
</body>
</html>
