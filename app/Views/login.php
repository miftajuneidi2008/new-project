<?= $this->extend('user/welcome_message') ?>
<?= $this->section('contents') ?>
<div style="width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center;">
  <div class="card" style="width: 30rem;">
    <?php if (session()->getFlashdata('error')): ?>
            <p class="error-message"><?= session()->getFlashdata('error') ?></p>
        <?php endif; ?>
    <div class="card-body">
      <h5 class="card-title">Welcome Back</h5>
      <a href="<?= $googleAuthUrl ?>" class="btn btn-primary">Login with Gmail</a>
    </div>
  </div>
</div>
<?= $this->endSection() ?>