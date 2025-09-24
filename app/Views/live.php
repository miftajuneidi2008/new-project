<?= $this->extend('user/welcome_message') ?>
<?= $this->section('contents') ?>

<style>
    /* Main container for the live player */
    .live-player-container {
        max-width: 800px;
        margin: auto;
        background-color: #343a40;
        /* Dark background for the component */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Styling for the tab buttons (nav-pills) */
    .nav-pills .nav-link {
        background-color: #495057;
        /* Inactive tab background */
        color: #fff;
        border-radius: 6px;
        margin-right: 5px;
        font-weight: 500;
        transition: background-color 0.3s ease;
        border: none;
        /* Remove default borders */
    }

    /* Style for the active/selected tab */
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        background-color: #3b5998;
        /* Blue background for active tab */
        color: #fff;
    }

    /* Hover effect for inactive tabs */
    .nav-pills .nav-link:not(.active):hover {
        background-color: #6c757d;
    }

    /* Spacing for the content area */
    .tab-content {
        margin-top: 20px;
        background-color: #212529;
        /* Slightly darker background for content */
        padding: 20px;
        border-radius: 6px;
    }

    /* Space between icon and text */
    .nav-link i {
        margin-right: 8px;
    }

    /* --- MODIFICATION 1: Custom style for the dark audio player --- */
    .custom-audio-player {
        width: 100%;
        /* This tells the browser to use its built-in dark theme for the controls */
        color-scheme: dark;
    }
</style>
<div class="container mt-5 my-4">

    <div class="live-player-container">

        <!-- Bootstrap Nav Pills -->
        <ul class="nav nav-pills" id="liveTabs" role="tablist">
            <!-- Tab 1: Fana TV -->
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="fana-tv-tab" data-bs-toggle="pill" data-bs-target="#fana-tv"
                    type="button" role="tab" aria-controls="fana-tv" aria-selected="true">
                    <i class="bi bi-tv-fill"></i> ስልጤ ቲቪ ቅጥታ!
                </button>
            </li>
            <!-- Tab 2: Fana FM Radio -->
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="fana-fm-tab" data-bs-toggle="pill" data-bs-target="#fana-fm" type="button"
                    role="tab" aria-controls="fana-fm" aria-selected="false">
                    <i class="bi bi-mic-fill"></i> ስልጤ ፍም ቅጥታ!
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="liveTabsContent">
            <!-- Content for Fana TV -->
            <div class="tab-pane fade show active" id="fana-tv" role="tabpanel" aria-labelledby="fana-tv-tab">

                <!-- --- MODIFICATION 2: Make the video responsive and fill the width --- -->
                <!-- We wrap the iframe in a div with Bootstrap's ratio class -->
                <div class="ratio ratio-16x9">
                    <iframe src="https://embed.novastream.et/HbWSlLJTmbeal-FeBOYjRKac" title="NovaStream Video Player"
                        frameborder="0" allow="autoplay; fullscreen; picture-in-picture; encrypted-media; gyroscope;"
                        allowfullscreen referrerpolicy="no-referrer">
                    </iframe>
                </div>

            </div>
            <!-- Content for Fana FM Radio -->
            <div class="tab-pane fade" id="fana-fm" role="tabpanel" aria-labelledby="fana-fm-tab">
                <h5 class="text-white">ስልጤ ፍም ሬዲዮ ማጫወቻ</h5>
                <p class="text-secondary"> አሁን ፋና ፍም በቀጥታ በመጫወት ላይ።</p>

                <!-- --- MODIFICATION 3: Replace iframe with an HTML5 audio tag for styling --- -->
                <audio controls class="custom-audio-player" src="https://stream.zeno.fm/dfroy2it9yntv">

                    አሁን ፋና ፍም በቀጥታ በመጫወት ላይ።
                </audio>
            </div>
        </div>

    </div>

</div>
<?= $this->endSection() ?>