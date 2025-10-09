<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>
<section>

    <div class="container mt-5">

        <a href="/admin/schedule" class="btn btn-light mb-4">ተመለስ</a>
        <!-- 2. Create a row. Use flexbox utilities to center the column inside it -->
        <div class="row">


            <div class="col-md-8 col-lg-10 card py-2 px-5">

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


                <form  action="/admin/schedule/<?= esc($schedule['id']);?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-4">
                        <input type="hidden" name="_method" value="PUT" />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fs-5">የመርሐግብር ዝርዝር</label>
                        <textarea class="form-control" name="description" id="description" rows="10"><?= esc($schedule['description']) ?></textarea>
                        <div class="form-text">ዝርዝር መርሐግብር እዚህ ያስገቡ።</div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg mt-3">
                        <i class="fas fa-plus-circle me-2"></i> አስገባ
                    </button>

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