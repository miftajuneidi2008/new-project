<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>

<main>
    <div class="container-fluid px-4">
        <ol class="breadcrumb mb-4 mt-2">
            <li class="breadcrumb-item active">/admin</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body d-flex align-items-center justify-content-between">ጠቅላላ ዜና
                        <span><?= esc($news) ?></span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/admin/news">ዝርዝሮችን ይመልከቱ</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body d-flex align-items-center justify-content-between">ጠቅላላ ፕሮግራም
                        <span><span><?= esc($program) ?></span></span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/admin/program">ዝርዝሮችን ይመልከቱ</a>

                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body d-flex align-items-center justify-content-between">ጠቅላላ የፕሮግራም ምድብ
                        <span><?= esc($program_category) ?></span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/admin/program_category">ዝርዝሮችን ይመልከቱ</a>

                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body d-flex align-items-center justify-content-between">ጠቅላላ የዜና ምድብ
                        <span><?= esc($news_category) ?></span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/admin/news_category">ዝርዝሮችን ይመልከቱ</a>

                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>

    </div>
</main>
<?= $this->endSection() ?>