<?php 
$stats = new Dashboard();

?>
          <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Главная</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>Основные показатели сервера.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Accounts</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $stats->total_accounts(); ?></h6>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Characters</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $stats->total_characters(); ?></h6>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Tickets</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $stats->total_tickets(); ?></h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Arena Teams</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $stats->total_arena_teams(); ?></h6>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Premium Accounts</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $stats->premiun_accounts(); ?></h6>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Arena Teams</h5>
                    <h6 class="card-subtitle mb-2 text-muted">1000</h6>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Arena Teams</h5>
                    <h6 class="card-subtitle mb-2 text-muted">1000</h6>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Arena Teams</h5>
                    <h6 class="card-subtitle mb-2 text-muted">1000</h6>

                </div>
            </div>
        </div>
    </div>
</div>