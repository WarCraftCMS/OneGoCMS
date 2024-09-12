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

 

    <div class="hero min-h-screen hero1">
         <div class="video-header">
        <video autoplay loop muted class="video-header__player">
            <source src="<?= $template_path ?>images/video/lich.webm" type="video/mp4">
            <source src="<?= $template_path ?>images/video/lich.webm" type="video/webm">
        </video>
    </div>
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="home-welcome">
                    <div class="home-welcome-join">
                        <span></span>
                        <span>
                            <span><?= $translations['content1'] ?></span>
                            <span><?= $translations['content1'] ?></span>
                        </span>
                        <span>
                            <?= $translations['content2'] ?>
                        </span>


                                            </div>

                    <div></div>

<div class="home-welcome-realms">
    <div class="">
        <div>
<span><span><?= $server->get_realm_name(); ?></span></span>
<span>
    <span>UPTIME</span>
                <?php 
                $uptime_info = $server->get_uptime(); 
                if ($uptime_info) {
                    echo "<span>" . htmlspecialchars($uptime_info['uptime']) . "</span>";
                } else {
                    echo "<span>Неизвестно</span>";
                }
                ?>
</span>
        </div>
        <div>
            <span><?= $server->get_online_players(); ?></span>
            <span><?= $server->get_status_server(); ?></span>
        </div>
        
        <?php 
        $factionPercentages = $server->get_online_faction_percentages();
        ?>
        
        <div>
            <span class=""></span>
            <span><?php echo $factionPercentages['alliance_percentage']; ?>%</span>
            <span></span>
            <span><?php echo $factionPercentages['horde_percentage']; ?>%</span>
            <span class=""></span>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
  <!-- <div class="container-news">
        <div class="home-last-news">


<?php
            $newsHome = new news_home();
            $newsList = $newsHome->get_news();
            
            $count = 0;
            
            foreach ($newsList as $news) :
               if ($count % 3 === 0) {
                  echo '';
               }
            ?>
        <a href="<?= $news['url'] ?>" class="last-news-item" style="background-image: url('<?= $news['thumbnail'] ?>');">   
           <span class="date"><?= $news['date'] ?></span>
            <span class="title"><?= $news['title'] ?></span>
                </a>
                
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
    </div>-->

            </div>

<div class="border-t border-b border-indigo-800 bg-indigo-950">
    <div class="container mx-auto py-10">
        <div class="md:flex mx-auto">
            <div class="w-full md:w-2/3 mt-3 text-center px-4 text-white text-shadow_dark">
                <?= $translations['content3'] ?>
            </div>
            <div class="w-full mt-4 md:mt-0 md:w-1/3 text-center">
                <a target="_blank" href=""
                    class="btn bg-blue-900 hover:bg-blue-700 text-white">
                    <?= $translations['join_discord'] ?>
                </a>
                <a target="_blank" href=""
                    class="btn md:mt-2 bg-fuchsia-800 hover:bg-fuchsia-600 text-white">
                    <?= $translations['instagram'] ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="hero hero2 min-h-full bg-[#080B10] border-b border-purple-950">
    <div class="hero-overlay bg-opacity-20"></div>
    <div class="hero-content text-center text-neutral-content max-w-full">
        <div class="grid grid-cols-1 gap-3 md:gap-2 lg:gap-3 lg:grid-cols-2">


        </div>
    </div>
</div>

