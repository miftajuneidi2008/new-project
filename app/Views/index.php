<?= $this->extend('user/welcome_message') ?>
<?= $this->section('contents') ?>
<?php use CodeIgniter\I18n\Time; ?>
<div class="container my-4">
    <!-- Add the custom class 'video-layout-row' to the main row -->
    <div class="row video-layout-row">

        <!-- ========== Left Column: Featured Video ========== -->
        <div class="col-lg-7 h-100" role="button">
            <!-- The video-item will fill the height of this column -->
            <div class="video-item featured-video">
                <a href="/news/<?= esc($news[0]['id']) ?>">
                    <img src="<?= base_url('images/' . $news[0]['photo']) ?>" width="30px" height="30px"
                        alt="<?= esc($news[0]['title']) ?>">
                    <div class="video-tag"><?= esc($news[0]['category_title']) ?></div>
                    <div class="video-overlay">
                        <h3 class="video-title"><?= esc($news[0]['title']) ?></h3>
                        <p class="video-date"><?= (new Time($news[0]['created_at']))->format('M j, Y') ?></p>
                    </div>
                </a>
            </div>
        </div>

        <!-- ========== Right Column: Other Videos ========== -->
        <!-- Use d-flex and flex-column to stack the items vertically. 'gap-4' adds space between them. -->
        <div class="col-lg-5 h-100 d-flex flex-column gap-lg-4 right-column">

            <!-- Video 1: 'flex-grow-1' makes it take up available space -->
            <div class="video-item flex-grow-1" role="button" role="button">
                <a href="/news/<?= esc($news[1]['id']) ?>">
                    <img src="<?= base_url('images/' . $news[1]['photo']) ?>" width="30px" height="30px"
                        alt="<?= esc($news[1]['title']) ?>">

                    <div class="video-tag"><?= esc($news[1]['category_title']) ?></div>
                    <div class="video-overlay">
                        <h5 class="video-title"><?= esc($news[1]['title']) ?></h5>
                        <p class="video-date"><?= (new Time($news[1]['created_at']))->format('M j, Y') ?></p>
                    </div>
                </a>
            </div>

            <!-- Video 2: 'flex-grow-1' makes it take up available space -->
            <div class="video-item flex-grow-1" role="button">
                <a href="/news/<?= esc($news[2]['id']) ?>">
                    <img src="<?= base_url('images/' . $news[2]['photo']) ?>" width="30px" height="30px"
                        alt="<?= esc($news[2]['title']) ?>">
                    <div class="video-tag"><?= esc($news[2]['category_title']) ?></div>
                    <div class="video-overlay">
                        <h5 class="video-title"><?= esc($news[2]['title']) ?></h5>
                        <p class="video-date"><?= (new Time($news[2]['created_at']))->format('M j, Y') ?></p>
                    </div>
                </a>
            </div>

        </div>
    </div>

    <div class="mt-4">
        <h3 class="section-title">
            የቅርብ ጊዜ ዜናዎች</h3>

        <!-- Bootstrap grid with 2 columns on medium screens and up -->
        <div class="row gy-4">

            <!-- News Item 1 -->
            <?php if (!empty($siltie)): ?>
                <div class="col-md-6">
                    <div class="news-item d-flex align-items-center">
                        <img src="<?= base_url('images/' . $siltie['photo']) ?>" alt="<?= esc($siltie['title']) ?>">
                        <div class="ms-3">
                            <span class="category-tag tag-siltie"><?= esc($siltie['category_title']) ?></span>
                            <a href="<?= base_url('news/' . esc($siltie['id'])) ?>"
                                class="news-title"><?= esc($siltie['title']) ?></a>
                            <p class="news-date mb-0"><?= (new Time($siltie['created_at']))->format('M j, Y') ?></p>
                        </div>
                    </div>
                </div>

            <?php endif; ?>


            <!-- News Item 2 -->
            <?php if (!empty($centeral_ethiopia)): ?>
                <div class="col-md-6">
                    <div class="news-item d-flex align-items-center">
                        <img src="<?= base_url('images/' . $centeral_ethiopia['photo']) ?>"
                            alt="<?= esc($centeral_ethiopia['title']) ?>">
                        <div class="ms-3">
                            <span class="category-tag tag-siltie"><?= esc($centeral_ethiopia['category_title']) ?></span>
                            <a href="<?= base_url('news/' . esc($centeral_ethiopia['id'])) ?>"
                                class="news-title"><?= esc($centeral_ethiopia['title']) ?></a>
                            <p class="news-date mb-0"><?= (new Time($centeral_ethiopia['created_at']))->format('M j, Y') ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- News Item 3 -->
            <?php if (!empty($ethiopia)): ?>
                <div class="col-md-6">
                    <div class="news-item d-flex align-items-center">
                        <img src="<?= base_url('images/' . $ethiopia['photo']) ?>" alt="<?= esc($ethiopia['title']) ?>">
                        <div class="ms-3">
                            <span class="category-tag tag-siltie"><?= esc($ethiopia['category_title']) ?></span>
                            <a href="<?= base_url('news/' . esc($ethiopia['id'])) ?>"
                                class="news-title"><?= esc($ethiopia['title']) ?></a>
                            <p class="news-date mb-0"><?= (new Time($ethiopia['created_at']))->format('M j, Y') ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- News Item 4 -->
            <?php if (!empty($africa)): ?>
                <div class="col-md-6">
                    <div class="news-item d-flex align-items-center">
                        <img src="<?= base_url('images/' . $africa['photo']) ?>" alt="<?= esc($africa['title']) ?>">
                        <div class="ms-3">
                            <span class="category-tag tag-siltie"><?= esc($africa['category_title']) ?></span>
                            <a href="<?= base_url('news/' . esc($africa['id'])) ?>"
                                class="news-title"><?= esc($africa['title']) ?></a>
                            <p class="news-date mb-0"><?= (new Time($africa['created_at']))->format('M j, Y') ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- News Item 5 -->
            <?php if (!empty($world)): ?>
                <div class="col-md-6">
                    <div class="news-item d-flex align-items-center">
                        <img src="<?= base_url('images/' . $world['photo']) ?>" alt="<?= esc($world['title']) ?>">
                        <div class="ms-3">
                            <span class="category-tag tag-siltie"><?= esc($world['category_title']) ?></span>
                            <a href="<?= base_url('news/' . esc($world['id'])) ?>"
                                class="news-title"><?= esc($world['title']) ?></a>
                            <p class="news-date mb-0"><?= (new Time($world['created_at']))->format('M j, Y') ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- News Item 6 -->
            <?php if (!empty($sport)): ?>
                <div class="col-md-6">
                    <div class="news-item d-flex align-items-center">
                        <img src="<?= base_url('images/' . $sport['photo']) ?>" alt="<?= esc($sport['title']) ?>">
                        <div class="ms-3">
                            <span class="category-tag tag-siltie"><?= esc($sport['category_title']) ?></span>
                            <a href="<?= base_url('news/' . esc($sport['id'])) ?>"
                                class="news-title"><?= esc($sport['title']) ?></a>
                            <p class="news-date mb-0"><?= (new Time($sport['created_at']))->format('M j, Y') ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- News Item 7 -->
            <?php if (!empty($bussiness)): ?>
                <div class="col-md-6">
                    <div class="news-item d-flex align-items-center">
                        <img src="<?= base_url('images/' . $bussiness['photo']) ?>" alt="<?= esc($bussiness['title']) ?>">
                        <div class="ms-3">
                            <span class="category-tag tag-siltie"><?= esc($bussiness['category_title']) ?></span>
                            <a href="<?= base_url('news/' . esc($bussiness['id'])) ?>"
                                class="news-title"><?= esc($bussiness['title']) ?></a>
                            <p class="news-date mb-0"><?= (new Time($bussiness['created_at']))->format('M j, Y') ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <section class="programmes-section py-5">
        <?php if (!empty($program_category)): ?>
            <div class="container">
                <h2 class="section-title mb-4">ፕሮግራሞች</h2>

                <!-- The Slick Carousel container -->
                <div class="programme-slider">
                    <!-- Item 1 -->
                    <?php foreach ($program_category as $program_info): ?>
                        <a href="/programs/<?= esc($program_info['id']) ?>">
                            <div class="programme-item">

                                <img src="<?= base_url('images/' . $program_info['photo']) ?>" class="card-img-top"
                                    style="height: 300px; object-fit: cover;" alt="<?= esc($program_info['title']) ?>">
                                <div class="programme-overlay">
                                    <h4 class="programme-title"><?= esc($program_info['title']) ?></h4>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>


                </div>
            </div>
        <?php else: ?>
            <p>
                እስካሁን ምንም ፕሮግራም የለም።</p>
        <?php endif; ?>
    </section>
</div>
<?= $this->endSection() ?>