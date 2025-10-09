<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">

    <!-- Header with Back Button -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <a href="/admin" class="btn btn-outline">
            ተመለስ
        </a>
    </div>

    <!-- Section for Existing Schedules (Sample Data Cards) -->
    <h2 class="h4 mb-3">የአሁኑ መርሐግብሮች</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
        <?php if (!empty($about)): ?>
            <?php foreach ($about as $abouts): ?>
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary mb-2">መርሐግብር</h5>
                            <p class="card-text flex-grow-1 overflow-hidden" style="max-height: 100px;">
                                <?= substr(strip_tags($abouts['description']), 0, 150) . (strlen(strip_tags($abouts['description'])) > 150 ? '...' : '') ?>
                            </p>
                            <div class="mt-3">


                                <a href="<?= base_url('/admin/about/' . $abouts['id'] . '/edit') ?>"
                                    class="btn btn-sm btn-outline-info me-2">አስተካክል</a>

                                <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                                    data-url="<?= base_url('/admin/about/' . $abouts['id']) ?>">
                                    አጥፋ
                                </button>
                            </div>
                        </div>
                    </div>
                    <form id="deleteForm" method="post" class="d-none">
                        <?= csrf_field() ?>
                        <input type='hidden' name='_method' value='DELETE' />
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Find the single form
                            const deleteForm = document.getElementById('deleteForm');

                            // Find all delete buttons
                            const deleteButtons = document.querySelectorAll('.delete-btn');

                            // Add a click listener to each button
                            deleteButtons.forEach(button => {
                                button.addEventListener('click', function () {
                                    // Get the URL from the button's data-url attribute
                                    const deleteUrl = this.getAttribute('data-url');

                                    if (confirm('Do you really want to delete this record?')) {
                                        // Set the form's action to the correct URL
                                        deleteForm.setAttribute('action', deleteUrl);
                                        // Submit the form
                                        deleteForm.submit();
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    እስካሁን ምንም መረጃ የለም።
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Section for Adding New Schedule (Form) -->
    <h2 class="h4 mb-3">አዲስ መረጃ ያክሉ</h2>
    <div class="card shadow-lg mb-4">
        <div class="card-body">
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('message') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="/admin/about/" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="description" class="form-label fs-5">
                        የድርጅቱ መረጃ ዝርዝር</label>
                    <textarea class="form-control" name="description" id="description" rows="10"></textarea>
                    <div class="form-text">ዝርዝር መረጃ እዚህ ያስገቡ።</div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg mt-3">
                    <i class="fas fa-plus-circle me-2"></i> አስገባ
                </button>
            </form>
        </div>
    </div>

    <!-- TinyMCE Script (remains the same) -->
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
                'removeformat | link | code',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    </script>
</div>

<?= $this->endSection() ?>