<?= $this->extend('user/welcome_message') ?>
<?= $this->section('contents') ?>



<div class="login-container">
  <div class="card login-card">
    <?php if (session()->getFlashdata('error')): ?>
        <p class="error-message"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>
    <div class="card-body">
      <h5 class="card-title">እንኳን ደህና መጡ</h5>
      <a href="<?= $googleAuthUrl ?>" class="btn btn-google">Login with Gmail</a>
    </div>
  </div>
</div>
<?= $this->endSection() ?>