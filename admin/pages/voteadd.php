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
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <div class="card card-bordered">
                        <div class="card-inner">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="site-name" class="form-label"><?= $translations['vote_site_enter1'] ?></label>
                                <input type="text" name="site-name" id="site-name" class="form-control" placeholder="<?= $translations['vote_site_enter'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="site-url" class="form-label"><?= $translations['vote_site_url1'] ?></label>
                                <input type="url" name="site-url" id="site-url" class="form-control" placeholder="<?= $translations['vote_site_url'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="vote-points" class="form-label"><?= $translations['vote_site_points1'] ?></label>
                                <input type="number" name="vote-points" id="vote-points" class="form-control" placeholder="<?= $translations['vote_site_points'] ?>" min="1" value="1">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="vote-submit" class="btn btn-lg btn-primary"><?= $translations['vote_add'] ?></button>
                            </div>
                        </form>
                    </div>
                                    </div>
            </div>
        </div>
    </div>
</div>