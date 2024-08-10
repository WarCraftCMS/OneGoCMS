<?php
$global->check_logged_in();
$store = new Store();
$account = new Account($_SESSION['username']);
$category = 0;
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}

$categories = $store->get_categories();
$items = $store->get_items($category);

if (isset($_POST['add_to_cart'])) {
    $store->add_to_cart($account->get_id(), $_POST['product_id'], $_POST['quantity']);
}

if (isset($_SESSION['success_message'])) {
    echo '<div class="text-center">';
    echo '<div class="alert alert-dismissible alert-success">';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    echo '<strong>Well done!</strong> ' . $_SESSION['success_message'] . '';
    echo '</div>';
    echo '</div>';
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error'])) {
    echo '<div class="text-center">';
    echo '<div class="alert alert-dismissible alert-danger">';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    echo '<strong>Hey there!</strong> ' . $_SESSION['error'] . '';
    echo '</div>';
    echo '</div>';
    unset($_SESSION['error']);
}
?>



    <div class="hero min-h-screen hero15">
    <div class="hero-overlay bg-opacity-70"></div>
    <div class="hero-content text-center text-neutral-content w-full">
        <div class="container">
            <div class="mx-auto max-w-5xl mt-36 2xl:pt-0">
                <h1 class="mb-5 text-4xl font-bold text-white text-shadow_dark">
                    Shop & Donation
                </h1>
                <div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">


                    <div class="mt-2">
                                                <div class="divider mb-5">Your Account Info</div>
                        <div>
                            <p>
                                <span class="font-bold">Account:</span> <span class="text-blue-500">
                                    AIZEN</span>
                            </p>
                            <p>
                                <span class="font-bold">Credit:</span> <span class="text-green-500">
                                    0€</span>
                            </p>
                        </div>
                        <div class="divider mb-5">Increase Credit with</div>
                        <div class="text-center">
                            <button type="button" onclick="modal_paypal.showModal()"
                                class="btn bg-blue-900 hover:bg-blue-700 text-white">
                                PayPal
                            </button>
                            <dialog id="modal_paypal" class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box text-justify max-w-full sm:max-w-3xl">
                                    <h3 class="font-bold text-lg">Pay with PayPal</h3>
                                    <form action="https://masterwow.net/account-management/donate" method="post" accept-charset="utf-8">
                                        <input type="hidden" name="xc_cv2" value="e3c5ad767ce310e92581ff2e3906e654">                                    
                                        <div class="mt-5">
                                        <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                                            <span class="mr-2 text-center"><i class="fa-brands fa-paypal mr-1"></i>
                                                Amount</span>
                                            <input type="number" name="paypal_amount" class="grow w-48 md:w-auto"
                                                placeholder="Amount" />
                                        </label>
                                    </div>
                                    <div class="mt-3">
                                        <span class="mr-2 text-center"><i class="fa-solid fa-credit-card mr-1"></i>
                                            Purchase type</span>
                                        <select name="purchase_type" class="select select-bordered w-48 md:w-auto">
                                            <option value="0">Charge your account</option>
                                            <option value="1">Get Gift Card</option>
                                        </select>
                                    </div>
                                    <div class="divider mt-5 mb-5">Please Note</div>
                                    <div>
                                        <p>
                                        <ul class="list-disc list-inside">
                                            <li>You will be redirected to PayPal to complete the payment.</li>
                                            <li>After the payment is completed, your account will be credited or you
                                                will receive a gift card.</li>
                                            <li>Gift cards can be used by you or given to your friends.</li>
                                            <li>If you choose to <span class="text-green-500">Charge your
                                                    account</span>
                                                , Your account credit will be
                                                increased.</li>
                                            <li>Gift cards can only be used once.</li>
                                            <li>Gift cards will expire after 30 days.</li>
                                            <li>If you lose your gift card, you can check the credit logs for
                                                transaction details and the gift card code.</li>

                                        </ul>
                                        <div class="divider mt-5 mb-5"></div>
                                        <ul class="list-disc list-inside">
                                            <li>Minimum amount: <span class="text-green-500">5€</span></li>
                                            <li>Maximum amount: <span class="text-green-500">100€</span></li>
                                            <li>Processing fee: <span
                                                    class="text-green-500">3%</span>
                                            </li>
                                            </p>
                                    </div>
                                    <div class="modal-action">
                                        <button type="submit" class="btn bg-green-600 hover:bg-green-700 text-white">
                                            <li class="fa-brands fa-paypal"></li>
                                            Pay Now
                                        </button>
                                        <button type="button" class="btn" onclick="modal_paypal.close()">Close</button>
                                    </div>
                                </div>
                            </dialog>

                            <button type="button" onclick="modal_crypto.showModal()"
                                class="btn bg-indigo-900 hover:bg-indigo-700 text-white">
                                Crypto Currency
                            </button>
                            <dialog id="modal_crypto" class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box text-justify max-w-full sm:max-w-3xl">
                                    <h3 class="font-bold text-lg">Pay with Crypto Currency</h3>
                                    <div class="mt-5 text-center">
                                        <a target="_blank"
                                            href="https://masterwow.mysellix.io/pay/79692e-78067c79dd-1d4781?email=osihranov@gmail.com"
                                            class="btn bg-blue-600 hover:bg-blue-700 text-white">
                                            <i class="fa-brands fa-btc"></i>
                                            Buy a Gift Card with a custom amount
                                        </a>
                                    </div>
                                    <div class="divider mt-5 mb-5">Please Note</div>
                                    <div>
                                        <p>
                                        <ul class="list-disc list-inside">
                                            <li>You will be redirected to the payment page after completing the payment.
                                            </li>
                                            <li>Once the payment is completed, we will send you a gift card to your
                                                email.</li>
                                            <li>Gift cards can be used by you or given to your friends.</li>
                                            <li>Each gift card can only be used once.</li>
                                            <li>Gift cards will expire after 30 days.</li>
                                            <li>Please make sure to enter your email correctly.</li>
                                            <li>Verification of payment may take a few minutes, so please wait for the
                                                email with the gift card code.</li>
                                            <li>Our main currency is "EURO", and all donations (including crypto
                                                payments) will be converted to EURO. For example, if 1 USD = 0.92 EURO
                                                and you're about to donate 10 EURO, you would have to pay approximately
                                                10.87 USD in the form of stable coins, such as USDT.</li>
                                        </ul>
                                    </div>
                                    <div class="modal-action">
                                        <button type="button" class="btn" onclick="modal_crypto.close()">Close</button>
                                    </div>
                                </div>
                            </dialog>

                            <button type="button" onclick="modal_giftcard.showModal()"
                                class="btn bg-sky-900 hover:bg-sky-700 text-white">
                                Gift Card
                            </button>
                            <dialog id="modal_giftcard" class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box text-justify max-w-full sm:max-w-3xl">
                                    <h3 class="font-bold text-lg">Redeem Gift Card</h3>
                                    <form action="https://masterwow.net/account-management/donate" method="post" accept-charset="utf-8">
