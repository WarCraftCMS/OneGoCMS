<?php
if (isset($_POST['submit'])) {
    $news = new News();
    $news->add_news($_POST['news-title'], $_POST['news-content'], $_POST['news-thumbnail'], $_SESSION['username']);
}

if (isset($_POST['edit-submit'])) {
    $news = new News();
    $news->update_news($_POST['news-id'], $_POST['news-title'], $_POST['news-content']);
}

if (isset($_POST['delete-submit'])) {
    if(isset($_POST['news-id'])) {
        $news = new News();
        $news->delete_news($_POST['news-id']);
    }
}

$news = new News();
?>
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title"><?= $translations['news'] ?></h3>
                                            <div class="nk-block-des text-soft">
                                                <p><?= $translations['edit_news'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <h5 class="card-title">
                                <a href="/admin/?page=newsadd" class="btn btn-sm btn-primary">
                                    <span class="d-none d-sm-inline" id="add-news-btn"><?= $translations['add_news'] ?></span>
                                </a>
                            </h5>
                            <div class="card-tools d-none d-md-inline">

                            </div>
                        </div>
                    </div>
                    <div class="card-inner p-0 border-top">
                        <div class="nk-tb-list nk-tb-orders">
                            <?php foreach ($news->get_news(1, 10) as $newsItem) : ?>
                                <div class="nk-tb-item">
                                <div class="nk-tb-col"><span class="tb-lead"><?php echo $newsItem['title']; ?></span></div>
                                <div class="nk-tb-col">
                                    <span class="tb-lead"><a href="" target="_blank"><?php echo $newsItem['content']; ?></a></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub">
                                        <?php echo $newsItem['created_at']; ?>
                                    </span>
                                </div>
                                <div class="nk-tb-col nk-tb-col-action">
                                    <div class="dropdown">
                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">
                                            <em class="icon ni ni-more-h"></em>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-plain">
                                                <form method="POST" style="display:inline;">
                                                    <input type="hidden" name="news-id" value="<?php echo $newsItem['id']; ?>">
                                                    <li><button type="submit" class="text-danger" name="delete-submit" onclick="return confirm('Вы уверены, что хотите удалить эту новость??')"><?= $translations['del_news'] ?></button></li>
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
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