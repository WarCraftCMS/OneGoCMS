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

       <div class="content inner-content">




        <div class="inner-title flex-cc">НОВОСТИ</div>
        <div class="inner-news flex-sbs">

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
                    <div class="date flex-cs">21<span>Июл</span></div>
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




        </div>


    </div>