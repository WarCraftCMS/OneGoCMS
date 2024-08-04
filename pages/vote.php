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
                    Vote for us
                </h1>
                <div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">


                    <div class="mt-2">
                                                <div class="divider mb-5">Vote Sites</div>

                        <div role="alert" class="alert shadow-lg bg-cyan-950/40">
                            <div>
                                <h3 class="font-bold">Rewards</h3>
                                <div class="text-sm">
                                    <p class="sm:inline leading-loose">
                                        By voting for us, you will receive Vote Points (VP) that can be used in-game.
                                    </p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th class='text-center text-white'>Site</th>
                                    <th class='text-center text-white'>Status</th>
                                    <th class='text-center text-white'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class='text-center'>
                                        <img src="https://www.top100arena.com/hit/100738/small" alt="Top100Arena"
                                            class="max-w-20 max-h-20">
                                    </td>
                                    <td class='text-center'>
                                        <span class="text-green-500">Voted</span>
                                    </td>
                                    <td class='text-center'>
                                    <button class="btn bg-indigo-900/20 hover:bg-indigo-900/20 text-white cursor-not-allowed">
                                            10h 22m                                        
                                    </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='text-center'>
                                        <img src="https://www.xtremeTop100.com/votenew.jpg" alt="XtremeTop100"
                                            class="max-w-20 max-h-20">
                                    </td>
                                    <td class='text-center'>
                                        <span class="text-cyan-500">Ready to vote</span>                                    </td>
                                    <td class='text-center'>
                                        <a href=""
                                            target="_blank" class="btn bg-teal-600 hover:bg-teal-700 text-white">
                                            Vote Now
                                        </a>
                                                                            </td>
                                </tr>
                                                                <tr>
                                    <td class='text-center'>
                                        <img src="https://topg.org/topg2.gif" alt="TopG"
                                            class="max-w-20 max-h-20">
                                    </td>
                                    <td class='text-center'>
                                        <span class="text-cyan-500">Ready to vote</span>                                    </td>
                                    <td class='text-center'>
                                        <a href=""
                                            target="_blank" class="btn bg-teal-600 hover:bg-teal-700 text-white">
                                            Vote Now
                                        </a>
                                                                            </td>
                                </tr>
                                                                <tr>
                                    <td class='text-center'>
                                        <img src="https://gtop100.com/assets/images/votebutton.jpg" alt="GTop100"
                                            class="max-w-20 max-h-20">
                                    </td>
                                    <td class='text-center'>
                                        <span class="text-cyan-500">Ready to vote</span>                                    </td>
                                    <td class='text-center'>
                                        <a href=""
                                            target="_blank" class="btn bg-teal-600 hover:bg-teal-700 text-white">
                                            Vote Now
                                        </a>
                                                                            </td>
                                </tr>
                                                                <tr>
                                    <td class='text-center'>
                                        <img src="https://www.arena-top100.com/images/vote/wow-private-servers.png" alt="Arena-Top100"
                                            class="max-w-20 max-h-20">
                                    </td>
                                    <td class='text-center'>
                                        <span class="text-cyan-500">Ready to vote</span>                                    </td>
                                    <td class='text-center'>
                                        <a href=""
                                            target="_blank" class="btn bg-teal-600 hover:bg-teal-700 text-white">
                                            Vote Now
                                        </a>
                                                                            </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>