<?php
session_start();

$global->check_logged_in();
$account = new Account($_SESSION['username']);

if (isset($_POST['change_password'])) {
    header("Location: ?page=changepassword");
    exit();
}

$vote_result = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote'])) {
    $vote_site = $_POST['vote_site'];
    $vote_result = $account->vote($vote_site);

    if (is_array($vote_result) && isset($vote_result['url'])) {
        header("Location: " . $vote_result['url']);
        exit();
    } else {
        $vote_result = $vote_result;
    }
}

$vote_sites = $account->get_vote_sites();
?>

<div class="hero min-h-screen hero14">
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="container">
            <div class="max-w-3xl mt-36 2xl:pt-0">
                <h1 class="mb-5 text-4xl font-bold text-white text-shadow_dark"><?= $translations['vote_for_us'] ?></h1>
                <div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">

                    <div class="mt-2">
                        <div class="divider mb-5"><?= $translations['voting_sites'] ?></div>

                        <div role="alert" class="alert shadow-lg bg-cyan-950/40">
                            <div>
                                <h3 class="font-bold"><?= $translations['awards'] ?></h3>
                                <div class="text-sm">
                                    <p class="sm:inline leading-loose">
                                        <?= $translations['awards_info'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th class='text-center text-white'></th>
                                    <th class='text-center text-white'><?= $translations['website'] ?></th>
                                    <th class='text-center text-white'><?= $translations['action'] ?></th>
                                </tr>
                            </thead>
                            <tbody>
    <?php foreach ($vote_sites as $site): ?>
                                <tr>
                                    <td class='text-center'>
                                        <img src="https://mmotop.ru/uploads/rating_img/mmo_38047.png" alt="<?= htmlspecialchars($site['url']) ?>" class="max-w-20 max-h-20">
                                        
                                    </td>
                                    <td class='text-center'>
                                        <span class="text-cyan-500"><?= htmlspecialchars($site['name']) ?></span>
                                    </td>
                                    <td class='text-center'>
                                        <form method="POST" action="">
                                            <input type="hidden" name="vote_site" value="<?= htmlspecialchars($site['url']) ?>">
                                            <button type="submit" name="vote" class="btn bg-teal-600 hover:bg-teal-700 text-white"><?= $translations['vote'] ?></button>
                                        </form>
                                    </td>
    </tr>
    <?php endforeach; ?>
                            </tbody>

                        </table>
                        <?php
                        if (!empty($vote_result)) {
                            echo '<p>' . htmlspecialchars($vote_result) . '</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
