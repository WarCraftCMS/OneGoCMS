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
    <!-- HEADER -->
<header class="header">
        <div class="header__video-wrapp">
        <div class="header__video-box">
           <video class="header__video" autoplay loop muted>
              <source src="assets/images/bg.webm" type="video/webm">
          </video>
        </div>
    </div>
    <div class="content-area flex-сс">
        <div class="header__content flex-sbe">
            <!-- INFORMATION -->
            <div class="header__info">
                <!-- LOGO 
                <a href="#" class="header__logo flex-cc">
                    <img src="assets/images/logo.png" alt="logotype">
                </a>
                 END LOGO -->

                                                                                                                    
                                    <div class="header__info-title">Добро пожаловать
                        <span>на OneGo WoW!</span>
                    </div>
                    <a href="?page=register" class="header__link">
                        <span>Начать играть</span>
                    </a>
                
            </div>
            <!-- END INFORMATION -->

             <!-- SERVERS -->
            <div class="header__server">
             <div class="header__server-item-position">
                    <div class="header__server-item">
                        <div class="header__server-item-icon">
                            <img src="assets/images/tn1bZ9rL7z8g3W75oqTy7QMPhYeBEVkA8yfUkY3Y.png" alt="server icon">
                        </div>
                        <div class="header__server-item-description">
                     <div class="header__server-item-info">
                        <div class="header__server-item-name"><?= $server->get_realm_name(); ?> <span>x5</span></div>
                     <div class="header__server-item-text">в игре: <span><?= $server->get_online_players(); ?></span></div>
                     <div class="header__server-item-text">Статус: <span><?= $server->get_status_server(); ?></span></div>
                     <div class="header__server-item-text">ГМ в игре: <span><?php
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
?></span></div>
   
                   </div>
                </div>
                            </div>


   
                   </div>
                </div>
            <!-- END SERVERS -->

         <?php
            $newsHome = new news_home();
            $newsList = $newsHome->get_news();
            
            $count = 0;
            
            foreach ($newsList as $news) :
               if ($count % 3 === 0) {
                  echo '<div class="header__news">';
               }
            ?>
            <div class='header__news-item'>
                <div class='header__news-item-border'>
                    <img class='border-icon-top' src='assets/images/border-icon-top.png' alt='border icon top'>
                </div>
               <?php if($news['thumbnail'] != null) : ?>
                <a href='?page=news' target='_blank' class='header__news-item-img'>
                    <img src='<?= $news['thumbnail'] ?>' alt=''>
                </a>
               <?php endif; ?>
               <div class="header__news-item-date">
                    <?= $news['date'] ?>
               </div>
               <div class='header__news-item-title'>
                    <?= $news['title'] ?>
                </div>
                <br />
                <div class="header__news-item-text">
                    <?= $news['content'] ?>
                </div>

                </div>
                      
         <?php
            $count++;
            if ($count % 3 === 0) {
               echo '</div>';
            }
            endforeach;
            
            if ($count % 3 !== 0) {
               echo '';
            }
            ?>
      </div>
      <!-- Add pagination support -->
   </div>   </div>
</header>
<!-- END HEADER -->

    

        <section class="server-section">
    <div class="content-area flex-es">


    </div>
</section>
    
