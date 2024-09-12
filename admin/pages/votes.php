<?php
if (isset($_POST['vote-submit'])) {
    $voteSites = new VoteSites();
    $site_name = $_POST['site-name'];
    $site_url = $_POST['site-url'];
    $vote_points = isset($_POST['vote-points']) ? (int)$_POST['vote-points'] : 1;

    if ($voteSites->add_vote_site($site_url, $site_name, $vote_points)) {
        echo "<p>Сайт успешно добавлен!</p>";
    } else {
        echo "<p>Ошибка при добавлении сайта.</p>";
    }
}

$voteSites = new VoteSites();
?>


<?php 
$stats = new VoteSites();


if (isset($_POST['vote-submit'])) {
    $voteSites = new VoteSites();
    $site_name = $_POST['site-name'];
    $site_url = $_POST['site-url'];
    $vote_points = isset($_POST['vote-points']) ? (int)$_POST['vote-points'] : 1;

    if ($voteSites->add_vote_site($site_url, $site_name, $vote_points)) {
        echo "<p>Сайт успешно добавлен!</p>";
    } else {
        echo "<p>Ошибка при добавлении сайта.</p>";
    }
}
?>


          <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title"><?= $translations['vote_dash'] ?></h3>
                                            <div class="nk-block-des text-soft">
                                                <p><?= $translations['vote_sub'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

<!-- .nk-block -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <h5 class="card-title">
                                <a href="/admin/?page=voteadd" class="btn btn-sm btn-primary">
                                    <span class="d-none d-sm-inline" id="add-news-btn"><?= $translations['vote_add'] ?></span>
                                </a>
                            </h5>
                            <div class="card-tools d-none d-md-inline">

                            </div>
                        </div>
                    </div>
                    <div class="card-inner p-0 border-top">
                        <div class="nk-tb-list nk-tb-orders">
                            <?php foreach ($voteSites->get_vote_sites() as $voteSite) : ?>
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col"><span class="tb-lead"><?php echo htmlspecialchars($voteSite['site_name']); ?></span></div>
                                    <div class="nk-tb-col">
                                        <span class="tb-lead"><a href="<?php echo htmlspecialchars($voteSite['site_url']); ?>" target="_blank"><?php echo htmlspecialchars($voteSite['site_url']); ?></a></span>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span class="tb-sub">
                                            <?php echo htmlspecialchars($voteSite['vote_points']); ?> <?= $translations['vote_point'] ?>
                                        </span>
                                    </div>
                                    <div class="nk-tb-col nk-tb-col-action">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .nk-block -->
