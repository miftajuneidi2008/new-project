<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>
<section>

    <div class="container mt-5">

        <a href="/admin/news" class="btn btn-light mb-4">ተመለስ</a>
        <!-- 2. Create a row. Use flexbox utilities to center the column inside it -->
        <div class="row">

      
            <div class="col-md-8 col-lg-8 card py-2 px-5">

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


                <form action="/admin/program/<?= esc($program['id']);?>" method="post" enctype="multipart/form-data">
                      <?= csrf_field() ?>
                    <div class="mb-4">
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="id" value="<?php echo $program['id'] ?>">
                    </div>
                    <div class="mb-4">
                        <label for="title" class="form-label">የፕሮግራም ምድብ ርዕስ</label>
                        <input type="title" class="form-control" value="<?= esc($program['title']) ?>" name="title" id="title" aria-describedby="emailHelp"
                            placeholder="ፕሮግራም ምድብ ርዕስ">
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label">የፕሮግራም ምስል</label>
                        <input type="file" class="form-control" name="image" id="image" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-4">
                        <select class="form-select" name="program_category_id" id="program_category_id" aria-label="Default select example">
                            <option selected>የፕሮግራም ምድብ ይምረጡ</option>
                            <?php foreach ($program_categories as $program_category): ?>
                                 <option value="<?= esc($program_category['id']) ?>"
                        <?= ($program_category['id'] == $program['category_id']) ? 'selected' : '' ?>>
                        <?= esc($program_category['title']) ?>
                    </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="description">የፕሮግራም ምድብ መግለጫ</label>
                        <textarea class="form-control" name="description" id="description"><?= esc($program['description']) ?></textarea>

                    </div>
                    <button type="submit" class="btn btn-primary">አስገባ</button>
                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.tiny.cloud/1/ogyofgs6ef1u3by9f9a5j52p20vtuhw58z7x7k5qns4wrlsb/tinymce/8/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>


    <script>
        tinymce.init({
            selector: 'textarea#description',
            height: 350,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic forecolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | link  | code',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    </script>
</section>

<?= $this->endSection() ?>