<input type="hidden" name="xc_cv2" value="e3c5ad767ce310e92581ff2e3906e654">                                    <div class="mt-5">
                                        <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                                            <span class="mr-2 text-center"><i class="fa-solid fa-gift mr-1"></i>
                                                Gift Card Code</span>
                                            <input type="text" name="gift_card" class="grow w-48 md:w-auto"
                                                placeholder="Gift Card Code" />
                                        </label>
                                    </div>
                                    <div class="modal-action">
                                        <button type="submit"
                                            class="btn bg-green-600 hover:bg-green-700 text-white">Redeem</button>
                                        <button type="button" class="btn"
                                            onclick="modal_giftcard.close()">Close</button>
                                    </div>
                                    <div style="display:none"><label>What is your code?</label><input type="text" name="code_v2" value=""></div></form>                                </div>
                            </dialog>
                        </div>
                        <div class="divider mb-5">Other options</div>
                        <div class="text-center">
                            <button type="button" onclick="modal_discount.showModal()"
                                class="btn bg-green-900 hover:bg-green-700 text-white">
                                Apply Discount Code
                            </button>

                            <dialog id="modal_discount" class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box text-justify max-w-full sm:max-w-3xl">
                                    <h3 class="font-bold text-lg">Apply Discount Code</h3>
                                    <form action="https://masterwow.net/account-management/donate" method="post" accept-charset="utf-8">
