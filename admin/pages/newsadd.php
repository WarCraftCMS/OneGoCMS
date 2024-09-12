<?php
if (isset($_POST['submit'])) {
    $news = new News();
    $news->add_news($_POST['news-title'], $_POST['news-content'], $_POST['news-url'], $_FILES['file'], $_SESSION['username']);
}

if (isset($_POST['edit-submit'])) {
    $news = new News();
    $news->update_news($_POST['news-id'], $_POST['news-title'], $_POST['news-content']);
}

$news = new News();
?>
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title"><?= $translations['news'] ?></h3>
                                            <div class="nk-block-des text-soft">
                                                <p><?= $translations['add_new'] ?>.</p>
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
                        <form id="news-form" method="post" action="" enctype="multipart/form-data">
                            <!-- Tabs -->
                            <div class="row g-4">
                                <div class="col-lg-12">

                                </div>
                            </div>
                            <!-- Tab content -->
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="news-title" class="form-label"><?= $translations['head'] ?></label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="news-title" name="news-title">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="news-title" class="form-label"><?= $translations['url'] ?></label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="news-url" name="news-url">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                            
                                                            <label for="file" class="form-label"><?= $translations['image'] ?></label>
                                                            <input type="file" name="file" id="file"><br>
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row g-4 col-description" >
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="news-title" class="form-label"><?= $translations['description'] ?></label>
                                                            <div class="form-control-wrap">
                                                                <textarea type="text" class="form-control" id="news-content" name="news-content"></textarea>
                                                            </div>
                                                                                                                    </div>
                                                    </div>
                                                </div>

                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary ml-auto" form="news-form" id="submit" name="submit"><?= $translations['send'] ?></button>
                                    </div>
                                </div>
                            </div>
                           </form>
                           </div>
                    </div>
                </div>
            </div>
        </div>
    </div>