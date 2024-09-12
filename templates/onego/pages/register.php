<?php
if (isset($_POST['submit'])) {
    $reg = new Registration($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_confirmation']);
    $reg->register_checks();
}

if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger text-center' role='alert'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
}
?>
<div class="hero min-h-screen hero8">
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="container">
            <div class="max-w-full mt-36 2xl:pt-0">
                <h1 class="mb-5 text-4xl font-bold text-white text-shadow_dark">
                    <?= $translations['registration'] ?>
                </h1>
                <div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">
                    <form method="post" action="">
                        <div class="mt-2">
                            <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                                <span class="mr-2 text-center"><i class="fas fa-user fa-lg"></i></span>
                                <input type="text" id="username" name="username" class="grow w-48 md:w-auto" placeholder="<?= $translations['enter_username'] ?>" required>
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                                <span class="mr-2 text-center"><i class="fas fa-envelope fa-lg"></i></span>
                                <input type="email" id="email" name="email" class="grow w-48 md:w-auto" placeholder="<?= $translations['e_mail'] ?>"  required>
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                                <span class="mr-2 text-center"><i class="fas fa-unlock-alt fa-lg"></i></span>
                                <input type="password" id="password" name="password" class="grow w-48 md:w-auto" placeholder="<?= $translations['enter_password'] ?>"  required>
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                                <span class="mr-2 text-center"><i class="fas fa-lock fa-lg"></i></span>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="grow w-48 md:w-auto" placeholder="<?= $translations['enter_password'] ?>"  required>
                            </label>
                        </div>
                        <div class="mx-auto text-center">
                            <button type="submit" name="submit" class="btn mx-auto bg-blue-500/70 hover:bg-blue-700 text-white mt-2">
                                <?= $translations['register'] ?>
                            </button>
                        </div>
						<span><span>set realmlist <?= $realmlist ?></span></span>
                        </form>                                    
                    </div>
            </div>
        </div>
    </div>
</div>