<input type="hidden" name="xc_cv2" value="e3c5ad767ce310e92581ff2e3906e654">                                    <div class="mt-5">
                                        <label class="input input-bordered flex items-center gap-2 bg-zinc-900/40">
                                            <span class="mr-2 text-center"><i class="fa-regular fa-percent mr-1"></i>
                                                Discount Code</span>
                                            <input type="text" name="discount_code" class="grow w-48 md:w-auto"
                                                placeholder="Discount Code" />
                                        </label>
                                    </div>
                                    <div class="modal-action">
                                        <button type="submit"
                                            class="btn bg-green-600 hover:bg-green-700 text-white">Apply</button>
                                        <button type="button" class="btn"
                                            onclick="modal_discount.close()">Close</button>
                                    </div>
                                    <div style="display:none"><label>What is your code?</label><input type="text" name="code_v2" value=""></div></form>                                </div>
                            </dialog>

                            <button type="button" onclick="modal_creditlogs.showModal()"
                                class="btn bg-amber-900 hover:bg-amber-700 text-white">
                                Credit Logs
                            </button>
                            <dialog id="modal_creditlogs" class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box text-justify max-w-full sm:max-w-3xl">
                                    <h3 class="font-bold text-lg">10 Latest Credit Logs</h3>
                                    <table class="table-auto sm:table w-full mt-2">
                                        <thead>
                                            <tr>
                                                <th>IP Address</th>
                                                <th>Amount</th>
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                                                    </tbody>
                                    </table>
                                    <div class="modal-action">
                                        <button type="button" class="btn"
                                            onclick="modal_creditlogs.close()">Close</button>
                                    </div>
                                </div>
                            </dialog>
                        </div>
                        <div class="divider mb-5">List of products</div>
                        <div class="w-full">
                            <div class="grid grid-cols-1 gap-4">

                                                                <div
                                    class="card bordered shadow-lg bg-indigo-900/10 group hover:bg-indigo-950/70 transition duration-500 ease-in-out">
                                    <figure class="px-10 pt-10">
                                        <img src="https://masterwow.net/images/shop_donor_token.png"
                                            alt="Donor Token x5"
                                            class="mask mask-squircle max-w-40 max-h-40 brightness-50 transition duration-500 ease-in-out group-hover:brightness-100">
                                    </figure>
                                    <div class="card-body w-full">
                                        <h2 class="card-title text-center mx-auto text-amber-500">
                                            Donor Token x5</h2>
                                        <div class="text-center mx-auto">
                                            <span class=" text-xl font-bold">
                                                Price: <span class="text-green-500">
                                                    5€</span>
                                            </span>
                                        </div>
                                        <p class="">The Donor Token can be used for a variety of purposes including, but not limited to, purchasing exclusive cosmetic gear, mounts, and more from the Donor Shop. You can also use it to acquire the Titan's Grip, maximize your character's talents. The Donor Token offers a multitude of possibilities to enhance your gaming experience.</p>
                                        <div class="card-actions text-center mx-auto">
                                    <form action="" method="post" accept-charset="utf-8">
                                    <input type="hidden" name="xc_cv2" value="e3c5ad767ce310e92581ff2e3906e654">                                      
                                        <input type="hidden" name="product_id" value="2">
                                            <div class="flex justify-center gap-2">
                                                <select name="character" class="select select-bordered w-full">
                                                    <option value="0">Select Character</option>
                                                        <option value="1839">Aizen</option>
                                                        <option value="1840">Hilori</option>
                                                    </select>
                                                     <button type="button"
                                                    onclick="modal_verify_2.showModal()"
                                                    class="btn bg-teal-600 hover:bg-teal-900 text-white">
                                                    Buy Now
                                                </button>

                                                <dialog id="modal_verify_2"
                                                    class="modal modal-bottom sm:modal-middle">
                                                    <div class="modal-box text-justify max-w-full sm:max-w-3xl">
                                                        <h3 class="font-bold text-lg">Please Note</h3>
                                                        <p>
                                                            Are you sure you want to buy this product?
                                                        </p>
                                                        <div class="modal-action">
                                                            <button type="submit"
                                                                class="btn bg-cyan-600 hover:bg-cyan-700 text-white">Buy
                                                                Now</button>
                                                            <button type="button" class="btn"
                                                                onclick="modal_verify_2.close()">Close</button>
                                                        </div>
                                                    </div>
                                                </dialog>
                                            </div>
                                            <div style="display:none"><label>What is your code?</label>
                                                <input type="text" name="code_v2" value="">
                                            </div>
                                        </form>                                                                                    </div>
                                    </div>
                                </div>

                                                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card mt-5">
        <div class="card-body custom-card-body">
            <div class="row">
                <!-- Left Sidebar -->
                <div class="col-md-3">
                    <div class="list-group">
                        <h2 class="custom-card-text mb-2">Магазин</h2>
                        <a href="?page=cart" class="list-group-item list-group-item-action">Просмотреть корзину</a>
                        <?php while ($row = $categories->fetch_assoc()) : ?>
                            <a href="?page=store&category=<?= $row['id'] ?>" class="list-group-item list-group-item-action">
                                <?= $row['title'] ?>
                            </a>
                        <?php endwhile; ?>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="col-md-9">
                    <h2 class="custom-card-text">Магазин</h2>
                    <table class="table custom-card">
                        <thead class="thead-light">
                            <tr class="custom-card-text">
                                <th>Предмет</th>
                                <th>Очки голосования</th>
                                <th>Очки доната</th>
                                <th>Купить</th>
                            </tr>
                        </thead>
                        <tbody class="text-white">
                            <?php while ($row = $items->fetch_assoc()) : ?>
                                <tr>
                                    <td>
                                        <a href="http://wotlk.cavernoftime.com/item=<?= $row['item_id'] ?>" class="item">
                                            <?= $row['title'] ?>
                                        </a>
                                    </td>
                                    <td><?= $row['vote_points'] ?></td>
                                    <td><?= $row['donor_points'] ?></td>
                                    <td>
                                        <form method="POST" action="index.php?page=store&category=<?= $category ?>">
                                            <input type="hidden" name="product_id" value="<?= $row['item_id'] ?>">
                                            <input type="number" name="quantity" value="1" min="1" max="10">
                                            <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>