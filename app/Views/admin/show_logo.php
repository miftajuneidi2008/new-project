<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>
<section>

    <div class="container mt-5">

        <a href="/admin/links" class="btn btn-light mb-4">ተመለስ</a>
    
        <div class="row mt-5">
               <div class="col-md-8 col-lg-8 card py-4 px-5">
                <h3 class="mb-4">ኣርማ ማስገቢያ ቅጽ</h3>
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('message') ?>
                    </div>
                <?php endif; ?>


                <form action="/admin/logo" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
             
                    <div class="mb-4">
                        <label for="url" class="form-label">አርማ</label>
                        <input type="file" class="form-control" name="url" id="url" placeholder="እባክዎ የአርማ ያስገቡ" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">አስገባ</button>
                </form>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>