<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Siltite fm</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- STYLES -->

    <link rel="stylesheet" href="/style.css">
</head>

<body>

    <header class="bg-white shadow sticky-top">
        <nav class="navbar navbar-expand-lg py-4 py-lg-0  bg-white">
            <div class="container px-4">
                <img src="/logo.png" alt="siltie fm logo" width="80" height="50">
                <button class="navbar-toggler border-0 text-black" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#top-navbar" aria-controls="top-navbar">
                    <i class="bi bi-list"></i>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="top-navbar" aria-labelledby="top-navbarLabel">
                    <button class="navbar-toggler border-0 text-black" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#top-navbar" aria-controls="navbar">
                        <div class="d-flex justify-content-between p-3">
                            <p>Siltite fms</p>
                            <i class="bi bi-list"></i>
                        </div>

                    </button>

                    <ul class="navbar-nav ms-lg-auto p-4 p-lg-0">
                        <li class="nav-item px-3 px-lg-0 py-1 py-lg-4">
                            <a class="nav-link active" aria-current="page" href="#"> ቅድመ ግፅ</a>
                        </li>
                        <li class="nav-item px-3 px-lg-2 py-1 py-lg-4">
                            <a class="nav-link active" aria-current="page" href="#">ዜና</a>
                        </li>
                        <li class="nav-item px-3 px-lg-2 py-1 py-lg-4">
                            <a class="nav-link active" aria-current="page" href="#">ስፖርት</a>
                        </li>
                        <li class="nav-item px-3 px-lg-2 py-1 py-lg-4 ">
                            <a class="nav-link active" aria-current="page" href="#">ቢዝነስ</a>
                        </li>
                        <li class="nav-item px-3 px-lg-2 py-1 py-lg-4">
                            <a class="nav-link active" aria-current="page" href="#">ፕሮግራም</a>
                        </li>

                        </li>
                        <li class="nav-item px-3 px-lg-2 py-1 py-lg-4">
                            <a class="btn btn-outline-danger" aria-current="page" href="#"
                                id="liveStreamButton">ቀጥታ</a>
                        </li>
                        <li class="nav-item px-3 px-lg-2 py-1 py-lg-4">
                            <a class="btn btn-outline-primary" aria-current="page"
                                href="/login">
                                ግባ
                            </a>
                        </li>
                    </ul>
                    <audio id="liveStreamAudio"
                        src="https://stream.zeno.fm/dfroy2it9yntv?an-uid=6928502853161380572&dot-uid=0c63220400ff218f324fb0f1&amb-uid=7372208072735124659&dbm-uid=CAESEFr0pgbP0EgQ12QbO6Mq4l0&cto-uid=f6c70d17-0849-49f0-97d4-a5ac03b5e66e-68ad8cfa-4554&bsw-uid=eb514ffd-5501-4002-b137-e7cee7ba4cd4&dyn-uid=5056197159886288854&ttd-uid=0093d478-b587-4fc5-983b-915a5f2dae90&aw_0_req_lsid=2c697dacb9b31c8c1d75f02f9d5f0410"
                        preload="none"></audio>


                </div>
            </div>
        </nav>
    </header>


    <section class="container-fluid">
    <?= $this->renderSection('contents') ?>
    </section>
    <!-- -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">

            document.addEventListener('DOMContentLoaded', function () {
                const liveStreamButton = document.getElementById('liveStreamButton');
                const liveStreamAudio = document.getElementById('liveStreamAudio');
                const playPauseIcon = document.getElementById('playPauseIcon');
                const playPauseText = document.getElementById('playPauseText'); // Get the text span

                let isPlaying = false; // Initial state: Not playing

                liveStreamButton.addEventListener('click', function (event) {
                    event.preventDefault(); // Prevent default link behavior

                    if (isPlaying) {
                        // If currently playing, pause it
                        liveStreamAudio.pause();
                        playPauseIcon.classList.remove('bi-pause-fill');
                        playPauseIcon.classList.add('bi-play-fill');
                        playPauseText.textContent = 'Listen'; // Change text to Listen
                        isPlaying = false;
                    } else {
                        // If currently paused or stopped, play it
                        // Attempt to play the audio
                        liveStreamAudio.play()
                            .then(() => {
                                // Playback started successfully
                                playPauseIcon.classList.remove('bi-play-fill');
                                playPauseIcon.classList.add('bi-pause-fill');
                                playPauseText.textContent = 'Pause'; // Change text to Pause
                                isPlaying = true;
                            })
                            .catch(error => {
                                // Autoplay was prevented or other error occurred
                                console.error("Error playing audio:", error);
                                // Provide user feedback
                                alert("Could not play the live stream. Your browser might require user interaction to start audio.");
                                // Reset UI to 'Listen' state if playback failed
                                playPauseIcon.classList.remove('bi-pause-fill');
                                playPauseIcon.classList.add('bi-play-fill');
                                playPauseText.textContent = 'Listen';
                                isPlaying = false;
                            });
                    }
                });

                // Optional: Event listener for when the audio actually pauses (e.g., if network drops)
                liveStreamAudio.addEventListener('pause', function () {
                    if (isPlaying) { // Only update if it was actually playing and paused unexpectedly
                        isPlaying = false;
                        playPauseIcon.classList.remove('bi-pause-fill');
                        playPauseIcon.classList.add('bi-play-fill');
                        playPauseText.textContent = 'Listen';
                    }
                });

                // Optional: Event listener for when the audio actually plays (e.g., after loading)
                liveStreamAudio.addEventListener('play', function () {
                    // This can be useful for initial state or if some other script plays it
                    if (!isPlaying) { // Only update if it was not already marked as playing
                        isPlaying = true;
                        playPauseIcon.classList.remove('bi-play-fill');
                        playPauseIcon.classList.add('bi-pause-fill');
                        playPauseText.textContent = 'Pause';
                    }
                });

                // Optional: Handle errors during playback (e.g., stream unavailable)
                liveStreamAudio.addEventListener('error', function () {
                    console.error("Audio error occurred. Check stream URL or network connection.");
                    alert("An error occurred while playing the live stream. It might be temporarily unavailable. Please try again later.");
                    isPlaying = false;
                    playPauseIcon.classList.remove('bi-pause-fill');
                    playPauseIcon.classList.add('bi-play-fill');
                    playPauseText.textContent = 'Listen';
                });
            });



        </script>

</body>

</html>