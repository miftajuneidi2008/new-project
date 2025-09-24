<?= $this->extend('user/welcome_message') ?>
<?= $this->section('contents') ?>
<section>
    <!-- This is where the JavaScript will place the video player -->
    <div id="video-container"></div>
    <script>
        // Wait until the entire page is loaded before running the script
        document.addEventListener('DOMContentLoaded', function () {

            // 1. Define the video URL
            const videoUrl = 'https://embed.novastream.et/HbWSlLJTmbeal-FeBOYjRKac';

            // 2. Find the container element on the page
            const videoContainer = document.getElementById('video-container');

            // 3. Create a new iframe element in memory
            const iframe = document.createElement('iframe');

            // 4. Set all the necessary attributes for the iframe
            iframe.src = videoUrl;
            iframe.width = '640';
            iframe.height = '360';
            iframe.frameBorder = '0';
            iframe.setAttribute('allowfullscreen', 'true'); // Use setAttribute for boolean attributes

            // 5. Add the newly created iframe to the container div
            if (videoContainer) {
                videoContainer.appendChild(iframe);
            } else {
                console.error('Video container not found!');
            }
        });
    </script>
</section>
<?= $this->endSection() ?>