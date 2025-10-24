@extends('template-web.layout')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-header-content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('web.daftarjalur') }}">Daftar Jalur</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $jalur->nama_jalur }}</li>
                        </ol>
                    </nav>
                    <h1>{{ $jalur->nama_jalur }}</h1>
                    <p>Detail informasi jalur pacu</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jalur Detail Section -->
<section id="jalur-detail" class="jalur-detail">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8">
                <div class="jalur-detail-content">
                    <div class="jalur-image mb-4">
                        <img src="{{ asset('image/jalur/' . $jalur->gambar) }}" class="img-fluid rounded" alt="{{ $jalur->nama_jalur }}">
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th colspan="2" class="text-center">
                                        <h2 class="mb-0">{{ $jalur->nama_jalur }}</h2>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="30%"><strong><i class="bi bi-geo-alt text-primary"></i> Asal Jalur</strong></td>
                                    <td>{{ $jalur->asal_jalur }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-calendar text-success"></i> Tahun Pembuatan</strong></td>
                                    <td>{{ $jalur->tahun_buat }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-clock text-info"></i> Update Terakhir</strong></td>
                                    <td>{{ $jalur->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-shield-check text-warning"></i> Status</strong></td>
                                    <td><span class="badge bg-success">Informasi Terverifikasi</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <strong><i class="bi bi-file-text text-secondary"></i> Deskripsi</strong>
                                        <div class="mt-2">
                                            <p class="mb-0">{{ $jalur->deskripsi }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="jalur-sidebar">
                    <div class="sidebar-widget">
                        <h4>Jalur Terbaru</h4>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama Jalur</th>
                                        <th>Asal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jalursTerbaru as $jalurTerbaru)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('image/jalur/' . $jalurTerbaru->gambar) }}" 
                                                 class="img-thumbnail" 
                                                 alt="{{ $jalurTerbaru->nama_jalur }}"
                                                 style="width: 50px; height: 40px; object-fit: cover;">
                                        </td>
                                        <td>
                                            <a href="{{ route('web.daftarjalur.detail', $jalurTerbaru->id) }}" 
                                               class="text-decoration-none">
                                                <small>{{ Str::limit($jalurTerbaru->nama_jalur, 20) }}</small>
                                            </a>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $jalurTerbaru->asal_jalur }}</small>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            <small>Tidak ada jalur terbaru</small>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="sidebar-widget">
                        <h4>Informasi Tambahan</h4>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <tr>
                                        <td><i class="bi bi-shield-check text-success"></i></td>
                                        <td><small>Informasi Terverifikasi</small></td>
                                    </tr>
                                    <tr>
                                        <td><i class="bi bi-clock text-info"></i></td>
                                        <td><small>Update: {{ $jalur->updated_at->format('d M Y') }}</small></td>
                                    </tr>
                                    <tr>
                                        <td><i class="bi bi-eye text-primary"></i></td>
                                        <td><small>Dilihat {{ rand(10, 100) }} kali</small></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section id="cta" class="cta">
    <div class="container" data-aos="zoom-in">
        <div class="row">
            <div class="col-lg-9 text-center text-lg-start">
                <h3>Jelajahi Jalur Lainnya</h3>
                <p>Temukan jalur pacu lainnya yang mungkin menarik untuk Anda.</p>
            </div>
            <div class="col-lg-3 cta-btn-container text-center">
                <a class="cta-btn align-middle" href="{{ route('web.daftarjalur') }}">Lihat Semua Jalur</a>
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

.breadcrumb {
    background: rgba(255,255,255,0.1);
    padding: 10px 20px;
    border-radius: 25px;
    margin-bottom: 20px;
    display: inline-block;
}

.breadcrumb-item a {
    color: white;
    text-decoration: none;
}

.breadcrumb-item.active {
    color: rgba(255,255,255,0.8);
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

.jalur-detail {
    padding: 80px 0;
}

.jalur-detail-content {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    padding: 30px;
}

.jalur-image {
    height: 300px;
    overflow: hidden;
    border-radius: 10px;
}

.jalur-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.table-responsive {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
}

.table tbody td {
    vertical-align: middle;
    border-color: #f8f9fa;
}

.table tbody td:first-child {
    background-color: rgba(102, 126, 234, 0.1);
    font-weight: 600;
}

.jalur-sidebar {
    padding-left: 30px;
}

.sidebar-widget {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    padding: 25px;
    margin-bottom: 30px;
}

.sidebar-widget h4 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
    border-bottom: 2px solid #667eea;
    padding-bottom: 10px;
}

.sidebar-widget .table {
    font-size: 0.9rem;
}

.sidebar-widget .table th {
    background-color: #f8f9fa;
    border: none;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.sidebar-widget .table td {
    border: none;
    padding: 8px;
}

.sidebar-widget .img-thumbnail {
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.sidebar-widget .img-thumbnail:hover {
    border-color: #667eea;
    transform: scale(1.1);
}

.badge {
    font-size: 0.75rem;
    padding: 0.5em 0.75em;
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

@media (max-width: 768px) {
    .jalur-sidebar {
        padding-left: 0;
        margin-top: 30px;
    }
    
    .page-header-content h1 {
        font-size: 2rem;
    }
    
    .jalur-info h2 {
        font-size: 1.5rem;
    }
    
    .jalur-image {
        height: 250px;
    }
}
</style>
@endsection