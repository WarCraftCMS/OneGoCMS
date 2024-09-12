<?php
$global->check_logged_in();
$account = new Account($_SESSION['username']);
$character = new Character();

if (isset($_POST['change_password'])) {
    header("Location: ?page=changepassword");
    exit();
}

if (isset($_POST['unstick'])) {
    $guid = $_POST['guid'];
    if ($character->teleport_to_home($guid)) {
        echo "<script>alert('Персонаж успешно телепортирован домой!');</script>";
    } else {
        echo "<script>alert('Не удалось телепортировать персонажа.');</script>";
    }
}
?>
<div class="hero min-h-screen hero13">
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="container">
            <div class="max-w-full mt-36 2xl:pt-0">
                <h1 class="mb-5 text-4xl font-bold text-white text-shadow_dark">
                    <?= $translations['my_characters'] ?>
                </h1>
                <div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">
                    <div class="mt-2">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th class='text-center text-white'><?= $translations['username'] ?></th>
                                    <th class='text-center text-white'>  </th>
                                    <th class='text-center text-white'><?= $translations['level'] ?></th>
                                    <th class='text-center text-white'><?= $translations['guild'] ?></th>
                                    <th class='text-center text-white'><?= $translations['gold'] ?></th>
                                    <th class='text-center text-white'><?= $translations['arena'] ?></th>
                                    <th class='text-center text-white'><?= $translations['honor'] ?></th>
                                    <th class='text-center text-white'><?= $translations['achievements'] ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $characters = $character->get_characters($_SESSION['account_id']);
                            foreach ($characters as $character) { ?>
                                <tr>
                                    <td class='text-center'>
                                        <a href="?page=armory&charid=<?= $character['guid']; ?>" class="text-blue-500 hover:underline">
                                            <span><font color="<?= $character['class_color']; ?>"><?= $character['name']; ?></font></span>
                                        </a>
                                    </td>

                                    <td class='text-center text-white sm:block hidden'>
                                        <div class="tooltip" data-tip="<?= $character['faction_text']; ?> - <?= $character['class_name']; ?> - <?= $character['race_name']; ?>">
                                            <img class="h-5 inline" src="<?= $character['faction']; ?>" />
                                            <img class="h-5 inline rounded-full" src="<?= $character['class_image']; ?>">
                                            <img class="h-5 inline rounded-full" src="<?= $character['race_image']; ?>" class="mr-2">
                                        </div>
                                    </td>
                                    <td class='text-center'>
                                        <span><?= $character['level']; ?></span>
                                    </td>
                                    <td class='text-center'>
                                        <span><?= $character['guild_name']; ?></span>
                                    </td>
                                    <td class='text-center'>
                                        <span><?= $character['gold']; ?> <img class="h-5 inline rounded-full" src="<?= $character['gold_image']; ?>" class="mr-2">
                                        <?= $character['silver']; ?> <img class="h-5 inline rounded-full" src="<?= $character['silver_image']; ?>" class="mr-2"> 
                                        <?= $character['copper']; ?> <img class="h-5 inline rounded-full" src="<?= $character['copper_image']; ?>" class="mr-2"></span>
                                    </td>
                                    <td class='text-center'>
                                        <span><img class="h-5 inline rounded-full" src="<?= $character['arena_image']; ?>" class="mr-2"> <?= $character['arenaPoints']; ?></span>
                                    </td>
                                    <td class='text-center'>
                                        <span><img class="h-5 inline rounded-full" src="<?= $character['honor_image']; ?>" class="mr-2"> <?= $character['totalHonorPoints']; ?></span>
                                    </td>
                                    <td class='text-center'>
                                        <span><img class="h-5 inline rounded-full" src="<?= $character['achievement_image']; ?>" class="mr-2"> <?= $character['achievement_count']; ?></span>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
