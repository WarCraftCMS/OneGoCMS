<?php
$global->check_logged_in();
$donation = new Donation($_SESSION['username']);
if (isset($_POST['donate_now'])) {
    $donation_amount = $_POST['donation_amount'];
    $donation->createDonation($donation_amount);
}
?>
<div class="hero min-h-screen hero15">
    <div class="hero-overlay bg-opacity-70"></div>
        <div class="hero-content text-center text-neutral-content w-full">
                <div class="container">
            <div class="mx-auto max-w-5xl mt-36 2xl:pt-0">
                <h1 class="mb-5 text-4xl font-bold text-white text-shadow_dark">
                    Донат
                </h1>

<div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">
    <div class="mt-2">
        <div class="divider mb-5">Your Account Info</div>
            <div>
                <p>
                    <span class="font-bold">Account:</span> <span class="text-blue-500">
                        <?= $account->get_username(); ?></span>
                </p>
                <p>
                    <span class="font-bold">Credit:</span> <span class="text-green-500">
                        <?= $account->get_account_currency()['donor_points'] ?> €</span>
                </p>
            </div>
    </div>
 <div class="divider mb-5">Донат</div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-cyan-950/40 p-4 rounded-lg">
            <div class="text-sm">
                <h3 class="font-bold">Пополнение через FreeKassa</h3>
                    <div class="mt-2">
            <form action="" method="post">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Введите сумму</span>
                    </label>
                    <input type="number" name="donation_amount" placeholder="Сумма" class="input input-bordered" required min="1" />
                </div>
                <button type="submit" name="donate_now" class="btn bg-cyan-600 hover:bg-cyan-700 text-white mt-2">
                    Пополнить
                </button>
            </form>
        </div>
    </div>
</div>
                            <div class="bg-cyan-950/40 p-4 rounded-lg">
                                <div class="text-sm">
                                    <h3 class="font-bold">Пополнение через ENOT</h3>


                                    <div role="alert" class="alert alert-danger my-2 text-justify">
                                        <i
                                            class="fa-duotone fa-exclamation-triangle stroke-current shrink-0 text-red-500"></i>
                                        <span>
                                            Здесь описание кассы
                                        </span>
                                    </div>
                                    <form action="https://masterwow.net/account-management/recruit-a-friend" method="post" accept-charset="utf-8">
<input type="hidden" name="xc_cv2" value="1de759dba9a9eb30fe36669c973b2c8e">                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text">Сумма</span>
                                        </label>
                                        <input type="email" name="email" placeholder="Сумма"
                                            class="input input-bordered" required />

                                        <div class="mx-auto text-center mt-2 items-center">
                                            <div class="cf-turnstile mx-auto" data-sitekey="0x4AAAAAAAaFmg0qOjUrGNSk"></div>                                        
                                        </div>
                                        <button type="submit" class="btn bg-cyan-600 hover:bg-cyan-700 text-white mt-2">
                                            Пополнить
                                        </button>
                                    </div>
                                    <div style="display:none"><label>What is your code?</label><input type="text" name="code_v2" value=""></div></form>                                
                                </div>
                            </div>
                        </div>

    </div>
    </div>
        </div>
            </div>
        </div>