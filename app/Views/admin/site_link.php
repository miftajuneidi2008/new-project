<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>
<section>

    <div class="container mt-5">

        <a href="/admin/links" class="btn btn-light mb-4">ተመለስ</a>
        <!-- 2. Create a row. Use flexbox utilities to center the column inside it -->
        <div class="row">


            <div class="col-md-8 col-lg-8 card py-4 px-5">
                <h3 class="mb-4">የአገናኝ ማስገቢያ ቅጽ</h3>
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


                <form action="/admin/links/" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-4">
                        <select class="form-select" name="url_type" id="url_type"
                            aria-label="Default select example">
                            <option value="">የአገናኝ አይነት ይምረጡ</option>
                            <option value="ኦዲዮ">ኦዲዮ</option>
                            <option value="ቪዲዮ">ቪዲዮ</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="link" class="form-label">ቪዲዮ / ኦዲዮ አድራሻ</label>
                        <input type="text" class="form-control" name="link" id="link" placeholder="እባክዎ የቪዲዮ / ኦዲዮ አድራሻ አድራሻ ይጻፉ" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">አስገባ</button>
                </form>

            </div>

            
        </div>
     
    </div>
</section>

<?= $this->endSection() ?>