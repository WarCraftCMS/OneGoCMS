<?php
$global->check_logged_in();

$successMessage = '';
$errorMessage = '';

try {
    $donorPointsManager = new DonorPointsManager($_SESSION['username']);

    $successMessage = $donorPointsManager->creditDonorPoints();
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
}

if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error'];
    unset($_SESSION['error']);
}

function displayMessage($message, $type) {
    if ($message) {
        echo '<div class="alert alert-' . htmlspecialchars($type) . '">';
        echo '<strong>' . ($type === 'success' ? 'Отличная работа!' : 'Эй, там!') . '</strong> ' . htmlspecialchars($message);
        echo '</div>';
    }
}

?>

<div class="hero min-h-screen">
    <div class="hero-content text-center text-neutral-content w-full">
        <div class="container">
            <h1 class="mb-5 text-4xl font-bold text-white">Донат</h1>

            <div class="text-white bg-slate-950/60 p-9 rounded-lg text-left leading-loose">
                <?php 
                displayMessage($successMessage, 'success');
                displayMessage($errorMessage, 'danger');
                ?>

                <div class="divider mb-5">Ваши донат-монеты</div>
                <div>
                    <span class="font-bold">Ваши донат-монеты:</span> <?= htmlspecialchars($GLOBALS['account']->get_account_currency()['donor_points']) ?> €
                </div>
            </div>
        </div>
    </div>
</div>