<?php
$global->check_logged_in();
$account = new Account($_SESSION['username']);

if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error']) . '</div>';
    unset($_SESSION['error']);
}
?>
   <div class="hero min-h-screen hero12">
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="container">
            <div class="max-w-full mt-36 2xl:pt-0">
                <h1 class="mb-5 text-4xl font-bold text-white text-shadow_dark">
                    <?= $translations['account_settings'] ?>
                </h1>
                <div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">
                    <div class="mt-2">
                        <form method="post" action="/?page=changepassword">
                            <input type="hidden" name="xc_cv2" value="92d546f46ca9c2343142c8b80ed5de73">                        
                                <div class="divider"><?= $translations['change_account_password'] ?></div>
                        <div class="mt-2">
                            <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                                <span class="mr-2 text-center"><?= $translations['current_password'] ?></span>
                                <input type="text" id="old_password" name="old_password" class="grow w-48 md:w-auto" placeholder="<?= $translations['password'] ?>" aria-required="true">
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                                <span class="mr-2 text-center"><?= $translations['new_password'] ?></span>
                                <input type="password" id="new_password" name="new_password" class="grow w-48 md:w-auto" placeholder="<?= $translations['password'] ?>" aria-required="true">
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                                <span class="mr-2 text-center"><?= $translations['confirm_password'] ?></span>
                                <input type="password" id="confirm_password" name="confirm_password" class="grow w-48 md:w-auto" placeholder="<?= $translations['password'] ?>"  aria-required="true">
                            </label>
                        </div>
                        <div class="mx-auto text-center">
                            <input type="submit" class="btn mx-auto bg-blue-500/70 hover:bg-blue-700 text-white mt-2"
                                value="<?= $translations['change'] ?>" name="submit">      
                        </div>
                        </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
