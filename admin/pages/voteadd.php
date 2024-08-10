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
                <h3 class="nk-block-title page-title">Добавление сайта для голосования</h3>
                <div class="nk-block-des text-soft">
                    <p>Заполните форму для добавления нового сайта для голосования.</p>
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
                                <label for="site-name" class="form-label">Название сайта</label>
                                <input type="text" name="site-name" id="site-name" class="form-control" placeholder="Введите название сайта" required>
                            </div>
                            <div class="form-group">
                                <label for="site-url" class="form-label">URL сайта</label>
                                <input type="url" name="site-url" id="site-url" class="form-control" placeholder="Введите URL сайта" required>
                            </div>
                            <div class="form-group">
                                <label for="vote-points" class="form-label">Очки голосования</label>
                                <input type="number" name="vote-points" id="vote-points" class="form-control" placeholder="Введите количество очков" min="1" value="1">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="vote-submit" class="btn btn-lg btn-primary">Добавить сайт</button>
                            </div>
                        </form>
                    </div>
                                    </div>
            </div>
        </div>
    </div>
</div>