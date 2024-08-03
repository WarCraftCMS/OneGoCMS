<?php
   if (isset($_POST['submit'])) {
       $login = new Login($_POST['username'], $_POST['password']);
       //$login->login_checks();
   
       if ($login->login()) {
           header("Location: ?page=home");
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
                    Login to your account
                </h1>
                <div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">
                <form class="form" method="POST">  
                        <input type="hidden" name="xc_cv2" value="db9d5fca33cfe05e67440626abc4d5ee">                    <div>
                        <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                            <span class="mr-2 text-center"><i class="fa-regular fa-user mr-1"></i> Username</span>
                            <input type="text" name="username" id="username" class="grow w-48 md:w-auto" placeholder="Введите Логин" />
                        </label>
                    </div>
                    <div class="mt-2">
                        <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                            <span class="mr-2 text-center"><i class="fa-regular fa-key mr-1"></i> Password</span>
                            <input type="password" name="password" class="grow w-48 md:w-auto" placeholder="Введите свой пароль" />
                        </label>
                    </div>
                    <div class="mx-auto text-center mt-2 items-center">
                        <div class="cf-turnstile mx-auto" data-sitekey="0x4AAAAAAAaFmg0qOjUrGNSk"></div>                    </div>
                    <div class="mx-auto text-center">
                        <button type="submit" name="submit" class="btn mx-auto bg-blue-500/70 hover:bg-blue-700 text-white mt-2">
                            Авторизоваться
                        </button>
                    </div>
                    <div style="display:none"><label>What is your code?</label><input type="text" name="code_v2" value=""></div></form>
                </div>
                <div class="divider text-center mt-5">
                    OR
                </div>
                <div class="mx-auto text-center mt-5">
                    <a href="https://masterwow.net/sign-up" class="btn bg-teal-500/70 hover:bg-teal-700 text-white">
                        Register
                    </a>
                    <a href="https://masterwow.net/restore-password"
                        class="btn bg-rose-500/70 hover:bg-rose-700 text-white">
                        Forgot Password
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>