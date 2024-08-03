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
                            aria-label="Play time" checked />
                        <div role="tabpanel" class="tab-content bg-indigo-800/15 rounded-box p-6">
                            <div class="overflow-x-scroll">
                                <table class="table-auto sm:table mx-auto">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-white">Rank</th>
                                            <th class="text-center text-white">Name</th>
                                            <th class="text-center text-white sm:block hidden">Type</th>
                                            <th class="text-center text-white">Status</th>
                                            <th class="text-center text-white">Play Time</th>
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
                                            <td class="text-center text-cyan-200">
                                                232h                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">2</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-shaman">Si</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Orc - Shaman">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/orc_female.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/shaman.webp" />
                                                </div>

                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-cyan-200">
                                                204h                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">3</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Srbinlol</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Human - Paladin">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/human_male.webp" />
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
                                            <td class="text-center text-cyan-200">
                                                153h                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">4</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-rogue">Vallatrix</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Human - Rogue">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/human_female.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/rogue.webp" />
                                                </div>

                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-cyan-200">
                                                135h                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">5</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-warrior">Banjo</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Troll - Warrior">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/troll_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/warrior.webp" />
                                                </div>

                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-cyan-200">
                                                130h                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">6</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Rafus</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Blood Elf - Paladin">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/bloodelf_female.webp" />
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
                                            <td class="text-center text-cyan-200">
                                                125h                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">7</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Degen</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Blood Elf - Paladin">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/bloodelf_female.webp" />
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
                                            <td class="text-center text-cyan-200">
                                                117h                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">8</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-warrior">Gull</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Tauren - Warrior">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/tauren_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/warrior.webp" />
                                                </div>

                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-cyan-200">
                                                102h                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">9</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Gød</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Human - Paladin">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/human_male.webp" />
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
                                            <td class="text-center text-cyan-200">
                                                102h                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">10</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Vampire</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Blood Elf - Paladin">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/bloodelf_female.webp" />
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
                                            <td class="text-center text-cyan-200">
                                                101h                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                            </td>
                                        </tr>
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
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">2</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Gød</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Human - Paladin">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/human_male.webp" />
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
                                                184                                                <i class="fa-regular fa-thumbs-up ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">3</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Vampire</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Blood Elf - Paladin">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/bloodelf_female.webp" />
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
                                                179                                                <i class="fa-regular fa-thumbs-up ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">4</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-shaman">Si</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Orc - Shaman">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/orc_female.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/shaman.webp" />
                                                </div>

                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-purple-300">
                                                179                                                <i class="fa-regular fa-thumbs-up ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">5</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-warrior">Banjo</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Troll - Warrior">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/troll_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/warrior.webp" />
                                                </div>

                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-purple-300">
                                                155                                                <i class="fa-regular fa-thumbs-up ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">6</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Nohe</span>
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
                                                152                                                <i class="fa-regular fa-thumbs-up ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">7</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-rogue">Vallatrix</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Human - Rogue">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/human_female.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/rogue.webp" />
                                                </div>

                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-purple-300">
                                                135                                                <i class="fa-regular fa-thumbs-up ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">8</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-mage">Suhdude</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Undead - Mage">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/undead_female.webp" />
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
                                            <td class="text-center text-purple-300">
                                                134                                                <i class="fa-regular fa-thumbs-up ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">9</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-warlock">Guillermodot</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Troll - Warlock">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/troll_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/warlock.webp" />
                                                </div>

                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-purple-300">
                                                130                                                <i class="fa-regular fa-thumbs-up ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">10</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Jane</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Human - Paladin">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/human_female.webp" />
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
                                                118                                                <i class="fa-regular fa-thumbs-up ml-1.5"></i>
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
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">2</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-priest">Ok</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Undead - Priest">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/undead_female.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/priest.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-orange-300">
                                                21                                                <i class="fa-regular fa-swords ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">3</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-druid">Scärfäcë</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Undead - Druid">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/undead_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/druid.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-orange-300">
                                                13                                                <i class="fa-regular fa-swords ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">4</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-hunter">Headshot</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Troll - Hunter">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/troll_female.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/hunter.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-orange-300">
                                                10                                                <i class="fa-regular fa-swords ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">5</th>
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
                                            <td class="text-center text-orange-300">
                                                9                                                <i class="fa-regular fa-swords ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">6</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-rogue">Vallatrix</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Human - Rogue">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/human_female.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/rogue.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-orange-300">
                                                9                                                <i class="fa-regular fa-swords ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">7</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Gød</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Human - Paladin">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/human_male.webp" />
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
                                            <td class="text-center text-orange-300">
                                                7                                                <i class="fa-regular fa-swords ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">8</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Rafus</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Blood Elf - Paladin">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/bloodelf_female.webp" />
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
                                            <td class="text-center text-orange-300">
                                                7                                                <i class="fa-regular fa-swords ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">9</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-deathknight">Reimon</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Blood Elf - Death Knight">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/bloodelf_female.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/deathknight.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-orange-300">
                                                5                                                <i class="fa-regular fa-swords ml-1.5"></i>
                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">10</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-shaman">Glacyte</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Troll - Shaman">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/troll_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/shaman.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-orange-300">
                                                3                                                <i class="fa-regular fa-swords ml-1.5"></i>
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
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-sky-200 sm:block hidden">
                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                                7 minutes ago                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">2</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Najebyvvator</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Human - Paladin">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/human_male.webp" />
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
                                            <td class="text-center text-sky-200 sm:block hidden">
                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                                2 hours ago                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">3</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-deathknight">Pizgawica</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Human - Death Knight">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/human_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/deathknight.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-sky-200 sm:block hidden">
                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                                2 hours ago                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">4</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-warrior">Ragetas</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Orc - Warrior">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/orc_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/warrior.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-sky-200 sm:block hidden">
                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                                4 hours ago                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">5</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-warrior">Mdafacka</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Orc - Warrior">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/orc_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/warrior.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-sky-200 sm:block hidden">
                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                                7 hours ago                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">6</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-deathknight">Sffswg</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Human - Death Knight">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/human_female.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/deathknight.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-sky-200 sm:block hidden">
                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                                11 hours ago                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">7</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-paladin">Santygos</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Human - Paladin">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/human_male.webp" />
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
                                            <td class="text-center text-sky-200 sm:block hidden">
                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                                11 hours ago                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">8</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-warrior">Nibba</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Tauren - Warrior">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/tauren_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/warrior.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-sky-200 sm:block hidden">
                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                                13 hours ago                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">9</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-hunter">Biok</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Horde - Blood Elf - Hunter">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/horde.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/bloodelf_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/hunter.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-sky-200 sm:block hidden">
                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                                13 hours ago                                            </td>
                                        </tr>
                                                                                <tr class="hover:bg-indigo-900/30">
                                            <th class="text-center text-white">10</th>
                                            <td class="text-center">
                                                <span
                                                    class="text-white class-warrior">Ali</span>
                                            </td>
                                            <td class="text-center text-white sm:block hidden">
                                                <div class="tooltip"
                                                    data-tip="Alliance - Human - Warrior">
                                                    <img class="h-5 inline"
                                                        src="https://masterwow.net/images/factions/alliance.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/races/human_male.webp" />
                                                    <img class="h-5 inline rounded-full"
                                                        src="https://masterwow.net/images/classes/warrior.webp" />
                                                </div>
                                            </td>
                                            <td class="text-center text-white">
                                                                                                    <span class="badge bg-red-800">
                                                        <i class="fa-solid fa-wifi-slash sm:mr-2"></i>
                                                        <span class="hidden sm:block">Offline</span>
                                                    </span>
                                                                                                </td>
                                            <td class="text-center text-sky-200 sm:block hidden">
                                                <i class="fa-light fa-clock-eight ml-1.5"></i>
                                                14 hours ago                                            </td>
                                        </tr>
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