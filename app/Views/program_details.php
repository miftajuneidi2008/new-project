<?= $this->extend('user/welcome_message') ?>
<?php $this->section('meta'); ?>

<?php
// Prepare data for meta tags
$ogTitle = esc($program['title']);
$ogDescription = esc(substr(strip_tags($program['description']), 0, 155)) . '...';
$ogImage = base_url('images/' . $program['photo']);
$ogUrl = current_url(true);
?>
<!-- Basic Meta Tags -->
<meta name="description" content="<?= $ogDescription ?>">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="article">
<meta property="og:url" content="<?= $ogUrl ?>">
<meta property="og:title" content="<?= $ogTitle ?>">
<meta property="og:description" content="<?= $ogDescription ?>">
<meta property="og:image" content="<?= $ogImage ?>">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?= $ogUrl ?>">
<meta property="twitter:title" content="<?= $ogTitle ?>">
<meta property="twitter:description" content="<?= $ogDescription ?>">
<meta property="twitter:image" content="<?= $ogImage ?>">
<?php $this->endSection(); ?>


<?= $this->section('contents') ?>
<?php use CodeIgniter\I18n\Time; ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Main News Content Column -->
        <div class="col-lg-7">

            <h1 class="display-5 fw-bold mb-3"><?= esc($program['title']) ?></h1>

            <!-- Main Image -->
            <img src="<?= base_url('images/' . $program['photo']) ?>" class="img-fluid rounded mb-2 w-100"
                alt="<?= esc($program['title']) ?>">

            <!-- Meta Information -->
            <div class="news-meta text-muted mb-4">
                <span><i class="bi bi-person-fill"></i> <?= esc($program['author_name'] ?? 'Unknown Author') ?></span>
                <span class="ms-3"><i class="bi bi-clock"></i>
                    <?= (new Time($program['created_at']))->format('M j, Y') ?></span>
            </div>

            <!-- Full Description -->
            <div class="news-content lead">
                <?= nl2br($program['description']) ?>
            </div>

            <div class="social-share my-4">
                <h5 class="fw-bold mb-3">Share this article:</h5>

                <?php
                // Prepare the data for the share links
                $shareUrl = urlencode(current_url(true)); // The full URL of the current page
                $shareTitle = urlencode($program['id']); // The title of the news article
                ?>

                <div class="d-flex gap-2">
                    <!-- Facebook Share Button -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $shareUrl ?>" target="_blank"
                        rel="noopener noreferrer" class="btn btn-outline-primary d-inline-flex align-items-center">
                        <i class="bi bi-facebook me-2"></i> Facebook
                    </a>

                    <!-- Twitter Share Button -->
                    <a href="https://twitter.com/intent/tweet?url=<?= $shareUrl ?>" target="_blank"
                        rel="noopener noreferrer" class="btn btn-outline-info d-inline-flex align-items-center">
                        <i class="bi bi-twitter me-2"></i> Twitter
                    </a>

                    <!-- Telegram Share Button -->
                    <a href="https://t.me/share/url?url=<?= $shareUrl ?>" target="_blank" rel="noopener noreferrer"
                        class="btn btn-outline-secondary d-inline-flex align-items-center">
                        <i class="bi bi-telegram me-2"></i> Telegram
                    </a>
                </div>
            </div>

            <hr class="my-5">
            <?php
            // Use the session() helper to check if the 'isLoggedIn' key exists and is true
            if (session()->get('isLoggedIn')): ?>
                <div class="my-2">
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
                    <form action="/post/<?= esc($program['id']) ?>" method="post">
                        <div class="mb-3">
                            <label for="comment" class="form-label">አስተያየት ይስጡ:</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"
                                placeholder="እባኮትን እዚህ ይጻፉ..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">አስተያየት ይስጡ</button>
                    </form>
                </div>
            <?php else: ?>

                <!-- User is not logged in, show a message -->
                <p>
                    አስተያየት ለመስጠት እባክዎ <a href="/login">ይግቡ።</a></p>

            <?php endif; ?>
            <?php if (!empty($program['comments'])): ?>
                <?php foreach ($program['comments'] as $comment): ?>
                    <div class="comment my-4">
                        <strong><?= esc($comment['commenter_name']) ?></strong>
                        <small>on <?= (new Time($comment['created_at']))->format('M j, Y') ?></small>
                        <p><?= esc($comment['comment']) ?></p>




                        <?php if (session()->get('isLoggedIn')): ?>
                            <div class="">
                                <?php // Condition 1: User is the owner of the comment. Show Edit and Delete. ?>
                                <?php if (session()->get('userId') == $comment['user_id']): ?>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#editCommentModal" data-comment-id="<?= $comment['id'] ?>"
                                        data-comment-content="<?= esc($comment['comment']) ?>">
                                        አሻሽል
                                    </button>

                                    <!-- Use a form for delete for security (prevents CSRF) -->
                                    <form action="/post-comments/delete/<?= $comment['id'] ?>" method="post" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE"> <!-- Optional: for true RESTful routes -->
                                        <button type="submit" class="btn btn-sm btn-outline-danger">ሰርዝ</button>
                                    </form>

                                    <?php // Condition 2: User is an admin (but not the owner). Show Delete only. ?>
                                <?php elseif (session()->get('userRole') == 'admin'): ?>
                                    <form action="/post-comments/delete/<?= $comment['id'] ?>" method="post" class="d-inline"
                                        onsubmit="return confirm('ADMIN ACTION: Are you sure you want to delete this comment?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">ሰርዝ (Admin)</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php // --- END: Action Buttons Logic --- ?>




                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>
                    እስካሁን ምንም አስተያየት የለም። አስተያየት ለመስጠት የመጀመሪያው ይሁኑ!</p>
            <?php endif; ?>
        </div>

        <!-- Popular News Sidebar Column -->
        <div class="col-lg-4 mt-lg-5">
            <!-- 1. This inner div is the key. It will be the sticky element. -->
            <!-- 2. The 'top' style adds space from the top, e.g., to clear a fixed navbar. Adjust as needed. -->
            <div class="sticky-sidebar">
                <div class="popular-news-widget p-4">
                    <h4 class="mb-4">በብዛት የተነበቡ</h4>
                    <ol class="popular-news-list">
                        <?php foreach ($popular as $popular_data): ?>
                            <li><a href="/post/<?= esc($popular_data['id']) ?>"><?= esc($popular_data['title']) ?> </a></li>
                        <?php endforeach ?>

                    </ol>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommentModalLabel">አስተያየት አሻሽል (Edit Comment)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- The form's action URL will be set by our JavaScript -->
            <form id="editCommentForm" action="" method="post">
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="editCommentText" class="form-label">አስተያየት:</label>
                        <!-- This textarea will be filled by our JavaScript -->
                        <textarea class="form-control" id="editCommentText" name="comment" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ይቅር (Cancel)</button>
                    <button type="submit" class="btn btn-primary">አዘምን (Update)</button>
                </div>
            </form>

        </div>
    </div>
</div>
    </div>
    <script>
        // Get a reference to the modal element
        const editModal = document.getElementById('editCommentModal');

        // Listen for the Bootstrap 'show.bs.modal' event
        editModal.addEventListener('show.bs.modal', function (event) {
            // Get the button that triggered the modal
            const button = event.relatedTarget;

            // Extract data from the data-* attributes on the button
            const commentId = button.getAttribute('data-comment-id');
            const commentContent = button.getAttribute('data-comment-content');

            // Find the form and the textarea inside the modal
            const modalForm = editModal.querySelector('#editCommentForm');
            const modalTextarea = editModal.querySelector('#editCommentText');

            // Update the form's action attribute to point to the correct update URL
            modalForm.action = '/post-comments/update/' + commentId;

            // Populate the textarea with the current comment content
            modalTextarea.value = commentContent;
        });
    </script>
</div>



<?= $this->endSection() ?>