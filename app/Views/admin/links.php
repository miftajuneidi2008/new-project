<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>

<section>
    <div class="d-flex justify-content-between align-items-center mt-4 mx-2">
        <h2>የቀጥታ አገናኝ</h2>
        <div class="d-flex gap-2">
            <a href="https://www.facebook.com/yourpage" target="_blank" class="btn btn-light">መርሐግብር ጨምር</a>
            <a href="/admin/site-link" class="btn btn-light">ማገናኛ አስገባ</a>
            <a href="/admin/logo"  class="btn btn-light">አርማ አስገባ</a>
        </div>
    </div>
    <div class="container my-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gap-5">
            <div class="card" style="width: 24rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">የአሁኑ አርማ</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card’s content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>


            <div class="card" style="width: 24rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">የአሁኑ የድምጽ ማገናኛ</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card’s content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <div class="card" style="width: 24rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        የአሁኑ የቪዲዮ አገናኝ</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card’s content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>

</section>
<?= $this->endSection() ?>