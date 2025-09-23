<?= $this->extend('user/welcome_message') ?>
<?= $this->section('contents') ?>
<style>
    .program-section {
        padding-top: 1rem;
        padding-bottom: 5rem;
    }

    .section-title {
        font-weight: 400;
        font-size: 2.75rem;
        color: #343a40;
    }

    .program-card {
        border: none;
        /* Remove the default card border */
        border-radius: 0.5rem;
        /* Slightly more rounded corners */
        background-color: #ffffff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        /* Softer, more subtle shadow */
        /* --- This is for the hover effect --- */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    /* --- Bootstrap Hover Effect --- */
    .program-card:hover {
        transform: scale(1.05);
        transition: all ease-in-out 0.3s;
    }

    /* --- End of Hover Effect --- */


    .card-img-top {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .card-body {
        padding: 1.75rem;
        /* Increased padding for more white space */
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #212529;
    }

    .card-text {
        color: #6c757d;
        /* Lighter text color for the description */
        font-size: 1rem;
        line-height: 1.6;
    }

    .card-footer {
        background-color: #ffffff;
        /* Match the card's background */
        border-top: 1px solid #f1f1f1;
        /* A very light border for separation */
        border-bottom-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
    }
</style>
</style>
<div class="container program-section">
    <h2 class="text-center mb-5 section-title">ፕሮግራሞች</h2>
    <?php if (!empty($program_category)): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">


            <?php foreach ($program_category as $program_info): ?>
                <div class="col">
                    <div class="card h-100 program-card">

                        <img src="<?= base_url('images/' . $program_info['photo']) ?>" class="card-img-top"
                            style="height: 300px; object-fit: cover;" alt="<?= esc($program_info['title']) ?>">
                        <div class="card-body">
                             <a href="<?= site_url('programs/' . $program_info['id']) ?>" class="card-title stretched-link text-decoration-none text-dark">
                        <?= esc($program_info['title']) ?>
                    </a>
                            <p class="card-text"><?= $program_info['description'] ?></p>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>
                እስካሁን ምንም አስተያየት የለም። አስተያየት ለመስጠት የመጀመሪያው ይሁኑ!</p>
        <?php endif; ?>
    </div>

</div>
<?= $this->endSection() ?>