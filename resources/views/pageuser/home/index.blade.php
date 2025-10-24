@extends('template-web.layout')

@section('content')
<!-- Hero Section -->
<section id="hero" class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">Selamat Datang di e-PacuJalur</h1>
                <h2 data-aos="fade-up" data-aos-delay="400">Sistem Manajemen Publikasi Pacu Jalur Digital</h2>
                <div data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center text-lg-start">
                        <a href="{{ route('web.daftarjalur') }}" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                            <span>Jelajahi Jalur</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{ asset('env') }}/logo.png" class="img-fluid" alt="e-PacuJalur">
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="about">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0">
            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="content">
                    <h3>Tentang e-PacuJalur</h3>
                    <h2>Sistem Digital untuk Manajemen Pacu Jalur</h2>
                    <p>
                        e-PacuJalur adalah platform digital yang memudahkan pengelolaan dan publikasi informasi 
                        terkait pacu jalur, mulai dari daftar jalur, juara pacu jalur, hingga undian pacu. 
                        Sistem ini dirancang untuk memberikan kemudahan akses informasi bagi semua pihak 
                        yang terlibat dalam dunia pacu jalur.
                    </p>
                    <div class="text-center text-lg-start">
                        <a href="{{ route('web.daftarjalur') }}" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                            <span>Lihat Daftar Jalur</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="300">
                <img src="{{ asset('landing') }}/assets/img/about.jpg" class="img-fluid" alt="About e-PacuJalur">
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="services">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>Fitur Utama</h2>
            <p>Kemudahan yang kami berikan untuk pengelolaan pacu jalur</p>
        </header>

        <div class="row gy-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-box blue">
                    <i class="ri-road-map-line icon"></i>
                    <h3>Daftar Jalur</h3>
                    <p>Lihat daftar lengkap jalur pacu dengan informasi detail seperti asal jalur, tahun pembuatan, dan deskripsi.</p>
                    <a href="{{ route('web.daftarjalur') }}" class="read-more"><span>Lihat Detail</span> <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-box orange">
                    <i class="ri-trophy-line icon"></i>
                    <h3>Juara Pacu Jalur</h3>
                    <p>Informasi lengkap tentang juara pacu jalur berdasarkan event, gelanggang, dan tahun.</p>
                    <a href="{{ route('web.juarapacujalur') }}" class="read-more"><span>Lihat Detail</span> <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="service-box green">
                    <i class="ri-calendar-check-line icon"></i>
                    <h3>Undian Pacu</h3>
                    <p>Jadwal dan informasi undian pacu dengan detail event, gelanggang, tanggal, dan jam.</p>
                    <a href="{{ route('web.undianpacu') }}" class="read-more"><span>Lihat Detail</span> <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Events Section -->
@if($events->count() > 0)
<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>Event Terbaru</h2>
            <p>Daftar event pacu jalur terbaru</p>
        </header>

        <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
            @foreach($events as $event)
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <div class="portfolio-wrap">
                    <img src="{{ asset('image/event/' . $event->gambar) }}" class="img-fluid" alt="{{ $event->nama_event }}">
                    <div class="portfolio-info">
                        <h4>{{ $event->nama_event }}</h4>
                        <p>{{ Str::limit($event->deskripsi, 100) }}</p>
                        <div class="portfolio-links">
                            <a href="{{ asset('image/event/' . $event->gambar) }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{ $event->nama_event }}"><i class="bi bi-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Recent Jalur Section -->
@if($jalurs->count() > 0)
<section id="recent-posts" class="recent-posts">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>Jalur Terbaru</h2>
            <p>Daftar jalur pacu terbaru yang telah ditambahkan</p>
        </header>

        <div class="row gy-4">
            @foreach($jalurs as $jalur)
            <div class="col-lg-4">
                <article class="d-flex flex-column">
                    <div class="post-img">
                        <img src="{{ asset('image/jalur/' . $jalur->gambar) }}" alt="{{ $jalur->nama_jalur }}" class="img-fluid">
                    </div>
                    <h2 class="title">
                        <a href="{{ route('web.daftarjalur.detail', $jalur->id) }}">{{ $jalur->nama_jalur }}</a>
                    </h2>
                    <div class="meta-top">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-geo-alt"></i> {{ $jalur->asal_jalur }}</li>
                            <li class="d-flex align-items-center"><i class="bi bi-calendar"></i> {{ $jalur->tahun_buat }}</li>
                        </ul>
                    </div>
                    <div class="content">
                        <p>{{ Str::limit($jalur->deskripsi, 150) }}</p>
                    </div>
                    <div class="read-more mt-auto align-self-start">
                        <a href="{{ route('web.daftarjalur.detail', $jalur->id) }}">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Stats Section -->
<section id="stats" class="stats">
    <div class="container" data-aos="fade-up">
        <div class="row gy-4">
            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-road-map color-blue flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $jalurs->count() }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Jalur Pacu</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-calendar-event color-orange flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $events->count() }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Event</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-trophy color-green flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $juaraPacuJalur->count() }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Juara</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                    <i class="bi bi-calendar-check color-pink flex-shrink-0"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $undianPacu->count() }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Undian</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>Kontak</h2>
            <p>Hubungi kami untuk informasi lebih lanjut</p>
        </header>

        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Alamat</h3>
                            <p>Jl. Pacu Jalur No. 123<br>Kota Pacu, 12345</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-telephone"></i>
                            <h3>Telepon</h3>
                            <p>+62 123 456 7890</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p>info@epacujalur.com</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-clock"></i>
                            <h3>Jam Operasional</h3>
                            <p>Senin - Jumat: 08:00 - 17:00</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <form action="forms/contact.php" method="post" class="php-email-form">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="col-md-6 ">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="subject" placeholder="Subjek" required>
                        </div>
                        <div class="col-md-12">
                            <textarea class="form-control" name="message" rows="6" placeholder="Pesan" required></textarea>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Pesan Anda telah terkirim. Terima kasih!</div>
                            <button type="submit">Kirim Pesan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection