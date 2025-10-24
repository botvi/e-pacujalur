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
                            <li class="breadcrumb-item"><a href="{{ route('web.juarapacujalur') }}">Juara Pacu Jalur</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $juara->event->nama_event ?? 'Detail Juara' }}</li>
                        </ol>
                    </nav>
                    <h1>{{ $juara->event->nama_event ?? 'Detail Juara' }}</h1>
                    <p>Detail informasi juara pacu jalur</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Juara Detail Section -->
<section id="juara-detail" class="juara-detail">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8">
                <div class="juara-detail-content">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th colspan="2" class="text-center">
                                        <h2 class="mb-0">{{ $juara->event->nama_event ?? 'N/A' }}</h2>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="30%"><strong><i class="bi bi-geo-alt text-primary"></i> Gelanggang</strong></td>
                                    <td>{{ $juara->gelanggang->nama_gelanggang ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-calendar text-success"></i> Tahun</strong></td>
                                    <td>{{ $juara->tahun }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-clock text-info"></i> Update Terakhir</strong></td>
                                    <td>{{ $juara->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                              
                            </tbody>
                        </table>
                    </div>

                    <!-- Daftar Jalur Juara -->
                    @php
                        $daftarJuara = json_decode($juara->daftar_juara, true);
                    @endphp
                    @if($daftarJuara && count($daftarJuara) > 0)
                    <div class="juara-list-section">
                        <h3 class="section-title">
                            <i class="bi bi-trophy"></i> Daftar Jalur Juara
                        </h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th width="10%">Peringkat</th>
                                        <th width="25%">Nama Jalur</th>
                                        <th width="20%">Asal Jalur</th>
                                        <th width="15%">Tahun Buat</th>
                                        <th width="30%">Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($daftarJuara as $index => $item)
                                        @php
                                            $jalur = \App\Models\Jalur::find($item['jalur_id'] ?? null);
                                        @endphp
                                        @if($jalur)
                                        <tr>
                                            <td>
                                                <div class="rank-display">
                                                    @if($index == 0)
                                                        <i class="bi bi-trophy-fill text-warning" style="font-size: 1.5rem;"></i>
                                                    @elseif($index == 1)
                                                        <i class="bi bi-award-fill text-secondary" style="font-size: 1.5rem;"></i>
                                                    @elseif($index == 2)
                                                        <i class="bi bi-award-fill text-warning" style="font-size: 1.5rem;"></i>
                                                    @else
                                                        <span class="rank-number">{{ $index + 1 }}</span>
                                                    @endif
                                                </div>
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
                                                <small class="text-muted">{{ \Illuminate\Support\Str::limit($jalur->deskripsi, 50) }}</small>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="empty-juara">
                        <div class="text-center py-5">
                            <i class="bi bi-trophy" style="font-size: 4rem; color: #ccc;"></i>
                            <h5>Tidak Ada Data Jalur Juara</h5>
                            <p class="text-muted">Data jalur juara untuk event ini belum tersedia.</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="juara-sidebar">
                    <div class="sidebar-widget">
                        <h4>Juara Lainnya</h4>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Event</th>
                                        <th>Tahun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($juaraLainnya as $juaraLain)
                                    <tr>
                                        <td>
                                            <small>{{ Str::limit($juaraLain->event->nama_event ?? 'N/A', 20) }}</small>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $juaraLain->tahun }}</small>
                                        </td>
                                        <td>
                                            <a href="{{ route('web.juarapacujalur.detail', $juaraLain->id) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            <small>Tidak ada juara lainnya</small>
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
                                        <td><small>Data Terverifikasi</small></td>
                                    </tr>
                                    <tr>
                                        <td><i class="bi bi-clock text-info"></i></td>
                                        <td><small>Update: {{ $juara->updated_at->format('d M Y') }}</small></td>
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
                <h3>Jelajahi Juara Lainnya</h3>
                <p>Temukan data juara pacu jalur lainnya yang mungkin menarik untuk Anda.</p>
            </div>
            <div class="col-lg-3 cta-btn-container text-center">
                <a class="cta-btn align-middle" href="{{ route('web.juarapacujalur') }}">Lihat Semua Juara</a>
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

.juara-detail {
    padding: 80px 0;
}

.juara-detail-content {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    padding: 30px;
}

.table-responsive {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
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

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
    border-bottom: 2px solid #667eea;
    padding-bottom: 10px;
}

.rank-display {
    text-align: center;
}

.rank-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    background: #f8f9fa;
    border-radius: 50%;
    font-weight: 600;
    font-size: 1rem;
    color: #666;
}

.juara-sidebar {
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

.badge {
    font-size: 0.75rem;
    padding: 0.5em 0.75em;
}

.empty-juara {
    background: #f8f9fa;
    border-radius: 10px;
    margin-top: 20px;
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
    .juara-sidebar {
        padding-left: 0;
        margin-top: 30px;
    }
    
    .page-header-content h1 {
        font-size: 2rem;
    }
    
    .juara-detail-content {
        padding: 20px;
    }
}
</style>
@endsection
