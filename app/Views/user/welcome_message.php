<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Siltite fm</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?= $this->renderSection('meta') ?>

    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <!-- STYLES -->

    <link rel="stylesheet" href="/style.css">
    <style>
        .navbar .nav-item .nav-link.active {
            color: #e65c00 !important;
            border-bottom: 3px solid #e65c00;
            padding-bottom: 5px;
            width: max-content;
        }
    </style>
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
                            <a class="nav-link " aria-current="page" href="/"> ቅድመ ግፅ</a>
                        </li>
                        <li class="nav-item px-3 px-lg-2 py-1 py-lg-4">
                            <a class="nav-link " aria-current="page" href="/news">ዜና</a>
                        </li>
                        <li class="nav-item px-3 px-lg-2 py-1 py-lg-4">
                            <a class="nav-link " aria-current="page" href="/sport">ስፖርት</a>
                        </li>
                        <li class="nav-item px-3 px-lg-2 py-1 py-lg-4 ">
                            <a class="nav-link " aria-current="page" href="/business">ቢዝነስ</a>
                        </li>
                        <li class="nav-item px-3 px-lg-2 py-1 py-lg-4">
                            <a class="nav-link" aria-current="page" href="/program">ፕሮግራም</a>
                        </li>

                        </li>
                        <li class="nav-item px-3 px-lg-2 py-1 py-lg-4">
                            <a class="btn btn-outline-danger" aria-current="page" href="#" id="liveStreamButton">ቀጥታ</a>
                        </li>
                        <?php if (session()->get('isLoggedIn')): ?>
                            <li class="nav-item px-3 px-lg-2 py-1 py-lg-4">
                                <a class="btn btn-outline-primary" aria-current="page" href="<?= site_url('logout') ?>">
                                    ዉጣ
                                </a>
                            </li>

                        <?php else: ?>

                            <!-- User is not logged in, show a message -->
                            <li class="nav-item px-3 px-lg-2 py-1 py-lg-4">
                                <a class="btn btn-outline-primary" aria-current="page" href="/login">
                                    ግባ
                                </a>
                            </li>


                        <?php endif; ?>
                    </ul>



                </div>
            </div>
        </nav>
    </header>


    <section class="container-fluid">
        <?= $this->renderSection('contents') ?>
    </section>
    <!-- -->

    <footer class="footer-enhanced pt-5">
        <div class="container text-left">
            <div class="row gy-4">

                <!-- Column 1: About Us -->
                <div class="col-lg-3 col-md-6">
                    <h5>ስለ እኛ</h5>
                    <p>OBN Website is a part of Oromia Broadcasting Network (OBN), producing news, documentary and
                        programs in Afaan Oromoo language to reach our audiences in all over the world.</p>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-telegram"></i></a>
                        <a href="#"><i class="bi bi-tiktok"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <!-- Column 2: OBN Links -->
                <div class="col-lg-2 col-md-6 footer-links">
                    <h5>ስልጤ ፍም</h5>
                    <a href="#">Waa'ee OBN</a>
                    <a href="#">Teessoo</a>
                    <a href="#">Ergama</a>
                    <a href="#">Mul'ata</a>
                    <a href="#">Duudhaa</a>
                </div>

                <!-- Column 3: Recent Posts -->
                <div class="col-lg-4 col-md-6">
                    <h5>ብዙህ የተነበቡ ዜናዎች</h5>
                    <div class="recent-post mb-3">
                        <a href="#">Barataa Qormaata Biyyaalessaa Kutaa 12ffaan 600 keessaa qabxii 9 qofa dhabeen wal
                            baraa.</a>
                        <small class="d-block mt-1">ARTICLES · September 15, 2025</small>
                    </div>
                    <div class="recent-post">
                        <a href="#">Bara 2017 oomishtummaan aannanii harka 172'n guddate jedhe, Biiroon Qonnaa
                            Oromiyaa</a>
                        <small class="d-block mt-1">ODUU · September 8, 2025</small>
                    </div>
                </div>

                <!-- Column 4: Subscribe Form -->
                <div class="col-lg-3 col-md-6">
                    <h5>Subscribe</h5>
                    <p>Get the latest news and updates right in your inbox.</p>
                    <form>
                        <div class="mb-3">
                            <input type="email" class="form-control form-control-dark" placeholder="Email address">
                        </div>
                        <button type="submit" class="btn btn-subscribe w-100 py-2">I WANT IN <i
                                class="bi bi-arrow-right"></i></button>
                    </form>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="" id="privacyCheck">
                        <label class="form-check-label small" for="privacyCheck">
                            I've read and accept the <a href="#" class="privacy-link">Privacy Policy.</a>
                        </label>
                    </div>
                </div>

            </div>
        </div>

        <!-- Bottom Footer Bar -->
        <div class="footer-bottom text-center mt-5 py-3">
            <p class="mb-0 small">&copy; 2025 OBN Sagalee Ummataa. All Rights Reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Slick Carousel JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Script to initialize the Slick slider -->
    <script>
        $(document).ready(function () {
            $('.programme-slider').slick({
                dots: false,         // Hide the dots at the bottom
                infinite: false,     // Don't loop the slider
                speed: 500,          // Animation speed
                slidesToShow: 4,     // Number of items to show at once
                slidesToScroll: 1,   // Number of items to scroll at a time
                responsive: [
                    {
                        breakpoint: 992, // On tablets
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768, // On mobile
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 576, // On small mobile
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the current page's path
        const currentPage = window.location.pathname;

        // Get all the navigation links
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        // Loop through each link
        navLinks.forEach(link => {
            // If the link's href matches the current page
            if (link.getAttribute('href') === currentPage) {
                // Add the 'active' class to it
                link.classList.add('active');
            }
        });
    });
</script>

</body>

</html>