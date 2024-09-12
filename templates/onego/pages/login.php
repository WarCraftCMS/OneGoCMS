<?php
   if (isset($_POST['submit'])) {
       $login = new Login($_POST['username'], $_POST['password']);
       //$login->login_checks();
   
       if ($login->login()) {
           header("Location: ?page=account");
           exit();
       }
   }
   
   if (isset($_SESSION['error'])) {
       echo "<div class='alert alert-danger text-center' role='alert'>" . $_SESSION['error'] . "</div>";
       unset($_SESSION['error']);
   }
   
   ?>



    <div class="hero min-h-screen hero4">
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="container">
            <div class="max-w-full mt-36 2xl:pt-0">
                <h1 class="mb-5 text-4xl font-bold text-white text-shadow_dark">
                    <?= $translations['login_to_your_account'] ?>
                </h1>
                <div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">
                <form class="form" method="POST">  
                        <input type="hidden" name="xc_cv2" value="db9d5fca33cfe05e67440626abc4d5ee">                    <div>
                        <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                            <span class="mr-2 text-center"><i class="fas fa-user fa-lg"></i></span>
                            <input type="text" name="username" id="username" class="grow w-48 md:w-auto" placeholder="<?= $translations['enter_username'] ?>" />
                        </label>
                    </div>
                    <div class="mt-2">
                        <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                            <span class="mr-2 text-center"><i class="fas fa-unlock-alt fa-lg"></i></span>
                            <input type="password" name="password" class="grow w-48 md:w-auto" placeholder="<?= $translations['enter_password'] ?>" />
                        </label>
                    </div>
                    <div class="mx-auto text-center">
                        <button type="submit" name="submit" class="btn mx-auto bg-blue-500/70 hover:bg-blue-700 text-white mt-2">
                            <?= $translations['login'] ?>
                        </button>
                    </div>
                    </form>
                </div>
                <div class="divider text-center mt-5">
                    <?= $translations['or'] ?>
                </div>
                <div class="mx-auto text-center mt-5">
                    <a href="?page=register" class="btn bg-teal-500/70 hover:bg-teal-700 text-white">
                        <?= $translations['register'] ?>
                    </a>
                    <a href="?page=login"
                        class="btn bg-rose-500/70 hover:bg-rose-700 text-white">
                        <?= $translations['login'] ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>