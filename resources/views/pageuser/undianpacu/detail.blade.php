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
                    <h1>{{ $undianPacu->event->nama_event }}</h1>
                    <p>Detail informasi undian pacu</p>
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
                    <div class="undian-image">
                        <img src="{{ asset('image/undianpacu/' . $undianPacu->gambar) }}" 
                             class="img-fluid clickable-image" 
                             alt="{{ $undianPacu->event->nama_event }}"
                             data-bs-toggle="modal" 
                             data-bs-target="#imageModal"
                             data-image-src="{{ asset('image/undianpacu/' . $undianPacu->gambar) }}"
                             data-image-title="{{ $undianPacu->event->nama_event }}"
                             onerror="this.src='{{ asset('image/undianpacu/default.jpg') }}'">
                    </div>
                    
                    <div class="undian-info">
                        <h2>{{ $undianPacu->event->nama_event }}</h2>
                        
                        <div class="undian-meta-table">
                            <table class="table meta-table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="meta-label">
                                            <i class="bi bi-geo-alt"></i>
                                            Gelanggang
                                        </td>
                                        <td class="meta-value">{{ $undianPacu->gelanggang->nama_gelanggang }}</td>
                                    </tr>
                                    <tr>
                                        <td class="meta-label">
                                            <i class="bi bi-calendar-date"></i>
                                            Tanggal
                                        </td>
                                        <td class="meta-value">{{ \Carbon\Carbon::parse($undianPacu->tanggal)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="meta-label">
                                            <i class="bi bi-clock"></i>
                                            Jam
                                        </td>
                                        <td class="meta-value">{{ $undianPacu->jam }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="undian-description">
                            <h3>Informasi Event</h3>
                            <p>{{ $undianPacu->event->deskripsi }}</p>
                        </div>
                        
                        <div class="undian-schedule">
                            <h3>Jadwal Undian</h3>
                            <div class="schedule-card">
                                <table class="table schedule-detail-table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="schedule-icon-cell">
                                                <div class="schedule-icon">
                                                    <i class="bi bi-calendar-event"></i>
                                                </div>
                                            </td>
                                            <td class="schedule-content-cell">
                                                <h4>Tanggal Pelaksanaan</h4>
                                                <p>{{ \Carbon\Carbon::parse($undianPacu->tanggal)->format('l, d F Y') }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="schedule-icon-cell">
                                                <div class="schedule-icon">
                                                    <i class="bi bi-clock-history"></i>
                                                </div>
                                            </td>
                                            <td class="schedule-content-cell">
                                                <h4>Waktu Mulai</h4>
                                                <p>{{ $undianPacu->jam }} WIB</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="schedule-icon-cell">
                                                <div class="schedule-icon">
                                                    <i class="bi bi-geo-alt-fill"></i>
                                                </div>
                                            </td>
                                            <td class="schedule-content-cell">
                                                <h4>Lokasi</h4>
                                                <p>{{ $undianPacu->gelanggang->nama_gelanggang }}</p>
                                                @if($undianPacu->gelanggang->lokasi_gelanggang)
                                                    <small class="text-muted">{{ $undianPacu->gelanggang->lokasi_gelanggang }}</small>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="undian-sidebar">
                    <div class="sidebar-widget">
                        <h4>Undian Terbaru</h4>
                        <div class="undian-list">
                            @forelse($undianPacuTerbaru as $undianTerbaru)
                            <div class="undian-item-small">
                                <div class="undian-img-small">
                                    <img src="{{ asset('image/undianpacu/' . $undianTerbaru->gambar) }}" 
                                         alt="{{ $undianTerbaru->event->nama_event }}"
                                         onerror="this.src='{{ asset('image/undianpacu/default.jpg') }}'">
                                </div>
                                <div class="undian-info-small">
                                    <h5><a href="{{ route('web.undianpacu.detail', $undianTerbaru->id) }}">{{ $undianTerbaru->event->nama_event }}</a></h5>
                                    <p>{{ $undianTerbaru->gelanggang->nama_gelanggang }}</p>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($undianTerbaru->tanggal)->format('d M Y') }} - {{ $undianTerbaru->jam }}</small>
                                </div>
                            </div>
                            @empty
                            <p>Tidak ada undian terbaru</p>
                            @endforelse
                        </div>
                    </div>
                    
                    <div class="sidebar-widget">
                        <h4>Informasi</h4>
                        <div class="info-box">
                            <div class="info-item">
                                <i class="bi bi-shield-check"></i>
                                <span>Informasi Terverifikasi</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-clock"></i>
                                <span>Update Terakhir: {{ $undianPacu->updated_at->format('d M Y') }}</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-calendar-check"></i>
                                <span>Status: Aktif</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="sidebar-widget">
                        <h4>Gelanggang</h4>
                        <div class="gelanggang-info">
                            <h5>{{ $undianPacu->gelanggang->nama_gelanggang }}</h5>
                            @if($undianPacu->gelanggang->deskripsi)
                                <p>{{ Str::limit($undianPacu->gelanggang->deskripsi, 100) }}</p>
                            @endif
                            @if($undianPacu->gelanggang->lokasi_gelanggang)
                                <div class="location-info">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>{{ $undianPacu->gelanggang->lokasi_gelanggang }}</span>
                                </div>
                            @endif
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
                <h3>Jelajahi Undian Lainnya</h3>
                <p>Temukan jadwal undian pacu lainnya yang mungkin menarik untuk Anda.</p>
            </div>
            <div class="col-lg-3 cta-btn-container text-center">
                <a class="cta-btn align-middle" href="{{ route('web.undianpacu') }}">Lihat Semua Undian</a>
            </div>
        </div>
    </div>
</section>

<!-- Image Preview Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Preview Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0">
                <div class="image-container" style="max-height: 70vh; overflow: hidden;">
                    <img id="modalImage" 
                         src="{{ asset('image/undianpacu/1761168998.jpg') }}" 
                         class="img-fluid" 
                         alt="Preview"
                         style="width: 100%; height: auto; object-fit: contain;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
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
}

.undian-image {
    height: 400px;
    overflow: hidden;
}

.undian-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.undian-info {
    padding: 30px;
}

.undian-info h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: #333;
}

