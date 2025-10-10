<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>

<main>
    <div class="container-fluid px-4">
        <div class="row mt-4">
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
        <div class="row my-4">
            <div class="col-xl-6">
                <?php if($popularN) :?>
                <div class="card mb-4">
                    <div class="card-header">
                     
                        በብዛት የተነበቡ ዜናዎች
                    </div>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ርዕስ</th>
                                <th scope="col">የእይታ ብዛት</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($popularN as $popn): ?>
                                <tr>
                                    
                                    <td><?= $popn['title'] ?></td>
                                    <td><?= $popn['view_count'] ?></td>
                                
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <?php endif ?>
            </div>
            <div class="col-xl-6">
              <?php if($popularP) :?>
                <div class="card mb-4">
                    <div class="card-header">
                     
                        በብዛት የተነበቡ ፕሮግራሞች
                    </div>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ርዕስ</th>
                                <th scope="col">የእይታ ብዛት</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($popularP as $popp): ?>
                                <tr>
                                    
                                    <td><?= $popp['title'] ?></td>
                                    <td><?= $popp['view_count'] ?></td>
                                
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <?php endif ?>
            </div>
        </div>

    </div>
</main>
<?= $this->endSection() ?>