<?= $this->extend('user/welcome_message') ?>
<?= $this->section('contents') ?>


<div class="container">
    <?php if ($about): ?>
        <div >
            <h3 class="text-center" style="margin-top:48px; font-weight: bold;">ስለ እኛ</h3>
            <div class=" lead" style="max-width:800px; margin-inline:auto;">
                <?= nl2br($about[0]['description']) ?>
            </div>
        </div>

    <?php else: ?>

    <?php endif ?>
</div>


<?= $this->endSection() ?>