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
                <img src="<?= base_url('images/' . $news[0]['photo']) ?>" width="30px" height="30px"
                    alt="<?= esc($news[0]['title']) ?>">
                <div class="video-tag"><?= esc($news[0]['category_title']) ?></div>
                <div class="video-overlay">
                    <h3 class="video-title"><?= esc($news[0]['title']) ?></h3>
                    <p class="video-date"><?= (new Time($news[0]['created_at']))->format('M j, Y') ?></p>
                </div>
            </div>
        </div>

        <!-- ========== Right Column: Other Videos ========== -->
        <!-- Use d-flex and flex-column to stack the items vertically. 'gap-4' adds space between them. -->
        <div class="col-lg-5 h-100 d-flex flex-column gap-lg-4 right-column">

            <!-- Video 1: 'flex-grow-1' makes it take up available space -->
            <div class="video-item flex-grow-1" role="button" role="button">
                <img src="<?= base_url('images/' . $news[1]['photo']) ?>" width="30px" height="30px"
                    alt="<?= esc($news[1]['title']) ?>">
                <div class="video-tag"><?= esc($news[1]['category_title']) ?></div>
                <div class="video-overlay">
                    <h5 class="video-title"><?= esc($news[1]['title']) ?></h5>
                    <p class="video-date"><?= (new Time($news[1]['created_at']))->format('M j, Y') ?></p>
                </div>
            </div>

            <!-- Video 2: 'flex-grow-1' makes it take up available space -->
            <div class="video-item flex-grow-1" role="button">
                <img src="<?= base_url('images/' . $news[2]['photo']) ?>" width="30px" height="30px"
                    alt="<?= esc($news[2]['title']) ?>">
                <div class="video-tag"><?= esc($news[2]['category_title']) ?></div>
                <div class="video-overlay">
                    <h5 class="video-title"><?= esc($news[2]['title']) ?></h5>
                    <p class="video-date"><?= (new Time($news[2]['created_at']))->format('M j, Y') ?></p>
                </div>
            </div>

        </div>
    </div>

    <div class="mt-4">
        <h3 class="section-title">Recent News</h3>

        <!-- Bootstrap grid with 2 columns on medium screens and up -->
        <div class="row gy-4">

            <!-- News Item 1 -->
            <div class="col-md-6">
                <div class="news-item d-flex align-items-center">
                    <img src="https://i.imgur.com/kSwo6k4.jpeg" alt="News Image">
                    <div class="ms-3">
                        <span class="category-tag tag-siltie">Siltie</span>
                        <a href="#" class="news-title">በኢትዮጵያ የተገነባው ግድብ ከ2 ሺህ 8 ቢሊዮን በላይ ወጪ ተደርጎበታል</a>
                        <p class="news-date mb-0">Oct 18, 2024</p>
                    </div>
                </div>
            </div>

            <!-- News Item 2 -->
            <div class="col-md-6">
                <div class="news-item d-flex align-items-center">
                    <img src="https://i.imgur.com/gK92Bv2.jpeg" alt="News Image">
                    <div class="ms-3">
                        <span class="category-tag tag-central-ethiopia">Central Ethiopia</span>
                        <a href="#" class="news-title">በኢትዮጵያ የተገነባው ግድብ ከ2 ሺህ 8 ቢሊዮን በላይ ወጪ ተደርጎበታል</a>
                        <p class="news-date mb-0">Oct 18, 2024</p>
                    </div>
                </div>
            </div>

            <!-- News Item 3 -->
            <div class="col-md-6">
                <div class="news-item d-flex align-items-center">
                    <img src="https://i.imgur.com/gK92Bv2.jpeg" alt="News Image">
                    <div class="ms-3">
                        <span class="category-tag tag-ethiopia">Ethiopia</span>
                        <a href="#" class="news-title">በኢትዮጵያ የተገነባው ግድብ ከ2 ሺህ 8 ቢሊዮን በላይ ወጪ ተደርጎበታል</a>
                        <p class="news-date mb-0">Oct 18, 2024</p>
                    </div>
                </div>
            </div>

            <!-- News Item 4 -->
            <div class="col-md-6">
                <div class="news-item d-flex align-items-center">
                    <img src="https://i.imgur.com/gK92Bv2.jpeg" alt="News Image">
                    <div class="ms-3">
                        <span class="category-tag tag-africa">Africa</span>
                        <a href="#" class="news-title">በኢትዮጵያ የተገነባው ግድብ ከ2 ሺህ 8 ቢሊዮን በላይ ወጪ ተደርጎበታል</a>
                        <p class="news-date mb-0">Oct 18, 2024</p>
                    </div>
                </div>
            </div>

            <!-- News Item 5 -->
            <div class="col-md-6">
                <div class="news-item d-flex align-items-center">
                    <img src="https://i.imgur.com/gK92Bv2.jpeg" alt="News Image">
                    <div class="ms-3">
                        <span class="category-tag tag-world">World</span>
                        <a href="#" class="news-title">በኢትዮጵያ የተገነባው ግድብ ከ2 ሺህ 8 ቢሊዮን በላይ ወጪ ተደርጎበታል</a>
                        <p class="news-date mb-0">Oct 18, 2024</p>
                    </div>
                </div>
            </div>
            
            <!-- News Item 6 -->
            <div class="col-md-6">
                <div class="news-item d-flex align-items-center">
                    <img src="https://i.imgur.com/gK92Bv2.jpeg" alt="News Image">
                    <div class="ms-3">
                        <span class="category-tag tag-business">Bussiness</span>
                        <a href="#" class="news-title">በኢትዮጵያ የተገነባው ግድብ ከ2 ሺህ 8 ቢሊዮን በላይ ወጪ ተደርጎበታል</a>
                        <p class="news-date mb-0">Oct 18, 2024</p>
                    </div>
                </div>
            </div>

            <!-- News Item 7 -->
            <div class="col-md-6">
                <div class="news-item d-flex align-items-center">
                    <img src="https://i.imgur.com/gK92Bv2.jpeg" alt="News Image">
                    <div class="ms-3">
                        <span class="category-tag tag-sport">Sport</span>
                        <a href="#" class="news-title">በኢትዮጵያ የተገነባው ግድብ ከ2 ሺህ 8 ቢሊዮን በላይ ወጪ ተደርጎበታል</a>
                        <p class="news-date mb-0">Oct 18, 2024</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>