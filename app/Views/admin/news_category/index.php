<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>

<section>
    <div style="w-100%; display: flex; justify-content: space-between;margin-top:10px; margin-left: 10px; margin-right: 10px;">
        <a href="/admin" class="btn btn-light">ተመለስ</a>
        <a href="news/new" class="btn btn-light">አዲስ ዜና ይለጥፉ</a>
    </div>
</section>

<?= $this->endSection() ?>