<div class="hero hero3 min-h-full bg-[#080B10]">
    <div class="hero-overlay" style="background-color: rgba(13, 9, 31, 0.9)"></div>
    <div class="hero-content text-center min-w-full">
        <div class="container mx-auto">
            <div class="">
                <div class="w-full lg:w-4/6 mx-auto">
                    <div role="tablist" class="tabs tabs-lifted">
                        <input type="radio" name="my_tabs_2" role="tab" class="tab text-xs sm:text-md"
                            aria-label="<?= $translations['online_players'] ?>" checked />
                        <div role="tabpanel" class="tab-content bg-indigo-800/15 rounded-box p-6">
                            <div class="overflow-x-scroll">
                                <table class="table-auto sm:table mx-auto">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-white">№</th>
                                            <th class="text-center text-white"><?= $translations['name'] ?></th>
                                            <th class="text-center text-white sm:block hidden"></th>
                                            <th class="text-center text-white"><?= $translations['level'] ?></th>
                                            <th class="text-center text-white"><?= $translations['guild'] ?></th>
                                            <th class="text-center text-white"><?= $translations['rank'] ?></th>
                                            <th class="text-center text-white"><?= $translations['location'] ?></th>
                                        </tr>
                                    </thead>
         <?php
                                    $onlineClass = new Online();
                                    $onlineCharacters = $onlineClass->get_online_characters();
                                    $rank = 1;
                                    if (!empty($onlineCharacters)) {
                                        foreach ($onlineCharacters as $character) {
                                    ?>
                                            <tr class="hover:bg-indigo-900/30">
                                                <td class="text-center text-white"><?= $rank++; ?></td>
                                                <td class="text-center text-white"><a href="?page=armory&charid=<?= $character['guid']; ?>" class="text-blue-500 hover:underline"><font color="<?= htmlspecialchars($character['class_color']); ?>"><?= htmlspecialchars($character['name']); ?></font></a></td>
                                                <td class="text-center text-white">
                                                <div class="tooltip" data-tip="<?= htmlspecialchars($character['faction_text']); ?> - <?= htmlspecialchars($character['class_name']); ?> - <?= htmlspecialchars($character['race_name']); ?>">
                                                    <img class="h-5 inline" src="<?= htmlspecialchars($character['faction']); ?>" />
                                                    <img class="h-5 inline" src="<?= htmlspecialchars($character['class_image']); ?>" />
                                                    <img class="h-5 inline" src="<?= htmlspecialchars($character['race_image']); ?>" />
                                                </div>
                                                </td>
                                                <td class="text-center text-white"><?= htmlspecialchars($character['level']); ?></td>
                                                <td class="text-center text-white"><?= htmlspecialchars($character['guild_name']); ?></td>
                                                <td class="text-center text-white"><?= htmlspecialchars($character['rank_title']); ?></td>
                                                <td class="text-center text-white"><?= htmlspecialchars($character['map_name']); ?></td>

                                            </tr>
                                    <?php
                                        }
                                    } else {
                                    ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-white"><?= $translations['no_online_players_found'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                        </div>

                        <input type="radio" name="my_tabs_2" role="tab" class="tab text-xs sm:text-md"
                            aria-label="<?= $translations['top_pvp'] ?>" />
                        <div role="tabpanel" class="tab-content bg-indigo-800/15 rounded-box p-6">
                            <div class="overflow-x-scroll">
                                <table class="table-auto sm:table mx-auto">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-white">№</th>
                                            <th class="text-center text-white"><?= $translations['name'] ?></th>
                                            <th class="text-center text-white sm:block hidden"></th>
                                            <th class="text-center text-white"><?= $translations['level'] ?></th>
                                            <th class="text-center text-white"><?= $translations['guild'] ?></th>
                                            <th class="text-center text-white"><?= $translations['kills'] ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php
                                    $topPlayers = new TopPlayers();
                                    $topCharacters = $topPlayers->get_top_killers(10);
                                    $rank = 1;
                                    if (!empty($topCharacters)) {
                                        foreach ($topCharacters as $character) {
                                    ?>
                                <tr class="hover:bg-indigo-900/30">
                                    <td class="text-center text-white"><?= $rank++; ?></td>
                                    <td class="text-center text-white"><a href="?page=armory&charid=<?= $character['guid']; ?>" class="text-blue-500 hover:underline"><font color="<?= htmlspecialchars($character['class_color']); ?>"><?= htmlspecialchars($character['name']); ?></font></a></td>
                                    <td class="text-center text-white">
                                    <div class="tooltip" data-tip="<?= htmlspecialchars($character['faction_text']); ?> - <?= htmlspecialchars($character['class_name']); ?> - <?= htmlspecialchars($character['race_name']); ?>">
                                        <img class="h-5 inline" src="<?= htmlspecialchars($character['faction']); ?>" />
                                        <img class="h-5 inline" src="<?= htmlspecialchars($character['class_image']); ?>" />
                                        <img class="h-5 inline" src="<?= htmlspecialchars($character['race_image']); ?>" />
                                    </div>
                                    </td>
                                        <td class="text-center text-white"><?= htmlspecialchars($character['level']); ?></td>
                                        <td class="text-center text-white"><?= htmlspecialchars($character['guild_name']); ?></td>
                                        <td class="text-center text-white"><?= htmlspecialchars($character['totalKills']); ?></td>
                                </tr>
<?php
    }
} else {
?>
    <tr>
        <td colspan="6" class="text-center text-white"><?= $translations['no_players_available'] ?></td>
    </tr>
<?php
}
?>
                                                                               
                                   </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function updateUptime() {
        $.ajax({
            url: 'get_uptime.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.status === 'success') {
                    $('#uptime-display').text(data.uptime);
                } else {
                    $('#uptime-display').text('Неизвестно');
                }
            },
            error: function() {
                $('#uptime-display').text('Ошибка получения данных');
            }
        });
    }

    $(document).ready(function() {
        updateUptime();
        setInterval(updateUptime, 1000);
    });
</script>