<?= $this->extend('user/welcome_message') ?>
<?= $this->section('contents') ?>
<div class="container my-5">
    <!-- Add the custom class 'video-layout-row' to the main row -->
    <div class="row video-layout-row">

        <!-- ========== Left Column: Featured Video ========== -->
        <div class="col-lg-7 h-100">
            <!-- The video-item will fill the height of this column -->
            <div class="video-item featured-video">
                <img src="https://images.pexels.com/photos/2062881/pexels-photo-2062881.jpeg" alt="Featured Video Thumbnail">
                <div class="video-tag">የቀጥታ ስርጭት</div>
                <div class="video-overlay">
                    <h3 class="video-title">ኢትዮጵያና የዓለም ባንክ የግንኙነት ምዕራፎችና ቀጣይ አቅጣጫዎች – የጠቅላይ ሚኒስትሩ ማብራሪያ</h3>
                    <p class="video-date">Sep 17, 2025</p>
                </div>
            </div>
        </div>

        <!-- ========== Right Column: Other Videos ========== -->
        <!-- Use d-flex and flex-column to stack the items vertically. 'gap-4' adds space between them. -->
        <div class="col-lg-5 h-100 d-flex flex-column gap-lg-4 right-column">

            <!-- Video 1: 'flex-grow-1' makes it take up available space -->
            <div class="video-item flex-grow-1">
                <img src="https://images.pexels.com/photos/11614980/pexels-photo-11614980.jpeg" alt="Video Thumbnail 1">
                <div class="video-tag">የቀጥታ ስርጭት</div>
                <div class="video-overlay">
                    <h5 class="video-title">የኢትዮጵያ ብልጽግና አደናቃፊ ጉዳዮች – ጠቅላይ ሚኒስትር ዐቢይ አሕመድ (ዶ/ር)</h5>
                    <p class="video-date">Sep 16, 2025</p>
                </div>
            </div>

            <!-- Video 2: 'flex-grow-1' makes it take up available space -->
            <div class="video-item flex-grow-1">
                <img src="https://images.pexels.com/photos/6020736/pexels-photo-6020736.jpeg" alt="Video Thumbnail 2">
                <div class="video-overlay">
                    <h5 class="video-title">ጠቅላይ ሚኒስትር ዐቢይ (ዶ/ር) የተገኙበት 'የመስቀል ደመራ' ...</h5>
                    <p class="video-date">Sep 15, 2025</p>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>