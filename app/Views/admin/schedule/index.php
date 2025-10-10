<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4 mx-2">

    <!-- Header with Back Button -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <a href="/admin" class="btn btn-outline">
            ተመለስ
        </a>
    </div>

    <!-- Section for Existing Schedules (Sample Data Cards) -->
    <h2 class="h4 mb-3">የአሁኑ መርሐግብር</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
        <?php if (!empty($schedule)): ?>

            <div class="col">
                <div class="card" style="width: 24rem;">
                    <div class="card-body">
                        <img src="<?= base_url('images/' . $schedule[0]['photo']) ?>" class="card-img-top" alt="አርማ"
                            style="width=300px; height: 200px; object-fit: cover;margin-bottom:10px;">
                                  <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                            data-bs-target="#editAddsModal" data-adds-id="<?= esc($schedule[0]['id']) ?>"
                            data-adds-content="<?= esc($schedule[0]['photo']) ?>">
                            አሻሽል
                        </button>
                           <form action="<?= base_url('admin/schedule/delete/' . esc($schedule[0]['id'])) ?>" method="post" class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this comment?');">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE"> <!-- Optional: for true RESTful routes -->
                            <button type="submit" class="btn btn-sm btn-outline-danger">ሰርዝ</button>
                        </form>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    እስካሁን ምንም መርሐግብር የለም።
                </div>
            </div>
        <?php endif; ?>



            <div class="modal fade" id="editAddsModal" tabindex="-1" aria-labelledby="editAddsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLinksModalLabel">መርሐግብር አሻሽል</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- The form's action URL will be set by our JavaScript -->
                    <form id="editLogoForm" action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="editCommentText" class="form-label">መርሐግብር:</label>
                                <!-- This textarea will be filled by our JavaScript -->
                                <input type="file" class="form-control" id="editAddsText" name="photo" 
                                   >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ይቅር
                               </button>
                            <button type="submit" class="btn btn-primary">አዘምን </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>




<!-- Section for Adding New Schedule (Form) -->
<h2 class="h4 mb-3">አዲስ ማስታወቂያ ያክሉ</h2>
<div class="card shadow-lg mb-4 col-12 col-md-8">
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

        <form action="/admin/schedule/" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="description" class="form-label fs-5">
                    ከዚህ በታች የማስታወቂያ መርሐግብር ያክሉ</label>
                <input type="file" class="form-control" name="photo" id="description">

            </div>

            <button type="submit" class="btn btn-primary btn-lg mt-3">
                <i class="fas fa-plus-circle me-2"></i> አስገባ
            </button>
        </form>
    </div>
</div>


</div>
</div>
<script>
    const editLogoModal = document.getElementById('editAddsModal'); // Use a unique variable name

    editLogoModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const logoId = button.getAttribute('data-adds-id');
        const modalForm = editLogoModal.querySelector('#editLogoForm');

        // Set the form's action URL with the correct ID
        modalForm.action = "<?= base_url('admin/schedule/update/') ?>" + logoId;
    });
</script>
<?= $this->endSection() ?>