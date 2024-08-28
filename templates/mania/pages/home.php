<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<?php
   if (isset($_SESSION['success_message'])) {
       echo '<div class="text-center">';
       echo '<div class="alert alert-dismissible alert-success">';
       echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
       echo '<strong>Well done!</strong> ' . $_SESSION['success_message'] . '';
       echo '</div>';
       echo '</div>';
       unset($_SESSION['success_message']);
   }
   
   if (isset($_SESSION['error'])) {
       echo '<div class="text-center">';
       echo '<div class="alert alert-dismissible alert-danger">';
       echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
       echo '<strong>Hey there!</strong> ' . $_SESSION['error'] . '';
       echo '</div>';
       echo '</div>';
       unset($_SESSION['error']);
   }
   
   if (isset($_SESSION['username'])) {
       $account = new Account($_SESSION['username']);
   }
   
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       $username = $_POST['username'];
       $password = $_POST['password'];
   
       $login = new Login($username, $password);
       $login->login_checks();
       $login->login();
   }
   
   $config = new Configuration();
   $newsHome = new news_home();
   $latestNews = $newsHome->get_news();
   $server = new ServerInfo();
   ?>


    <div class="content flex-sbs">
        <div class="home-description" style="width: 100%;">
            <div style="cursor: url('images/sword.png'),default;">

<p>Добро пожаловать на <font color="orange">WOWGG.ORG</font>!<br>
<br>
Это Лучший СОЛО Cервер WoW 3.3.5a<br>
Ведь только на нашем сервере:<br>
- Игрок может проходить подземелья и рейды сам!<br><br>
- КД и АП уменьшены до 5 дней.<br>
- Запуск БГ при наличии 4 игроков.<br>
- Трансмогрификация с коллекцией.<br>
- Все перелеты открыты и они мгновенны.<br>
- Межфракционные БГ, Аукцион и Каналы чата.<br>
<br>
Наш реалмлист: <font color="yellow">set realmlist logon.wowgg.org</font><br>
Либо замените файл по пути "Папка игры\Data\ruRU" на <a href="uploads/files/realmlist.wtf"><font color="grey">realmlist.wtf</font></a>
</p>

<p>
Бонусы для игроков:<br>
-за каждый голос на mmotop 5 GGP<br>
(бонусы начисляются 1 раз в сутки в 00:00)<br>
<!-- -золото за повышение уровня до: 10,20,30,40,50,60,70,80.<br /> -->
-при пожертвовании проекту от 1000р вы получите случайный бонус 100-1000 GGP</p>
            </div>
        </div>
                <div class="home-news flex-sbs">
                    <?php
            $newsHome = new news_home();
            $newsList = $newsHome->get_news();
            
            $count = 0;
            
            foreach ($newsList as $news) :
               if ($count % 3 === 0) {
                  echo '';
               }
            ?>

                <article>
                    <div class="img flex-es"><img src="<?= $news['thumbnail'] ?>" alt="<?= $news['title'] ?>"></div>
                    <div class="date flex-cs"><?= $news['date'] ?></div>
                    <div class="info">
                        <div class="title"><a href="<?= $news['url'] ?>"><?= $news['title'] ?></a></div>
                        <div class="text"><?= $news['content'] ?></div>
                        <a class="more-btn" href="<?= $news['url'] ?>">ПОДРОБНЕЕ</a>
                    </div>
                </article>
   
         <?php
            $count++;
            if ($count % 3 === 0) {
               echo '';
            }
            endforeach;
            
            if ($count % 3 !== 0) {
               echo '';
            }
            ?>  

                    <a class="show-more-btn" href="/?page=news">БОЛЬШЕ НОВОСТЕЙ</a>
                </div>
        <aside class="flex-sbs">
            <div class="rankings">
                <div class="switch flex-sbc">
                    <div class="button flex-cc rank-switch-btn active" data-view-table="ranking"><span>ДОЛГОЖИТЕЛИ</span></div>
                    <div class="button flex-cc rank-switch-btn" data-view-table="voters"><span>БОГАЧИ</span></div>
                </div>
                <div class="tables">
                    <div class="table flex-sbs rank-switch-table active" data-id-table="ranking">
<?php
$dsn = "mysql:host=$db_host;dbname=$db_characters;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_username, $db_password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$sql = "
SELECT 
    p.name,
    p.totaltime, -- Fetching totaltime directly
    IF(p.race IN (1, 3, 4, 7, 11), 'Альянс', 'Орда') AS faction
FROM characters AS p
LEFT JOIN guild_member AS gm ON gm.guid = p.guid
LEFT JOIN guild AS g ON g.guildid = gm.guildid
ORDER BY p.totaltime DESC
LIMIT 10
";

$stmt = $pdo->query($sql);
$rank = 1;
while ($row = $stmt->fetch()) {
    $totalSeconds = $row['totaltime'];
    $totalDays = floor($totalSeconds / 86400);
    $totalHours = floor(($totalSeconds % 86400) / 3600);
    $totalMinutes = floor((($totalSeconds % 86400) % 3600) / 60);

    echo '<div class="line flex-sc">';
    echo '<div class="num flex-cc">'. $rank++ .'</div>';
    echo '<div class="name">'. htmlspecialchars($row['name']) .'</div>';
    echo '<div class="val">'. $totalDays .' дней</div>';
    echo '</div>';
}
?>
                    </div>
                    <div class="table flex-sbs rank-switch-table" data-id-table="voters">
                                                        <?php