.undian-meta-table {
    margin-bottom: 30px;
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
}

.meta-table {
    margin: 0;
}

.meta-table td {
    padding: 10px 15px;
    border: 1px solid #dee2e6;
    vertical-align: middle;
}

.meta-label {
    font-weight: 600;
    color: #666;
    font-size: 1rem;
    width: 30%;
}

.meta-label i {
    margin-right: 8px;
    color: #667eea;
    font-size: 1.1rem;
}

.meta-value {
    font-weight: 600;
    color: #333;
    font-size: 1rem;
}

.undian-description h3,
.undian-schedule h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
}

.undian-description p {
    color: #666;
    line-height: 1.8;
    font-size: 1.1rem;
}

.schedule-card {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
}

.schedule-detail-table {
    margin: 0;
}

.schedule-detail-table tr {
    border-bottom: 1px solid #dee2e6;
}

.schedule-detail-table tr:last-child {
    border-bottom: none;
}

.schedule-icon-cell {
    width: 80px;
    padding: 20px 15px;
    vertical-align: top;
    border: 1px solid #dee2e6;
}

.schedule-content-cell {
    padding: 20px 15px;
    vertical-align: top;
    border: 1px solid #dee2e6;
}

.schedule-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.schedule-icon i {
    color: white;
    font-size: 1.2rem;
}

.schedule-content-cell h4 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 5px;
    color: #333;
}

.schedule-content-cell p {
    color: #666;
    margin: 0;
    font-size: 0.9rem;
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
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.undian-item-small:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.undian-img-small {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    margin-right: 15px;
    flex-shrink: 0;
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

.undian-info-small h5 a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.undian-info-small h5 a:hover {
    color: #667eea;
}

.undian-info-small p {
    color: #666;
    font-size: 0.8rem;
    margin: 0 0 5px 0;
}

.info-box {
    margin-top: 15px;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    font-size: 0.9rem;
    color: #666;
}

.info-item i {
    margin-right: 8px;
    color: #667eea;
}

.gelanggang-info h5 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
}

.gelanggang-info p {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 10px;
}

.location-info {
    display: flex;
    align-items: center;
    color: #666;
    font-size: 0.8rem;
}

.location-info i {
    margin-right: 5px;
    color: #667eea;
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
    
    .page-header-content h1 {
        font-size: 2rem;
    }
    
    .undian-info h2 {
        font-size: 1.5rem;
    }
    
    .undian-image {
        height: 250px;
    }
}

.clickable-image {
    cursor: pointer;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.clickable-image:hover {
    transform: scale(1.05);
    opacity: 0.8;
}

/* Modal Image Styles */
.image-container {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border-radius: 8px;
    min-height: 200px;
}

#modalImage {
    max-width: 100%;
    max-height: 70vh;
    object-fit: contain;
    border-radius: 8px;
}

.modal-body {
    padding: 0 !important;
}

.modal-content {
    border-radius: 15px;
    overflow: hidden;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('imageModalLabel');
    
    // Event listener untuk modal
    imageModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const imageSrc = button.getAttribute('data-image-src');
        const imageTitle = button.getAttribute('data-image-title');
        
        console.log('Image Source:', imageSrc);
        console.log('Image Title:', imageTitle);
        
        if (imageSrc) {
            modalImage.src = imageSrc;
            modalImage.alt = imageTitle || 'Preview Gambar';
        }
        
        if (imageTitle) {
            modalTitle.textContent = imageTitle;
        } else {
            modalTitle.textContent = 'Preview Gambar';
        }
    });
    
    // Event listener untuk error loading gambar
    modalImage.addEventListener('error', function() {
        console.log('Error loading image, using fallback');
        this.src = '{{ asset("image/undianpacu/1761168998.jpg") }}';
        this.alt = 'Gambar tidak tersedia';
    });
});
</script>
@endsection