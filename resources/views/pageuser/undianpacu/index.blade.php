@extends('template-web.layout')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-header-content">
                    <h1>Undian Pacu</h1>
                    <p>Daftar undian pacu berdasarkan event dan gelanggang</p>
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
                    <form method="GET" action="{{ route('web.undianpacu') }}" class="filter-form">
                        <div class="row g-3">
                            <div class="col-md-4">
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
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <label class="form-label d-block">&nbsp;</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i> Filter
                                    </button>
                                    <a href="{{ route('web.undianpacu') }}" class="btn btn-outline-secondary">
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

<!-- Undian List Section -->
<section id="undian" class="undian">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive undian-table-wrapper">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="25%">Event</th>
                                <th width="20%">Gelanggang</th>
                                <th width="15%">Tanggal</th>
                                <th width="10%">Jam</th>
                                <th width="15%">Status Undian</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($undianPacu as $index => $undian)
                                @php
                                    $participants = is_array($undian->participants) ? $undian->participants : (json_decode($undian->participants, true) ?? []);
                                    $pairing = $participants['pairing'] ?? [];
                                    $hasPairing = is_array($pairing) && count($pairing) > 0;
                                @endphp
                                <tr>
                                    <td>{{ $undianPacu->firstItem() + $index }}</td>
                                    <td>
                                        <strong>{{ $undian->event->nama_event ?? '-' }}</strong>
                                    </td>
                                    <td>
                                        <i class="bi bi-geo-alt text-primary"></i>
                                        {{ $undian->gelanggang->nama_gelanggang ?? '-' }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($undian->tanggal)->format('d M Y') }}</td>
                                    <td>{{ $undian->jam }}</td>
                                    <td>
                                        @if($hasPairing)
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i> Sudah diundi
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-hourglass-split me-1"></i> Belum diundi
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('web.undianpacu.detail', $undian->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="bi bi-calendar-check" style="font-size: 4rem; color: #ccc;"></i>
                                            <h5>Belum Ada Undian</h5>
                                            <p class="text-muted">Belum ada jadwal undian pacu yang tersedia saat ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($undianPacu->hasPages())
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="pagination-wrapper">
                            {{ $undianPacu->links() }}
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
                <a class="cta-btn align-middle" href="{{ route('web.daftarjalur') }}">Lihat Jalur</a>
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

.undian {
    padding: 80px 0;
}

.undian-table-wrapper {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.table thead th {
    border: none;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.05);
}

.empty-state {
    padding: 60px 20px;
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
    margin-top: 30px;
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
}
</style>
@endsection
