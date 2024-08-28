<?php
$global->check_logged_in();
$account = new Account($_SESSION['username']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['new_password'] == $_POST['confirm_password']){  // check if new password matches confirmed password
        $change_password_status = $account->change_password($_POST['old_password'], $_POST['new_password']);
        if ($change_password_status == "success") {
            echo '<div class="alert alert-success">Password has been successfully changed.</div>';
        } else {
            echo '<div class="alert alert-danger">Failed to change password. Please make sure your old password is correct.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">New password and confirmed password do not match.</div>';
    }
}
?>