// Establish PDO connection
$dsn = "mysql:host=$db_host;dbname=$db_characters;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_username, $db_password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Query to retrieve the top 10 players by PvP kills
$sql = "
SELECT 
    p.name,
    p.money / 10000 AS gold, -- Convert copper to gold
    IF(p.race IN (1, 3, 4, 7, 11), 'Альянс', 'Орда') AS faction
FROM characters AS p
LEFT JOIN guild_member AS gm ON gm.guid = p.guid
LEFT JOIN guild AS g ON g.guildid = gm.guildid
ORDER BY p.money DESC
LIMIT 10
";

// Execute the query
$stmt = $pdo->query($sql);
    // Внутри этой части PHP скрипт ответственен за создание строк таблицы
    $rank = 1;
    while ($row = $stmt->fetch()) {
        echo '<div class="line flex-sc">';
        echo '<div class="num flex-cc">'. $rank++ .'</div>';
        echo '<div class="name">'. htmlspecialchars($row['name']) .'</div>';
        echo '<div class="val">'. number_format($row['gold'], 2) .'</div>';
        echo '</div>';
    }
    ?>

                    </div>
                </div>
            </div>

        <div class="discord-block" style="width: 100%; height: 369px; margin-top: 31px;">
            <iframe src="https://discord.com/widget?id=1266687617576206398&theme=dark" width="100%" height="100%" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
        </div>

            <!--
            <div class="forum-msg">
                <div class="title">Сообщения с Форума</div>
                <div class="messages flex-sbs">
                        <div class="msg flex-cc">
                            <div class="avatar flex-cc"><img src="frontend\web\images\default.jpg" alt="XARTIEX"></div>
                            <div class="info">
                                <div class="title"><a target="_blank" href="#">Скоро!</a></div>
                                <div class="desc flex-sc">
                                    <span class="date flex-cc"><i class="fa fa-calendar" aria-hidden="true"></i>Янв, 01, 2020</span>
                                    <span class="user">by <a target="_blank" href="#">admin</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="msg flex-cc">
                            <div class="avatar flex-cc"><img src="frontend\web\images\default.jpg" alt="STEFAN9DUTOIT"></div>
                            <div class="info">
                                <div class="title"><a target="_blank" href="#">Скоро!</a></div>
                                <div class="desc flex-sc">
                                    <span class="date flex-cc"><i class="fa fa-calendar" aria-hidden="true"></i>Янв, 01, 2020</span>
                                    <span class="user">by <a target="_blank" href="#">admin</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="msg flex-cc">
                            <div class="avatar flex-cc"><img src="frontend\web\images\default.jpg" alt="lemahieu23"></div>
                            <div class="info">
                                <div class="title"><a target="_blank" href="#">Скоро!</a></div>
                                <div class="desc flex-sc">
                                    <span class="date flex-cc"><i class="fa fa-calendar" aria-hidden="true"></i>Янв, 01, 2020</span>
                                    <span class="user">by <a target="_blank" href="#">admin</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="msg flex-cc">
                            <div class="avatar flex-cc"><img src="frontend\web\images\default.jpg" alt="Tinydancer"></div>
                            <div class="info">
                                <div class="title"><a target="_blank" href="#">Скоро!</a></div>
                                <div class="desc flex-sc">
                                    <span class="date flex-cc"><i class="fa fa-calendar" aria-hidden="true"></i>Янв, 01, 2020</span>
                                    <span class="user">by <a target="_blank" href="#">admin</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="msg flex-cc">
                            <div class="avatar flex-cc"><img src="frontend\web\images\default.jpg" alt="noam"></div>
                            <div class="info">
                                <div class="title"><a target="_blank" href="#">Скоро!</a></div>
                                <div class="desc flex-sc">
                                    <span class="date flex-cc"><i class="fa fa-calendar" aria-hidden="true"></i>Янв, 01, 2020</span>
                                    <span class="user">by <a target="_blank" href="#">admin</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="msg flex-cc">
                            <div class="avatar flex-cc"><img src="frontend\web\images\default.jpg" alt="JudgeJessieW"></div>
                            <div class="info">
                                <div class="title"><a target="_blank" href="#">Скоро!</a></div>
                                <div class="desc flex-sc">
                                    <span class="date flex-cc"><i class="fa fa-calendar" aria-hidden="true"></i>Янв, 01, 2020</span>
                                    <span class="user">by <a target="_blank" href="#">admin</a></span>
                                </div>
                            </div>
                        </div>
                </div>
                <a href="#" target="_blank" class="show-more-btn">ПЕРЕЙТИ НА ФОРУМ</a>
            </div>
            -->
        </aside>
    </div>



<div class="popup_bg"></div>

<div class="popup popup_success" data-popup-name="success">
    <div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
    <div class="text"><br><br></div>
</div>

<div class="popup popup_critical_error" data-popup-name="error">
    <div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
    <div class="text"><br><br></div>
</div>