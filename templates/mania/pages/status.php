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

    <div class="content inner-content">
        <div class="inner-title flex-cc">СТАТУС СЕРВЕРА</div>
	
        <style>
            .realm-tabs {
                display: flex;
                justify-content: flex-start;
                align-items: center;
                border-bottom: solid 1px #112b47;
            }
            .realm-tabs > .blue-button {
                width: unset !important;
                padding: 0 30px !important;
                background: unset !important;
                color: #7b8fad !important;
            }
            .realm-tabs > .blue-button.active {
                color: #dce9fc !important;
            }
        </style>
        <div class="stat-server">
            <div class="block flex-sc">
                <span class="name"><?= $server->get_realm_name(); ?></span>
                <div class="statistic">
                    <div class="online">Авторизация:<span style="color: #4cb300"> <?= $server->get_status_server(); ?></span></div>
                    <!--<div class="online">Игровой Мир:<span style="color: #4cb300"> online</span></div>-->
                </div>
                <div class="stat-block">Игроков онлайн: <span><?= $server->get_online_players(); ?></span></div>
                <!--<div class="stat-block max">Макс. онлайн: <span>214</span></div>-->
                <div class="progress_bg">

        <?php 
        $factionPercentages = $server->get_online_faction_percentages();
        ?>
        
                    <div class="percent alliance"><span><?php echo $factionPercentages['alliance_percentage']; ?></span>%<img src="<?= $template_path ?>images\icon\alliance.png" alt=""></div>
                    <div class="progress"><div class="bar" style="width: 5%;"></div></div>
                    <div class="percent orda"><img src="<?= $template_path ?>images\icon\orda.png" alt=""><span><?php echo $factionPercentages['horde_percentage']; ?></span>%</div>
                </div>
            </div>
        </div>
        <div class="server_more_info">
            <div class="block">
                <!--
                <div class="line">
                    <div class="text">Server Time:</div>
                    <div class="text">24/08/2024 18:01:15</div>
                </div>
				-->
                <div class="line">
                    <div class="text">GM Online:</div>
                    <div class="text"><?php
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_characters;charset=$charset", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT c.name 
                           FROM characters c 
                           INNER JOIN acore_auth.account_access a ON a.id = c.account 
                           WHERE a.gmlevel != 0 AND c.online = 1");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $onlineAdmins = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $onlineAdmins[] = $row['name'];
        }

        $adminsList = implode(', ', $onlineAdmins);
        echo "<tr>";
        echo "<td><b>{$adminsList}</b></td>";
        echo "</tr>";
    } else {
        echo "<tr><td colspan='4' align='center'>Нет гм, вошедших в игру</td></tr>";
    }
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}
?></div>
                </div>
                <!--
                <div class="line">
                    <div class="text">Open Tickets:</div>
                    <div class="text">0</div>
                </div>
				-->
            </div>
            <div class="block">
                <div class="line">
                    <div class="text">Uptime:</div>
                    <div class="text">        <?php 
        $uptime_info = $server->get_uptime(); 
        echo $uptime_info ? htmlspecialchars($uptime_info['uptime']) : 'Неизвестно';
        ?></div>
                </div>
				<!--
                <div class="line">
                    <div class="text">Diff:</div>
                    <div class="text">55 ms</div>
                </div>
                <div class="line">
                    <div class="text">Average diff:</div>
                    <div class="text">28 ms</div>
                </div>
				-->
            </div>
            <div class="block">
                <!--
                <div class="line">
                    <div class="text">Uptime Ratio:</div>
                    <div class="text">99.59%</div>
                </div>
				
                <div class="line">
                    <div class="text">Total uptime:</div>
                    <div class="text">2020.11 days</div>
                </div>
                <div class="line">
                    <div class="text">Age:</div>
                    <div class="text">5 years 203 days</div>
                </div>
				-->
            </div>
        </div>
        <div class="stat-more-info flex-sbs">
            <div class="server_structure feature">
                <div class="title">ОСОБЕННОСТИ РЕАЛМА:</div>
                <div class="table">
					<div class="tr">
						<div class="td"><img src="<?= $template_path ?>images/check.png"></div>
						<div class="td">Игрок может проходить подземелья и рейды сам!</div>
					</div>
					<div class="tr">
						<div class="td"><img src="<?= $template_path ?>images/check.png"></div>
						<div class="td">КД и АП уменьшены до 5 дней.</div>
					</div>
					<div class="tr">
						<div class="td"><img src="<?= $template_path ?>images/check.png"></div>
						<div class="td">Запуск БГ при наличии 4 игроков.</div>
					</div>
					<div class="tr">
						<div class="td"><img src="<?= $template_path ?>images/check.png"></div>
						<div class="td">Трансмогрификация с коллекцией.</div>
					</div>
					<div class="tr">
						<div class="td"><img src="<?= $template_path ?>images/check.png"></div>
						<div class="td">Все перелеты открыты и они мгновенны.</div>
					</div>
					<div class="tr">
						<div class="td"><img src="<?= $template_path ?>images/check.png"></div>
						<div class="td">Межфракционные БГ, Аукцион и Каналы чата.</div>
					</div>
                </div>
            </div>
        </div>
	</div>