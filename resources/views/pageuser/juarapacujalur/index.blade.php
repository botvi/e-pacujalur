@extends('template-web.layout')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-header-content">
                    <h1>Juara Pacu Jalur</h1>
                    <p>Daftar juara pacu jalur berdasarkan event, gelanggang, dan tahun</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section id="filter" class="filter-section">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-12">
                <div class="filter-card">
                    <form method="GET" action="{{ route('web.juarapacujalur') }}" class="filter-form">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="search" class="form-label">Pencarian</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control" 
                                           name="search" 
                                           value="{{ request('search') }}" 
                                           placeholder="Cari berdasarkan event, gelanggang, atau tahun...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="event_id" class="form-label">Event</label>
                                <select name="event_id" id="event_id" class="form-select">
                                    <option value="">Semua Event</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                            {{ $event->nama_event }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="gelanggang_id" class="form-label">Gelanggang</label>
                                <select name="gelanggang_id" id="gelanggang_id" class="form-select">
                                    <option value="">Semua Gelanggang</option>
                                    @foreach($gelanggangs as $gelanggang)
                                        <option value="{{ $gelanggang->id }}" {{ request('gelanggang_id') == $gelanggang->id ? 'selected' : '' }}>
                                            {{ $gelanggang->nama_gelanggang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select">
                                    <option value="">Semua Tahun</option>
                                    @foreach($tahunList as $tahun)
                                        <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                            {{ $tahun }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i> Filter
                                    </button>
                                    <a href="{{ route('web.juarapacujalur') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-clockwise"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Results Info -->
@if(request('search') || request('event_id') || request('gelanggang_id') || request('tahun'))
<div class="container mb-3">
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i>
        Menampilkan {{ $juaraPacuJalur->total() }} hasil
        @if(request('search'))
            untuk pencarian "<strong>{{ request('search') }}</strong>"
        @endif
    </div>
</div>
@endif

<!-- Juara Section -->
<section id="juara" class="juara">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Event</th>
                                <th width="15%">Gelanggang</th>
                                <th width="10%">Tahun</th>
                                <th width="30%">Daftar Jalur Juara</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($juaraPacuJalur as $index => $juara)
                            <tr>
                                <td>{{ $juaraPacuJalur->firstItem() + $index }}</td>
                                <td>
                                    <div class="event-info">
                                        <strong>{{ $juara->event->nama_event ?? 'N/A' }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <i class="bi bi-geo-alt text-primary"></i>
                                    {{ $juara->gelanggang->nama_gelanggang ?? 'N/A' }}
                                </td>
                                <td>
                                    <i class="bi bi-calendar text-success"></i>
                                    {{ $juara->tahun }}
                                </td>
                                <td>
                                    @php
                                        $daftarJuara = json_decode($juara->daftar_juara, true);
                                    @endphp
                                    @if($daftarJuara && count($daftarJuara) > 0)
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($daftarJuara as $index => $item)
                                                @break($index === 3)
                                                @php
                                                    $jalur = \App\Models\Jalur::find($item['jalur_id'] ?? null);
                                                    $colors = ['#FFD700', '#C0C0C0', '#cd7f32']; // Emas, perak, perunggu
                                                    $icons = ['bi-trophy-fill', 'bi-trophy-fill', 'bi-trophy-fill'];
                                                @endphp
                                                @if($jalur)
                                                    <span class="badge px-3 py-2 text-dark" style="background: {{ $colors[$index] ?? '#e9ecef' }}; font-size: 1rem; display: flex; align-items: center; gap: 5px;">
                                                        <i class="bi {{ $icons[$index] }}" style="font-size:1.1em;
                                                            @if($index === 0) color: #FFD700;
                                                            @elseif($index === 1) color: #C0C0C0;
                                                            @elseif($index === 2) color: #cd7f32;
                                                            @endif"></i>
                                                        <strong>Juara {{ $index+1 }}:</strong> {{ $jalur->nama_jalur }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-muted">Tidak ada data juara</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('web.juarapacujalur.detail', $juara->id) }}" 
                                           class="btn btn-sm btn-primary" 
                                           title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="bi bi-trophy" style="font-size: 4rem; color: #ccc;"></i>
                                        <h5>Belum Ada Data Juara</h5>
                                        <p class="text-muted">Belum ada data juara pacu jalur yang tersedia saat ini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($juaraPacuJalur->hasPages())
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="pagination-wrapper">
                            {{ $juaraPacuJalur->links() }}
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
                <a class="cta-btn align-middle" href="{{ route('web.undianpacu') }}">Lihat Undian</a>
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

.filter-section {
    padding: 50px 0 30px;
    background: #f8f9fa;
}

.filter-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    padding: 30px;
}

.filter-form .form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.filter-form .form-select {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

.filter-form .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.juara {
    padding: 80px 0;
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

.event-info strong {
    color: #333;
    font-size: 1rem;
}

.jalur-preview {
    max-height: 120px;
    overflow-y: auto;
}

.jalur-item-small {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
    padding: 3px 0;
}

.jalur-item-small:last-child {
    margin-bottom: 0;
}

.rank-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 25px;
    height: 25px;
    margin-right: 8px;
    font-size: 0.8rem;
    font-weight: 600;
}

.jalur-nama {
    font-size: 0.9rem;
    color: #333;
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

.empty-state h3 {
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
    
    .juara-meta {
        flex-direction: column;
        gap: 8px;
    }
    
    .cta h3 {
        font-size: 1.5rem;
    }
    
    .filter-form .row .col-md-3 {
        margin-bottom: 15px;
    }
}
</style>
@endsection