<?= $this->extend('user/welcome_message') ?>
<?= $this->section('contents') ?>
<?php use CodeIgniter\I18n\Time; ?>
<div class="container my-5">
    <?php if (!empty($bussiness)): ?>
        <!-- 1. SMALL BANNER SECTION -->
        <div class="small-banner rounded-4 d-flex align-items-center justify-content-center p-4">
            <!-- 1. The overlay div -->
            <div class="banner-overlay"></div>


            <img src="<?= base_url('images/' . $bussiness[0]['photo']) ?>" alt="<?= esc($bussiness[0]['title']) ?>"
                class="banner-img">

            <!-- 3. The text -->
            <div class="banner-text">
                <h1 class="page-title text-white">የቢዝነስ ዜና</h1>
            </div>
        </div>

        <div class="row g-5 mt-2">

            <!-- 2. LEFT COLUMN - LATEST SPORTS NEWS -->
            <div class="col-lg-8">
                <h2 class="section-title mb-4">የቅርብ ጊዜ ዜናዎች</h2>

                <!-- Article 1 -->
                <?php foreach ($bussiness as $bussiness_data): ?>
                    <?php $summary = mb_substr($bussiness_data['description'], 0, 100); ?>
                    <div class="card article-card-horizontal shadow-sm mb-4">
                        <div class="row g-0">
                            <div class="col-md-4">

                                <img src="<?= base_url('images/' . $bussiness_data['photo']) ?>"
                                    alt="<?= esc($bussiness_data['title']) ?>" class="article-img rounded-start-3">
                            </div>
                            <div class="col-md-8 d-flex flex-column">
                                <div class="card-body">
                                    <h5 class="card-title fs-4"><a href="/news/<?=esc($bussiness_data['id'])?>"><?= esc($bussiness_data['title']) ?></a></h5>
                                    <p class="card-text text-secondary"><?= $summary ?></p>
                                    <p class="card-text"><small
                                            class="text-muted"><?= (new Time($bussiness_data['created_at']))->format('M j, Y') ?></small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
                <div class="d-flex justify-content-center mt-4">
                    <?= $pager ?>
                </div>

            </div>

            <!-- 3. RIGHT COLUMN - STICKY POPULAR NEWS SIDEBAR -->
            <div class="col-lg-4">
                <div class="sticky-sidebar mt-4">
                    <div class="popular-news-widget p-4 ">
                        <h4 class="mb-4">በብዛት የተነበቡ</h4>
                        <ol class="popular-news-list">
                            <?php foreach ($popular as $popular_data): ?>
                                <li><a href="/news/<?= esc($popular_data['id']) ?>"><?= esc($popular_data['title']) ?> </a>
                                </li>
                            <?php endforeach ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>`
    <?php endif; ?>
</div>

<?= $this->endSection() ?>