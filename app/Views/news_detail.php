<?= $this->extend('user/welcome_message') ?>
<?php $this->section('meta'); ?>

<?php
// Prepare data for meta tags
$ogTitle = esc($news['title']);
$ogDescription = esc(substr(strip_tags($news['description']), 0, 155)) . '...';
$ogImage = base_url('images/' . $news['photo']);
$ogUrl = current_url(true);
?>
<!-- Basic Meta Tags -->
<meta name="description" content="<?= $ogDescription ?>">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="article">
<meta property="og:url" content="<?= $ogUrl ?>">
<meta property="og:title" content="<?= $ogTitle ?>">
<meta property="og:description" content="<?= $ogDescription ?>">
<meta property="og:image" content="<?= $ogImage ?>">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?= $ogUrl ?>">
<meta property="twitter:title" content="<?= $ogTitle ?>">
<meta property="twitter:description" content="<?= $ogDescription ?>">
<meta property="twitter:image" content="<?= $ogImage ?>">
<?php $this->endSection(); ?>


<?= $this->section('contents') ?>
<?php use CodeIgniter\I18n\Time; ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Main News Content Column -->
        <div class="col-lg-7">

            <h1 class="display-5 fw-bold mb-3"><?= esc($news['title']) ?></h1>

            <!-- Main Image -->
            <img src="<?= base_url('images/' . $news['photo']) ?>" class="img-fluid rounded mb-2 w-100"
                alt="<?= esc($news['title']) ?>">

            <!-- Meta Information -->
            <div class="news-meta text-muted mb-4">
                <span><i class="bi bi-person-fill"></i> <?= esc($news['author_name'] ?? 'Unknown Author') ?></span>
                <span class="ms-3"><i class="bi bi-clock"></i>
                    <?= (new Time($news['created_at']))->format('M j, Y') ?></span>
            </div>

            <!-- Full Description -->
            <div class="news-content lead">
                <?= nl2br($news['description']) ?>
            </div>

            <div class="social-share my-4">
                <h5 class="fw-bold mb-3">Share this article:</h5>

                <?php
                // Prepare the data for the share links
                $shareUrl = urlencode(current_url(true)); // The full URL of the current page
                $shareTitle = urlencode($news['id']); // The title of the news article
                ?>

                <div class="d-flex gap-2">
                    <!-- Facebook Share Button -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $shareUrl ?>" target="_blank"
                        rel="noopener noreferrer" class="btn btn-outline-primary d-inline-flex align-items-center">
                        <i class="bi bi-facebook me-2"></i> Facebook
                    </a>

                    <!-- Twitter Share Button -->
                    <a href="https://twitter.com/intent/tweet?url=<?= $shareUrl ?>" target="_blank"
                        rel="noopener noreferrer" class="btn btn-outline-info d-inline-flex align-items-center">
                        <i class="bi bi-twitter me-2"></i> Twitter
                    </a>

                    <!-- Telegram Share Button -->
                    <a href="https://t.me/share/url?url=<?= $shareUrl ?>" target="_blank" rel="noopener noreferrer"
                        class="btn btn-outline-secondary d-inline-flex align-items-center">
                        <i class="bi bi-telegram me-2"></i> Telegram
                    </a>
                </div>
            </div>

            <hr class="my-5">

            <a href="<?= site_url('news') ?>" class="btn btn-primary my-2"><i class="bi bi-arrow-left"></i> Back to News
                List</a>

        </div>

        <!-- Popular News Sidebar Column -->
        <div class="col-lg-4 mt-lg-5">
            <!-- 1. This inner div is the key. It will be the sticky element. -->
            <!-- 2. The 'top' style adds space from the top, e.g., to clear a fixed navbar. Adjust as needed. -->
            <div class="sticky-sidebar">
                <div class="popular-news-widget p-4">
                    <h4 class="mb-4">በብዛት የተነበቡ</h4>
                    <ol class="popular-news-list">
                        <?php foreach ($popular as $popular_data): ?>
                            <li><a href="/news/<?= esc($popular_data['id']) ?>"><?= esc($popular_data['title']) ?> </a></li>
                        <?php endforeach ?>

                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>