<?php
$account = new adminAccounts();
$pageNum = isset($_GET['pg']) ? $_GET['pg'] : 1; // Get the current page number from the URL
$perPage = 10; // Number of accounts to display per page
$accounts = $account->get_accounts($pageNum, $perPage);
?>
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title"><?= $translations['user'] ?></h3>
                                            <div class="nk-block-des text-soft">
                                                <p><?= $translations['list_users'] ?>.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <div class="card card-bordered">

                    <div class="card-inner p-0 border-top">
                        <div class="nk-tb-list nk-tb-ulist is-compact">
                            
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span class="sub-text"><?= $translations['username'] ?></span></div>
                                <div class="nk-tb-col"><span class="sub-text"><?= $translations['email'] ?></span></div>
                                <div class="nk-tb-col"><span class="sub-text"><?= $translations['joindate'] ?></span></div>
                                <div class="nk-tb-col"><span class="sub-text"><?= $translations['last_login'] ?></span></div>
                                <div class="nk-tb-col"><span class="sub-text"><?= $translations['last_ip'] ?></span></div>
                                
                                
                            </div>
                            <!-- .nk-tb-item -->
                            <?php foreach ($accounts as $user) : ?>
                             <div class="nk-tb-item">
                                
                                    <div class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-avatar xs bg-primary">
                                                <span class="text-uppercase"> De </span>
                                            </div>
                                            <div class="user-name">
                                                <span class="tb-lead"><?php echo $user['username']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-col"> <span><?php echo $user['email']; ?></span> </div>
                                    <div class="nk-tb-col"> <span><?php echo $user['joindate']; ?></span> </div>
                                    <div class="nk-tb-col"> <span><?php echo $user['last_login']; ?></span> </div>
                                    <div class="nk-tb-col"> <span><?php echo $user['last_ip']; ?></span> </div>
                                    
                                
                                </div>
                                <?php endforeach; ?>
                        </div>
                    </div>

<div class="card-inner">
    <nav>
        <ul class="pagination">
            <?php
            $totalAccounts = $account->get_total_accounts();
            $totalPages = ceil($totalAccounts / $perPage);

            if ($pageNum > 1) {
                echo "<li class='page-item'><a class='page-link' href='?page=accounts&pg=1'>1</a></li>";
            }

            if ($pageNum > 3) {
                echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
            }

            for ($i = max(2, $pageNum - 1); $i <= min($totalPages - 1, $pageNum + 1); $i++) {
                $isActive = $i == $pageNum ? "active" : "";
                echo "<li class='page-item $isActive'><a class='page-link' href='?page=accounts&pg=$i'>$i</a></li>";
            }

            if ($pageNum < $totalPages - 1) {
                if ($pageNum < $totalPages - 2) {
                    echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                }
                echo "<li class='page-item'><a class='page-link' href='?page=accounts&pg=$totalPages'>$totalPages</a></li>";
            }
            ?>
        </ul>
    </nav>
</div>

                                            </div>
                    </div>
                                            </div>
                    </div>



                    <!-- Pagination navigation links -->
<div class="pagination">

</div>