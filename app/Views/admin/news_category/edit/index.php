<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>
<section>

    <div class="container mt-5">

        <a href="/admin/news" class="btn btn-light mb-4">ተመለስ</a>
        <!-- 2. Create a row. Use flexbox utilities to center the column inside it -->
        <div class="row">

            <!-- 3. Define the column width. This is the key to responsiveness -->
            <!-- "col-md-8" means it takes 8/12 of the width on medium screens and up -->
            <!-- "col-lg-6" means it takes 6/12 of the width on large screens and up -->
            <!-- On small (mobile) screens, it will automatically be full-width (12/12) -->
            <div class="col-md-8 col-lg-8 card py-5 px-5">
               
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


                <form action="/admin/news_category/<?= $news_category['id'];?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-4">
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="id" value="<?php echo $news_category['id'] ?>">
                    </div>
                    <div class="mb-4">
                        <label for="title" class="form-label">የዜና ምድብ ርዕስ</label>
                        <input type="title" class="form-control" name="title" id="title" aria-describedby="emailHelp" value="<?= $news_category['title'] ?>">
                    </div>

                    <div class="mb-4">
                        <label for="description">የዜና ምድብ መግለጫ</label>
                        <textarea class="form-control" name="description" placeholder="ስለ ዜና ምድብ እዚህ ይግለጹ"
                            id="description" style="height: 100px"> <?= $news_category['description'] ?></textarea>

                    </div>
                    <button type="submit" class="btn btn-primary">አስገባ</button>
                </form>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>