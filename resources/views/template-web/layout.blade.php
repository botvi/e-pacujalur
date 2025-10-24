<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>e-PacuJalur</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('landing') }}/assets/img/favicon.png" rel="icon">
    <link href="{{ asset('landing') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('landing') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('landing') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('landing') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('landing') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('landing') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('landing') }}/assets/css/main.css" rel="stylesheet">

    @yield('styles')
    <!-- =======================================================
  * Template Name: FlexStart
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Updated: Nov 01 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  @include('template-web.header')

  @yield('content')

  

    <footer id="footer" class="footer">

        <div class="container footer-top py-4">
            <div class="row gy-4 justify-content-between align-items-center">
                <div class="col-lg-5 col-md-6 footer-about mb-3 mb-md-0">
                    <a href="{{ route('web.home') }}" class="d-flex align-items-center text-decoration-none mb-2">
                        <img src="{{ asset('env') }}/logo_text.png" alt="e-PacuJalur" height="32" class="me-2">
                        <span class="sitename h5 mb-0" style="color: #667eea;">e-PacuJalur</span>
                    </a>
                    <div class="footer-contact pt-2 small">
                        <p><i class="bi bi-geo-alt me-2"></i>Kuansing, Riau, Indonesia</p>
                        <p><i class="bi bi-envelope me-2"></i><a href="mailto:info@epacujalur.com" class="text-decoration-none">info@epacujalur.com</a></p>
                        <p><i class="bi bi-whatsapp me-2"></i><a href="https://wa.me/6282399999999" class="text-decoration-none">+62 823-9999-9999</a></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 footer-links mb-3 mb-md-0">
                    <h5 class="mb-2" style="color: #667eea;">Navigasi</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('web.home') }}"><i class="bi bi-chevron-right"></i> Beranda</a></li>
                        <li><a href="{{ route('web.daftarjalur') }}"><i class="bi bi-chevron-right"></i> Daftar Jalur</a></li>
                        <li><a href="{{ route('web.juarapacujalur') }}"><i class="bi bi-chevron-right"></i> Juara Pacu Jalur</a></li>
                        <li><a href="{{ route('web.undianpacu') }}"><i class="bi bi-chevron-right"></i> Undian Pacu</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-12 text-lg-end text-md-end">
                    <h5 class="mb-2" style="color: #667eea;">Ikuti Kami</h5>
                    <div class="social-links d-flex justify-content-lg-end justify-content-md-end gap-2">
                        <a href="https://facebook.com/" target="_blank" class="text-dark"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="https://instagram.com/" target="_blank" class="text-dark"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="https://wa.me/6282399999999" target="_blank" class="text-dark"><i class="bi bi-whatsapp fs-4"></i></a>
                        <a href="mailto:info@epacujalur.com" class="text-dark"><i class="bi bi-envelope fs-4"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p class="mb-1">e-PacuJalur &copy; {{ date('Y') }} - Seluruh hak cipta dilindungi. </p>
            <div class="small text-muted">Website informasi Pacu Jalur Kabupaten Kuantan Singingi — Pengembangan Komunitas</div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('landing') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('landing') }}/assets/vendor/php-email-form/validate.js"></script>
    <script src="{{ asset('landing') }}/assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('landing') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('landing') }}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('landing') }}/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('landing') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('landing') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('landing') }}/assets/js/main.js"></script>
    @yield('scripts')
</body>

</html>
