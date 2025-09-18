<?= $this->extend('user/welcome_message') ?>
<?= $this->section('contents') ?>
<?php use CodeIgniter\I18n\Time; ?>
<section>
    <div class="container mt-4">
        <div class="row g-5">

            <!-- ============================================= -->
            <!-- ==          LEFT COLUMN (News List)        == -->
            <!-- ============================================= -->
            <div class="col-lg-8">

                <div class="page-header mb-5">
                    <div class="row align-items-center mb-0 mb-md-3">

                        <div class="col-md-6">
                            <form action="<?= current_url() ?>" method="get" id="categoryFilterForm" class="flex-1">
                                <div class="input-group">
                                    <select class="form-select" name="category_title" onchange="this.form.submit();">
                                        <option value="">ሁሉም ዜናዎች</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= esc($category['title']) ?>"
                                                <?= ($selectedCategoryTitle == $category['title']) ? 'selected' : '' ?>>
                                                <?= esc($category['title']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h1 class="mb-3 mb-md-0">የቅርብ ጊዜ ዜናዎች</h1>
                        </div>

                    </div>

                    <p class="lead text-muted">ሀገራዊ እነ አለማቀፋዊ ዜናዎችን ለመከታተል ገጻችን ይጎብኙ።.
                    </p>
                </div>




                <!-- News Item 1 -->

                <?php foreach ($news as $news_data): ?>

                    <?php $summary = mb_substr($news_data['description'], 0, 100); ?>
                    <article class="card news-card mb-4">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="news-card-img-container">
                                    <img src="<?= base_url('images/' . $news_data['photo']) ?>"
                                        alt="<?= esc($news_data['title']) ?>" class="news-card-img">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column h-100">
                                    <div class="mb-2">
                                        <span class="category-tag"><?= esc($news_data['category_title']) ?></span>
                                    </div>
                                    <h4 class="news-title"><a href="<?= site_url('news/' . esc($news_data['id'])) ?>"
                                            class="stretched-link text-decoration-none text-dark"><?= esc($news_data['title']) ?></a>
                                    </h4>
                                    <p class="news-description my-3">
                                        <?= $summary ?> ...
                                    </p>
                                    <div class="news-meta mt-auto">
                                        <span><i class="bi bi-person-fill"></i> <?= $news_data['author_name'] ?></span>
                                        <span class="ms-3"><i class="bi bi-clock"></i>
                                            <?= (new Time($news_data['created_at']))->format('M j, Y') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach ?>
                <div class="d-flex justify-content-center mt-4">
                    <?= $pager ?>
                </div>
            </div>

            <!-- ============================================= -->
            <!-- ==     RIGHT COLUMN (Sticky Popular News)    == -->
            <!-- ============================================= -->
            <div class="col-lg-4">
                <div class="sticky-sidebar">
                    <div class="popular-news-widget p-4">
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

        </div>
    </div>

</section>
<?= $this->endSection() ?>