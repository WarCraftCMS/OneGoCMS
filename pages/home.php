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
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="container">
            <div class="max-w-4xl pt-40 2xl:pt-0">
                <h1 class="mb-5 text-4xl font-bold text-white text-shadow_dark">
                    Добро пожаловать на OneGoCMS
                </h1>
                <p class="mb-5 text-white bg-slate-950/20 p-9 rounded-lg text-shadow_dark">
                    Бесплатная русская CMS плфторма для игровых серверов World Of Warcraft
                </p>         
            </div>

        </div>

            </div>
            </div>



<div class="hero hero2 min-h-full bg-[#080B10] border-b border-purple-950">
    <div class="hero-overlay bg-opacity-20"></div>
    <div class="hero-content text-center text-neutral-content max-w-full">
        <div class="grid grid-cols-1 gap-3 md:gap-2 lg:gap-3 lg:grid-cols-2">
            <div class="news">
<?php
            $newsHome = new news_home();
            $newsList = $newsHome->get_news();
            
            $count = 0;
            
            foreach ($newsList as $news) :
               if ($count % 3 === 0) {
                  echo '';
               }
            ?>
            <a href="<?= $news['url'] ?>">
         <figure class="article">
               <?php if($news['thumbnail'] != null) : ?>
                <img src="<?= $news['thumbnail'] ?>" />
               <?php endif; ?>
               <figcaption>
                <h3><?= $news['title'] ?></h3>
                     <p><?= $news['content'] ?></p>
                     
            </figcaption>
        </figure>
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
            ?></div>

        </div>
    </div>
</div>

<div class="border-t border-b border-indigo-800 bg-indigo-950">
    <div class="container mx-auto py-10">
        <div class="md:flex mx-auto">
            <div class="w-full md:w-2/3 mt-3 text-center px-4 text-white text-shadow_dark">
                Присоединяйтесь к нашему серверу Discord и следите за нами, задавайте свои
                вопросы и общайтесь с сообществом. Мы рады, что вы
                присоединитесь к нам!
            </div>
            <div class="w-full mt-4 md:mt-0 md:w-1/3 text-center">
                <a target="_blank" href=""
                    class="btn bg-blue-900 hover:bg-blue-700 text-white">
                    Вступить в DISCORD
                </a>
                <a target="_blank" href=""
                    class="btn md:mt-2 bg-fuchsia-800 hover:bg-fuchsia-600 text-white">
                    Наш Instagram
                </a>
            </div>
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
                            aria-label="Онлайн Игроки" checked />
                        <div role="tabpanel" class="tab-content bg-indigo-800/15 rounded-box p-6">
                            <div class="overflow-x-scroll">
                                <table class="table-auto sm:table mx-auto">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-white">№</th>
                                            <th class="text-center text-white">Имя</th>
                                            <th class="text-center text-white sm:block hidden"></th>
                                            <th class="text-center text-white">Уровень</th>
                                            <th class="text-center text-white">Гильдия</th>
                                            <th class="text-center text-white">Ранг</th>
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
                                                <td class="text-center text-white"><font color="<?= htmlspecialchars($character['class_color']); ?>"><?= htmlspecialchars($character['name']); ?></font></td>
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
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                    ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-white">Онлайн-игроков не найдено.</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                        </div>

                        <input type="radio" name="my_tabs_2" role="tab" class="tab text-xs sm:text-md"
                            aria-label="Топ" />
                        <div role="tabpanel" class="tab-content bg-indigo-800/15 rounded-box p-6">
                            <div class="overflow-x-scroll">
                                <table class="table-auto sm:table mx-auto">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-white">№</th>
                                            <th class="text-center text-white">Имя</th>
                                            <th class="text-center text-white sm:block hidden"></th>
                                            <th class="text-center text-white">Уровень</th>
                                            <th class="text-center text-white">Гильдия</th>
                                            <th class="text-center text-white">Убийств</th>
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
                                    <td class="text-center text-white"><font color="<?= htmlspecialchars($character['class_color']); ?>"><?= htmlspecialchars($character['name']); ?></font></td>
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
        <td colspan="6" class="text-center text-white">Нет доступных игроков.</td>
    </tr>
<?php
}
?>
                                                                               
                                   </tbody>
                                </table>
                            </div>
                        </div>

                        <input type="radio" name="my_tabs_2" role="tab" class="tab text-xs sm:text-md"
                            aria-label="Пустое" />
                        <div role="tabpanel" class="tab-content bg-indigo-800/15 rounded-box p-6">
                            <div class="overflow-x-scroll">
                                <table class="table-auto sm:table mx-auto">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-white">Rank</th>
                                            <th class="text-center text-white">Name</th>
                                            <th class="text-center text-white sm:block hidden">Type</th>
                                            <th class="text-center text-white">Status</th>
                                            <th class="text-center text-white">Kills</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">1</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-mage">Mango</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Night Elf - Mage">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/nightelf_female.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/mage.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-orange-300">
                                                30                                                <i class="fa-regular fa-swords ml-1.5"></i>
                                            </td>
                                        </tr>
                                            
                                                                            </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="radio" name="my_tabs_2" role="tab" class="tab text-xs sm:text-md"
                            aria-label="Пустое" />
                        <div role="tabpanel" class="tab-content bg-indigo-800/15 rounded-box p-6">
                            <div class="overflow-x-scroll">
                                <table class="table-auto sm:table mx-auto">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-white">Rank</th>
                                            <th class="text-center text-white">Name</th>
                                            <th class="text-center text-white sm:block hidden">Type</th>
                                            <th class="text-center text-white">Status</th>
                                            <th class="text-center text-white sm:block hidden">Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">1</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-mage">Hammy</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Troll - Mage">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/troll_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/mage.webp" />
                                                </div>
                                            </td>
                                           
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