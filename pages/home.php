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
                    Welcome to MasterWoW Private Server
                </h1>
                <p class="mb-5 text-white bg-slate-950/20 p-9 rounded-lg text-shadow_dark">
                    Hello Champion, your premier destination for a unique World of
                    Warcraft experience. We're thrilled to have you here. Our private
                    server, based on the Haste Server, offers a wealth of custom
                    features and a vibrant community. We primarily focus on the WotLK
                    expansion but also incorporate a plethora of content from other
                    expansions, ensuring a diverse and engaging experience.
                </p>
                <p class="text-center mb-5">
                    <a href="" target="_blank">
                        <img src="assets/images/video.webp"
                            class="max-w-full rounded-lg w-64 mx-auto border-2 border-sky-900 opacity-30 hover:opacity-100 transition duration-300 ease-in-out" />
                    </a>
                </p>

                <p class="text-white mt-10">
                    Scroll down to learn more about our server!
                </p>
                <div class="w-5 mx-auto mt-5 animate-bounce">
                    <i class="fa-solid fa-chevrons-down text-4xl text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="border-t border-b border-indigo-800 bg-indigo-950">
    <div class="container mx-auto py-10">
        <div class="md:flex mx-auto">
            <div class="w-full md:w-2/3 mt-3 text-center px-4 text-white text-shadow_dark">
                Join our Discord server and follow us on Instagram, Ask your
                questions, and engage with the community. We're excited to have you
                join us!
            </div>
            <div class="w-full mt-4 md:mt-0 md:w-1/3 text-center">
                <a target="_blank" href=""
                    class="btn bg-blue-900 hover:bg-blue-700 text-white">
                    <i class="fa-brands fa-discord"></i>
                    JOIN DISCORD
                </a>
                <a target="_blank" href=""
                    class="btn md:mt-2 bg-fuchsia-800 hover:bg-fuchsia-600 text-white">
                    <i class="fa-brands fa-instagram"></i>
                    Follow us on Instagram
                </a>
            </div>
        </div>
    </div>
</div>

<div class="hero hero2 min-h-full bg-[#080B10] border-b border-purple-950">
    <div class="hero-overlay bg-opacity-20"></div>
    <div class="hero-content text-center text-neutral-content max-w-full">
        <div class="grid grid-cols-1 gap-3 md:gap-2 lg:gap-3 lg:grid-cols-2">
            <div class="card bg-base-100 shadow-xl image-full w-[32rem] max-w-full">
                <figure>
                    <img src="https://masterwow.net/images/b1.webp" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title text-white text-center mx-auto text-shadow_dark">
                        How to Connect
                    </h2>
                    <p class="text-white/80 text-shadow_dark">
                        Discover how to establish a connection, download our custom
                        patches, and utilize our launcher to access our server. Embark
                        on your adventure today!
                    </p>

                    <div class="card-actions justify-center">
                        <a href="https://masterwow.net/how-to-play"
                            class="btn text-shadow_dark bg-pink-600/40 hover:bg-pink-900 text-white">
                            Read Guide to Connect!
                        </a>
                        <a href="https://masterwow.net/sign-up"
                            class="btn text-shadow_dark bg-cyan-600/40 hover:bg-cyan-900 text-white">
                            Register Account
                        </a>
                    </div>
                </div>
            </div>
            <div class="card w-[32rem] bg-base-100 shadow-xl image-full max-w-full">
                <figure>
                    <img src="https://masterwow.net/images/b2.webp" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title text-white text-center mx-auto text-shadow_dark">
                        Account Control Panel
                    </h2>
                    <p class="text-white/80 text-shadow_dark">
                        Here you can manage your account, vote for the server, and
                        manage your characters.
                    </p>

                    <div class="card-actions justify-center">
                        <a href="https://masterwow.net/account-management"
                            class="btn text-shadow_dark bg-sky-600/40 hover:bg-sky-900 text-white">
                            Visit Account Panel
                        </a>
                    </div>
                </div>
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
                                            <th class="text-center text-white sm:block hidden">Type</th>
                                            <th class="text-center text-white">Уровень</th>
                                            <th class="text-center text-white">Гильдия</th>
                                            <th class="text-center text-white">Хонор</th>
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
                            aria-label="Votes" />
                        <div role="tabpanel" class="tab-content bg-indigo-800/15 rounded-box p-6">
                            <div class="overflow-x-scroll">
                                <table class="table-auto sm:table mx-auto">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-white">Rank</th>
                                            <th class="text-center text-white">Name</th>
                                            <th class="text-center text-white sm:block hidden">Type</th>
                                            <th class="text-center text-white">Status</th>
                                            <th class="text-center text-white">Votes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">1</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Ikki</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Blood Elf - Paladin">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/bloodelf_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/paladin.webp" />
                                                </div>

                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-purple-300">
                                                290                                                <i class="fa-regular fa-thumbs-up ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                               
                                                                            </tbody>
                                </table>
                            </div>
                        </div>

                        <input type="radio" name="my_tabs_2" role="tab" class="tab text-xs sm:text-md"
                            aria-label="Kills" />
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
                            aria-label="New Players" />
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