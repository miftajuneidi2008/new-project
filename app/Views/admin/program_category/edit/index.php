<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>
<section>

    <div class="container mt-5">

        <a href="/admin/news" class="btn btn-light mb-4">ተመለስ</a>
        <!-- 2. Create a row. Use flexbox utilities to center the column inside it -->
        <div class="row">


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


                <form action="/admin/program_category/<?= $program_category['id']; ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="mb-4">
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="id" value="<?php echo $program_category['id'] ?>">
                    </div>

                    <div class="mb-4">
                        <label for="title" class="form-label">የፕሮግራም ምድብ ርዕስ</label>
                        <input type="title" class="form-control" name="title" id="title" aria-describedby="emailHelp"
                            value="<?= $program_category['title'] ?>">
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label">የፕሮግራም ምድብ ምስል</label>
                        <input type="file" class="form-control" name="image" id="image" aria-describedby="emailHelp">
                    </div>



                    <div class="mb-4">
                        <label for="description">የዜና ምድብ መግለጫ</label>
                        <textarea class="form-control" name="description" placeholder="ስለ ዜና ምድብ እዚህ ይግለጹ"
                            id="description" style="height: 100px"> <?= $program_category['description'] ?></textarea>

                    </div>


                    <button type="submit" class="btn btn-primary">አስገባ</button>
                </form>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>