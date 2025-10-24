<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('web.home') }}" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('env') }}/logo_text.png" alt="e-PacuJalur" style="height: 40px;">
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('web.home') }}" class="active">Beranda</a></li>
                <li><a href="{{ route('web.daftarjalur') }}">Daftar Jalur</a></li>
                <li><a href="{{ route('web.juarapacujalur') }}">Juara Pacu Jalur</a></li>
                <li><a href="{{ route('web.undianpacu') }}">Undian Pacu</a></li>
              
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted flex-md-shrink-0" href="{{ route('login') }}">Masuk</a>

    </div>
</header>