<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>

<section>
    <div class="d-flex justify-content-between align-items-center mt-4 mx-2">
        <h2>የቀጥታ አገናኝ</h2>
        <div class="d-flex gap-2">
            <a href="https://www.facebook.com/yourpage" target="_blank" class="btn btn-light">መርሐግብር ጨምር</a>
            <a href="/admin/site-link" class="btn btn-light">ማገናኛ አስገባ</a>
            <a href="/admin/logo" class="btn btn-light">አርማ አስገባ</a>
        </div>
    </div>
    <div class="container my-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gap-5">
            <div class="card" style="width: 24rem;">

                <div class="card-body">
                    <h5 class="card-title">የአሁኑ አርማ</h5>
                    <?php if (!empty($logo)): ?>

                        <img src="<?= base_url('images/' . $logo[0]['url']) ?>" class="card-img-top" alt="አርማ"
                            style="width=300px; height: 150px; object-fit: contain;">
                              <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                            data-bs-target="#editLogoModal" data-logo-id="<?= esc($logo[0]['id']) ?>"
                            data-logo-content="<?= esc($logo[0]['url']) ?>">
                            አሻሽል
                        </button>
                    <?php endif; ?>
                </div>
            </div>


            <div class="card" style="width: 24rem; height:max-content;">

                <div class="card-body">
                    <h5 class="card-title">የአሁኑ የድምጽ ማገናኛ</h5>
                    <?php if (!empty($audio)): ?>
                        <p> <?= esc($audio['url']) ?> </p>

                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                            data-bs-target="#editLinksModal" data-comment-id="<?= esc($audio['id']) ?>"
                            data-comment-content="<?= esc($audio['url']) ?>">
                            አሻሽል
                        </button>

                        <!-- Use a form for delete for security (prevents CSRF) -->
                        <form action="<?= base_url('admin/links/delete/' . esc($audio['id'])) ?>" method="post" class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this comment?');">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE"> <!-- Optional: for true RESTful routes -->
                            <button type="submit" class="btn btn-sm btn-outline-danger">ሰርዝ</button>
                        </form>
                    <?php endif; ?>

                </div>
            </div>

            <div class="card" style="width: 24rem; height:max-content;">

                <div class="card-body">
                    <h5 class="card-title">
                        የአሁኑ የቪዲዮ አገናኝ</h5>

                    <?php if (!empty($video)): ?>
                        <p> <?= esc($video['url']) ?> </p>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                            data-bs-target="#editLinksModal" data-comment-id="<?= esc($video['id']) ?>"
                            data-comment-content="<?= esc($video['url']) ?>">
                            አሻሽል
                        </button>

                        <!-- Use a form for delete for security (prevents CSRF) -->
                        <form action="<?= base_url('admin/links/delete/' . esc($video['id'])) ?>" method="post" class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this comment?');">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE"> <!-- Optional: for true RESTful routes -->
                            <button type="submit" class="btn btn-sm btn-outline-danger">ሰርዝ</button>
                        </form>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="modal fade" id="editLinksModal" tabindex="-1" aria-labelledby="editLinksModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLinksModalLabel">አስተያየት አሻሽል</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- The form's action URL will be set by our JavaScript -->
                    <form id="editLinksForm" action="" method="post">
                        <div class="modal-body">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="editCommentText" class="form-label">አስተያየት:</label>
                                <!-- This textarea will be filled by our JavaScript -->
                                <textarea class="form-control" id="editCommentText" name="link" rows="5"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ይቅር
                                </button>
                            <button type="submit" class="btn btn-primary">አዘምን</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

          <div class="modal fade" id="editLogoModal" tabindex="-1" aria-labelledby="editLogoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLinksModalLabel">አርማ አሻሽል</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- The form's action URL will be set by our JavaScript -->
                    <form id="editLogoForm" action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="editCommentText" class="form-label">አርማ:</label>
                                <!-- This textarea will be filled by our JavaScript -->
                                <input type="file" class="form-control" id="editLogoText" name="logo" 
                                    required>
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

    <script>
        // Get a reference to the modal element
        const editModal = document.getElementById('editLinksModal');

        // Listen for the Bootstrap 'show.bs.modal' event
        editModal.addEventListener('show.bs.modal', function (event) {
            // Get the button that triggered the modal
            const button = event.relatedTarget;

            // Extract data from the data-* attributes on the button
            const commentId = button.getAttribute('data-comment-id');
            const commentContent = button.getAttribute('data-comment-content');

            // Find the form and the textarea inside the modal
            const modalForm = editModal.querySelector('#editLinksForm');
            const modalTextarea = editModal.querySelector('#editCommentText');


            modalForm.action = '/admin/links/update/' + commentId;

            // Populate the textarea with the current comment content
            modalTextarea.value = commentContent;
        });
    </script>
<script>
    const editLogoModal = document.getElementById('editLogoModal'); // Use a unique variable name

    editLogoModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const logoId = button.getAttribute('data-logo-id');
        const modalForm = editLogoModal.querySelector('#editLogoForm');

        // Set the form's action URL with the correct ID
        modalForm.action = "<?= base_url('admin/logo/update/') ?>" + logoId;
    });
</script>
</section>
<?= $this->endSection() ?>