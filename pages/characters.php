<?php
$global->check_logged_in();
$account = new Account($_SESSION['username']);

if (isset($_POST['change_password'])) {
    header("Location: ?page=changepassword");
    exit();
}

$message = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['teleport_character'])) {
    $account_id = intval($_POST['account_id']);
    $guid = intval($_POST['guid']);

    $character = new Character();
    $result = $character->teleportCharacter($account_id, $guid);

    switch($result) {
        case true:
            $message = "Персонаж успешно телепортировался.";
            break;
        case false:
            $message = "Телепортация не удалась. Пожалуйста, попробуйте снова.";
            break;
        default:
            $message = "Произошла ошибка.";
            break;
    }
}
?>
    <div class="hero min-h-screen hero13">
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="container">
            <div class="max-w-full mt-36 2xl:pt-0">
                <h1 class="mb-5 text-4xl font-bold text-white text-shadow_dark">
                    Your Characters
                </h1>
                <div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">
                    <div class="mt-2">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th class='text-center text-white'>Name</th>
                                    <th class='text-center text-white'>  </th>
                                    <th class='text-center text-white'>Уровень</th>
                                    <th class='text-center text-white'>Гильдия</th>
                                    <th class='text-center text-white'>Золото</th>
                                    <th class='text-center text-white'>Арена</th>
                                    <th class='text-center text-white'>Честь</th>
                                    <th class='text-center text-white'>Ранг</th>
                                    <th class='text-center text-white'>Достижения</th>
                                </tr>
                            </thead>

         <?php
            $character = new Character();
            $characters = $character->get_characters($_SESSION['account_id']);
            foreach ($characters as $character) {
            ?><tbody>
                                <tr>
                                    <td class='text-center'>
                                        <span><font color="<?= $character['class_color']; ?>"><?= $character['name']; ?></font></span>
                                    </td>
                                    <td class='text-center text-white sm:block hidden'>
                                        <div class="tooltip" data-tip="<?= $character['faction']; ?> - <?= $character['race']; ?> - <?= $character['class']; ?>">
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
                                        <span><img class="h-5 inline rounded-full" src="" class="mr-2"> </span>
                                    </td>
                                    <td class='text-center'>
                                        <span><img class="h-5 inline rounded-full" src="<?= $character['achievement_image']; ?>" class="mr-2"> <?= $character['achievement_count']; ?></span>
                                    </td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="account_id" value="<?= $_SESSION['account_id']; ?>">
                                            <input type="hidden" name="guid" value="<?= $character['guid']; ?>">
                                            <button type="submit" class="btn bg-rose-900 hover:bg-rose-700 text-white btn-sm">
                                                Застрял
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                            <?php } ?>   
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 