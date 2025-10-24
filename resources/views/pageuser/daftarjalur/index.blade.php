@extends('template-web.layout')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-header-content">
                    <h1>Daftar Jalur Pacu</h1>
                    <p>Jelajahi koleksi lengkap jalur pacu dari berbagai daerah</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jalur Section -->
<section id="jalur" class="jalur">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-12">
                <!-- Search Form -->
                <div class="search-section mb-4">
                    <form method="GET" action="{{ route('web.daftarjalur') }}" class="search-form">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control" 
                                           name="search" 
                                           value="{{ request('search') }}" 
                                           placeholder="Cari berdasarkan nama jalur, asal jalur, tahun, atau deskripsi...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i> Cari
                                    </button>
                                    @if(request('search'))
                                    <a href="{{ route('web.daftarjalur') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-x-circle"></i> Reset
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Results Info -->
                @if(request('search'))
                <div class="search-results-info mb-3">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i>
                        Menampilkan {{ $jalurs->total() }} hasil untuk pencarian "<strong>{{ request('search') }}</strong>"
                    </div>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Gambar</th>
                                <th width="20%">Nama Jalur</th>
                                <th width="15%">Asal Jalur</th>
                                <th width="10%">Tahun Buat</th>
                                <th width="25%">Deskripsi</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jalurs as $index => $jalur)
                            <tr>
                                <td>{{ $jalurs->firstItem() + $index }}</td>
                                <td>
                                    <img src="{{ asset('image/jalur/' . $jalur->gambar) }}" 
                                         class="img-thumbnail" 
                                         alt="{{ $jalur->nama_jalur }}"
                                         style="width: 80px; height: 60px; object-fit: cover;">
                                </td>
                                <td>
                                    <strong>{{ $jalur->nama_jalur }}</strong>
                                </td>
                                <td>
                                    <i class="bi bi-geo-alt text-primary"></i>
                                    {{ $jalur->asal_jalur }}
                                </td>
                                <td>
                                    <i class="bi bi-calendar text-success"></i>
                                    {{ $jalur->tahun_buat }}
                                </td>
                                <td>
                                    <small class="text-muted">{{ Str::limit($jalur->deskripsi, 80) }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ asset('image/jalur/' . $jalur->gambar) }}" 
                                           data-gallery="jalurGallery" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Lihat Gambar">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('web.daftarjalur.detail', $jalur->id) }}" 
                                           class="btn btn-sm btn-primary" 
                                           title="Lihat Detail">
                                            <i class="bi bi-info-circle"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="bi bi-road-map" style="font-size: 4rem; color: #ccc;"></i>
                                        <h5>Belum Ada Jalur</h5>
                                        <p class="text-muted">Belum ada jalur pacu yang tersedia saat ini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($jalurs->hasPages())
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="pagination-wrapper">
                            {{ $jalurs->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section id="cta" class="cta">
    <div class="container" data-aos="zoom-in">
        <div class="row">
            <div class="col-lg-9 text-center text-lg-start">
                <h3>Ingin Melihat Informasi Lainnya?</h3>
                <p>Jelajahi fitur-fitur lain yang tersedia di e-PacuJalur untuk mendapatkan informasi lengkap tentang pacu jalur.</p>
            </div>
            <div class="col-lg-3 cta-btn-container text-center">
                <a class="cta-btn align-middle" href="{{ route('web.juarapacujalur') }}">Lihat Juara</a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.page-header {
    padding: 100px 0 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-align: center;
}

.page-header-content h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.page-header-content p {
    font-size: 1.2rem;
    opacity: 0.9;
}

.jalur {
    padding: 80px 0;
}

.search-section {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.search-form .input-group-text {
    background: #f8f9fa;
    border-color: #e9ecef;
    color: #667eea;
}

.search-form .form-control {
    border-color: #e9ecef;
    padding: 12px 15px;
}

.search-form .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.search-results-info .alert {
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
    color: #333;
}

.table-responsive {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.table {
    margin-bottom: 0;
}

.table thead th {
    border: none;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    background-color: #f8f9fa !important;
    color: #333 !important;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.05);
    transform: scale(1.01);
}

.table tbody td {
    vertical-align: middle;
    border-color: #f8f9fa;
}

.img-thumbnail {
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.img-thumbnail:hover {
    border-color: #667eea;
    transform: scale(1.1);
}

.btn-group .btn {
    border-radius: 6px;
    margin: 0 2px;
}

.btn-group .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.empty-state {
    padding: 60px 20px;
}

.empty-state i {
    margin-bottom: 20px;
}

.empty-state h5 {
    color: #666;
    margin-bottom: 10px;
}

.empty-state p {
    color: #888;
}

.cta {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 80px 0;
}

.cta h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.cta p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.cta-btn {
    display: inline-block;
    padding: 15px 30px;
    background: white;
    color: #667eea;
    text-decoration: none;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.cta-btn:hover {
    color: #667eea;
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.pagination-wrapper {
    margin-top: 50px;
    display: flex;
    justify-content: center;
}

.pagination .page-link {
    color: #667eea;
    border-color: #667eea;
}

.pagination .page-item.active .page-link {
    background-color: #667eea;
    border-color: #667eea;
}

.pagination .page-link:hover {
    color: #764ba2;
    background-color: rgba(102, 126, 234, 0.1);
}

@media (max-width: 768px) {
    .page-header-content h1 {
        font-size: 2rem;
    }
    
    .page-header-content p {
        font-size: 1rem;
    }
    
    .jalur-meta {
        flex-direction: column;
        gap: 8px;
    }
    
    .cta h3 {
        font-size: 1.5rem;
    }
}
</style>
@endsection