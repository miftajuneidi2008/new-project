<?= $this->extend('user/welcome_message') ?>
<?= $this->section('contents') ?>

<div class="container-fluid about-section">
    <?php if ($about): ?>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-11">
                <div class="about-card">
                    <h3 class="text-center">ስለ ተቋሙ</h3>
                    <div class="about-content">
                        <?= nl2br($about[0]['description']) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="text-center text-muted">
            <p>ምንም መረጃ የለም።</p>
        </div>
    <?php endif ?>
</div>

<?= $this->endSection() ?>