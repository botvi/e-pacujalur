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
                            <li class="breadcrumb-item"><a href="{{ route('web.undianpacu') }}">Undian Pacu</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $undianPacu->event->nama_event }}</li>
                        </ol>
                    </nav>
                    <h1>Detail Undian Pacu</h1>
                    <p>Informasi lengkap dan hasil undian jalur</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Undian Detail Section -->
<section id="undian-detail" class="undian-detail">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8">
                <div class="undian-detail-content">
                    <div class="undian-image mb-3">
                        @if(!empty($undianPacu->gambar))
                            <img src="{{ asset('image/undianpacu/' . $undianPacu->gambar) }}" 
                                 class="img-fluid rounded clickable-image" 
                                 alt="{{ $undianPacu->event->nama_event }}"
                                 onerror="this.src='{{ asset('image/undianpacu/default.jpg') }}'">
                        @endif
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th colspan="2" class="text-center">Informasi Undian Pacu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="30%"><strong>Event</strong></td>
                                    <td>{{ $undianPacu->event->nama_event }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Gelanggang</strong></td>
                                    <td>{{ $undianPacu->gelanggang->nama_gelanggang }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($undianPacu->tanggal)->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jam</strong></td>
                                    <td>{{ $undianPacu->jam }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat Pada</strong></td>
                                    <td>{{ $undianPacu->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Terakhir Diupdate</strong></td>
                                    <td>{{ $undianPacu->updated_at->format('d M Y, H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @php
                        $participants = is_array($undianPacu->participants) ? $undianPacu->participants : (json_decode($undianPacu->participants, true) ?? []);
                        $pairing = $participants['pairing'] ?? [];
                        $hasPairing = is_array($pairing) && count($pairing) > 0;
                    @endphp

                    <div class="hasil-undian-section">
                        <h3 class="section-title">Hasil Undian Jalur</h3>
                        <div class="table-responsive border rounded">
                            <table class="table table-sm table-striped table-bordered mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 60px;">#</th>
                                        <th>Jalur Kiri</th>
                                        <th>Jalur Kanan / Bay</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($hasPairing)
                                        @foreach($pairing as $idx => $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                @if(isset($p['kiri']) && isset($p['kanan']))
                                                    @php
                                                        $kiriJ = $jalur[$p['kiri']] ?? null;
                                                        $kananJ = $jalur[$p['kanan']] ?? null;
                                                    @endphp
                                                    <td>{{ $kiriJ->nama_jalur ?? ('ID '.$p['kiri']) }} (kiri)</td>
                                                    <td>{{ $kananJ->nama_jalur ?? ('ID '.$p['kanan']) }} (kanan)</td>
                                                @elseif(isset($p['bay']))
                                                    @php
                                                        $bayJ = $jalur[$p['bay']] ?? null;
                                                    @endphp
                                                    <td>-</td>
                                                    <td>{{ $bayJ->nama_jalur ?? ('ID '.$p['bay']) }} (bay)</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Belum ada hasil undian jalur.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="undian-sidebar">
                    <div class="sidebar-widget">
                        <h4>Undian Lainnya</h4>
                        <div class="undian-list">
                            @forelse($undianPacuTerbaru as $u)
                                <div class="undian-item-small">
                                    <div class="undian-img-small">
                                        <img src="{{ asset('image/undianpacu/' . $u->gambar) }}" 
                                             alt="{{ $u->event->nama_event }}"
                                             onerror="this.src='{{ asset('image/undianpacu/default.jpg') }}'">
                                    </div>
                                    <div class="undian-info-small">
                                        <h5><a href="{{ route('web.undianpacu.detail', $u->id) }}">{{ $u->event->nama_event }}</a></h5>
                                        <p>{{ $u->gelanggang->nama_gelanggang }}</p>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($u->tanggal)->format('d M Y') }} - {{ $u->jam }}</small>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">Tidak ada undian lainnya</p>
                            @endforelse
                        </div>
                    </div>
                </div>
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

.undian-detail {
    padding: 80px 0;
}

.undian-detail-content {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    padding: 30px;
}

.undian-image img {
    width: 100%;
    max-height: 350px;
    object-fit: cover;
    border-radius: 10px;
}

.section-title {
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
}

.undian-sidebar {
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

.undian-item-small {
    display: flex;
    margin-bottom: 15px;
}

.undian-img-small {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    margin-right: 15px;
}

.undian-img-small img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.undian-info-small h5 {
    margin-bottom: 5px;
    font-size: 0.9rem;
}

.undian-info-small p {
    margin: 0 0 5px 0;
    font-size: 0.8rem;
    color: #666;
}

.undian-info-small small {
    font-size: 0.75rem;
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
    .undian-sidebar {
        padding-left: 0;
        margin-top: 30px;
    }
}
</style>
@endsection
