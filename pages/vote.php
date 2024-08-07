<?php
session_start();

$global->check_logged_in();
$account = new Account($_SESSION['username']);

if (isset($_POST['change_password'])) {
   header("Location: ?page=changepassword");
   exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote'])) {
    $vote_result = $account->get_vote_mmotop();
}

?>

    <div class="hero min-h-screen hero14">
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="container">
            <div class="max-w-3xl mt-36 2xl:pt-0">
                <h1 class="mb-5 text-4xl font-bold text-white text-shadow_dark">
                    Голосуйте за нас
                </h1>
                <div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">


                    <div class="mt-2">
                                                <div class="divider mb-5">Сайты голосования</div>

                        <div role="alert" class="alert shadow-lg bg-cyan-950/40">
                            <div>
                                <h3 class="font-bold">Награды</h3>
                                <div class="text-sm">
                                    <p class="sm:inline leading-loose">
                                        Проголосовав за нас, вы получите баллы голосования (VP), которые можно использовать в игре.
                                    </p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th class='text-center text-white'>Сайт</th>
                                    <th class='text-center text-white'>Статус</th>
                                    <th class='text-center text-white'>Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class='text-center'>
                                        <img src="https://mmotop.ru/uploads/rating_img/mmo_38047.png" alt="Top100Arena"
                                            class="max-w-20 max-h-20">
                                    </td>
                                    <td class='text-center'>
                                        <span class="text-cyan-500">Готов голосовать</span>
                                    </td>
                                    <td class='text-center'>
                                                            <?php
                        $vote_status = $account->is_banned();
                        if ($vote_status === "Good standing") {
                        ?>
                            <form method="POST" action="">
                                        <a href="https://wow.mmotop.ru/servers/38047/votes/new"
                                            target="_blank" class="btn bg-teal-600 hover:bg-teal-700 text-white">
                                            Голосуйте сейчас
                                        </a>
                            </form>
                        <?php
                        } else {
                            echo '<p>Вы не можете голосовать, так как ваш аккаунт забанен.</p>';
                        }

                        if (isset($vote_result)) {
                            echo '<p>' . $vote_result . '</p>';
                        }
                        ?>
                                    </td>
                                </tr>
                                <tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>