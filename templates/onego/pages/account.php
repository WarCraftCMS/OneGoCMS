<?php
$global->check_logged_in();
$account = new Account($_SESSION['username']);
if (isset($_POST['change_password'])) 
{
   header("Location: ?page=changepassword");
   exit();
}
?>

    <div class="hero min-h-screen hero11">
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="hero-content text-center text-neutral-content w-full">
        <div class="container">
            <div class="max-w-full mt-36 2xl:pt-0">
                <h1 class="mb-5 text-4xl font-bold text-white text-shadow_dark">
                    <?= $translations['account_control_panel'] ?>
                </h1>
                <div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">


                    <div>
                        <div role="alert" class="alert shadow-lg bg-slate-950/40">
                            <div>
                                <h3 class="font-bold"><?= $translations['account_information'] ?></h3>
                                <div class="text-xs">
                                    <p class="sm:inline">
                                    <div class="sm:ml-2 block sm:inline-block">
                                        <span class="font-bold"><?= $translations['username'] ?>:</span>
                                       <?= $account->get_username(); ?></div>
                                    <div class="sm:ml-2 block md:inline-block">
                                        <span class="font-bold"><?= $translations['e_mail'] ?>:</span>
                                        <?= $account->get_email(); ?>                                    </div>
                                    <div class="sm:ml-2 block md:inline-block">
                                        <span class="font-bold"><?= $translations['registration'] ?>:</span>
                                        <?= $account->get_joindate(); ?>                                    </div>
                                    <div class="sm:ml-2 block md:inline-block">
                                        <span class="font-bold"><?= $translations['last_login'] ?>:</span>
                                        <?= $account->get_last_login(); ?>                                    </div>
                                    <div class="sm:ml-2 block md:inline-block">
                                        <span class="font-bold"><?= $translations['donor_coins'] ?>:</span>
                                        <span class="text-yellow-500"><?= $account->get_account_currency()['donor_points'] ?></span>
                                    </div>
                                    <div class="sm:ml-2 block md:inline-block">
                                        <span class="font-bold"><?= $translations['voting_coins'] ?>:</span>
                                        <span class="text-blue-300"><?= $account->get_account_currency()['vote_points'] ?></span>
                                    </div>
                                    <div class="sm:ml-2 block md:inline-block">
                                        <span class="font-bold"><?= $translations['premium'] ?>:</span>
                                        <span class="text-purple-400"><?= $translations['no'] ?></span>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <a href="?page=changepassword">
                                <div
                                    class="card card-side bg-slate-950/40 border hover:bg-slate-950 border-slate-950 h-full transition duration-300">
                                    <figure class="p-5">
                                        <img src="<?= $template_path ?>images/icon_image1.webp"
                                            class="mask mask-hexagon max-h-32 max-w-32" />
                                    </figure>
                                    <div class="card-body">
                                        <h2 class="card-title text-teal-400"><?= $translations['account_management'] ?></h2>
                                        <p class="text-gray-300 text-sm"><?= $translations['account_management_info'] ?></p>
                                    </div>
                                </div>
                            </a>
                            <a href="?page=characters">
                                <div
                                    class="card card-side bg-slate-950/40 border hover:bg-slate-950 border-slate-950 h-full transition duration-300">
                                    <figure class="p-5">
                                        <img src="<?= $template_path ?>images/icon_image2.webp"
                                            class="mask mask-hexagon max-h-32 max-w-32" />
                                    </figure>
                                    <div class="card-body">
                                        <h2 class="card-title text-teal-400">
                                            <?= $translations['character_management'] ?>
                                        </h2>
                                        <p class="text-gray-300 text-sm"><?= $translations['character_management_info'] ?></p>
                                    </div>
                                </div>
                            </a>
                            <a href="?page=vote">
                                <div
                                    class="card card-side bg-slate-950/40 border hover:bg-slate-950 border-slate-950 h-full transition duration-300">
                                    <figure class="p-5">
                                        <img src="<?= $template_path ?>images/icon_image3.webp"
                                            class="mask mask-hexagon max-h-32 max-w-32" />
                                    </figure>
                                    <div class="card-body">
                                        <h2 class="card-title text-teal-400"><?= $translations['vote_for_us'] ?></h2>
                                        <p class="text-gray-300 text-sm"><?= $translations['vote_for_us_info'] ?></p>
                                    </div>
                                </div>
                            </a>
                            <a href="?page=store">
                                <div
                                    class="card card-side bg-slate-950/40 border hover:bg-slate-950 border-slate-950 h-full transition duration-300">
                                    <figure class="p-5">
                                        <img src="<?= $template_path ?>images/icon_image4.webp"
                                            class="mask mask-hexagon max-h-32 max-w-32" />
                                    </figure>
                                    <div class="card-body">
                                        <h2 class="card-title text-teal-400">
                                            <?= $translations['shop'] ?>
                                        </h2>
                                        <p class="text-gray-300 text-sm">
                                            <?= $translations['shop_info'] ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <a href="?page=fortune">
                                <div
                                    class="card card-side bg-slate-950/40 border hover:bg-slate-950 border-slate-950 h-full transition duration-300">
                                    <figure class="p-5">
                                        <img src="<?= $template_path ?>images/icon_image6.webp"
                                            class="mask mask-hexagon max-h-32 max-w-32" />
                                    </figure>
                                    <div class="card-body">
                                        <h2 class="card-title text-teal-400">
                                            
                                            <?= $translations['fortune'] ?>
                                        </h2>
                                        <p class="text-gray-300 text-sm">
                                            <?= $translations['fortune_info'] ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <a href="?page=bag">
                                <div
                                    class="card card-side bg-slate-950/40 border hover:bg-slate-950 border-slate-950 h-full transition duration-300">
                                    <figure class="p-5">
                                        <img src="<?= $template_path ?>images/icon_image5.webp"
                                            class="mask mask-hexagon max-h-32 max-w-32" />
                                    </figure>
                                    <div class="card-body">
                                        <h2 class="card-title text-teal-400">
                                            
                                            <?= $translations['bag'] ?>
                                        </h2>
                                        <p class="text-gray-300 text-sm"><?= $translations['bag_info'] ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <div class="divider"></div>
                            <div class="mt-4 mx-auto text-center">
                                <a href="?page=logout"
                                    class="btn bg-red-800 hover:bg-red-600 text-white">
                                    <?= $translations['logout'] ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>