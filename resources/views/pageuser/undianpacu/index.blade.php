@extends('template-web.layout')

@section('content')
<!-- Page Header -->
<section class="page-header">
        <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-header-content">
                    <h1>Undian Pacu</h1>
                    <p>Jadwal dan informasi undian pacu terbaru</p>
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
                                <label class="form-label">&nbsp;</label>
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

<!-- Undian Section -->
<section id="undian" class="undian">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-12">
                @forelse($undianPacu as $undian)
                <div class="undian-table-wrapper" data-aos="fade-up" data-aos-delay="100">
                    <table class="table undian-table">
                        <tbody>
                            <tr>
                                <td class="image-cell">
                                    <div class="undian-image">
                                        <img src="{{ asset('image/undianpacu/' . $undian->gambar) }}" 
                                             class="img-fluid clickable-image" 
                                             alt="{{ $undian->event->nama_event }}"
                                             data-bs-toggle="modal" 
                                             data-bs-target="#imageModal"
                                             data-image-src="{{ asset('image/undianpacu/' . $undian->gambar) }}"
                                             data-image-title="{{ $undian->event->nama_event }}"
                                             onerror="this.src='{{ asset('image/undianpacu/default.jpg') }}'">
                                    </div>
                                </td>
                                <td class="info-cell">
                                    <div class="undian-info">
                                        <h4>{{ $undian->event->nama_event }}</h4>
                                        <div class="undian-meta">
                                            <span class="meta-item">
                                                <i class="bi bi-geo-alt"></i>
                                                {{ $undian->gelanggang->nama_gelanggang }}
                                            </span>
                                        </div>
                                        
                                        <table class="table table-sm schedule-info-table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="schedule-label">
                                                        <i class="bi bi-calendar-date"></i>
                                                        Tanggal
                                                    </td>
                                                    <td class="schedule-value">{{ \Carbon\Carbon::parse($undian->tanggal)->format('d M Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="schedule-label">
                                                        <i class="bi bi-clock"></i>
                                                        Jam
                                                    </td>
                                                    <td class="schedule-value">{{ $undian->jam }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td class="action-cell">
                                    <div class="undian-actions">
                                        <a href="{{ route('web.undianpacu.detail', $undian->id) }}" class="btn-detail">
                                            <i class="bi bi-info-circle"></i> Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @empty
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-calendar-check" style="font-size: 4rem; color: #ccc;"></i>
                        <h3>Belum Ada Undian</h3>
                        <p>Belum ada jadwal undian pacu yang tersedia saat ini.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($undianPacu->hasPages())
        <div class="row">
            <div class="col-12">
                <div class="pagination-wrapper">
                    {{ $undianPacu->links() }}
            </div>
        </div>
                            </div>
        @endif
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
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.undian-table-wrapper:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.undian-table {
    margin: 0;
    border: 1px solid #dee2e6;
}

.undian-table td {
    border: 1px solid #dee2e6;
    padding: 0;
    vertical-align: middle;
}

.image-cell {
    width: 200px;
    padding: 20px;
}

.undian-image {
    height: 120px;
    overflow: hidden;
    border-radius: 10px;
}

.undian-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.undian-table-wrapper:hover .undian-image img {
    transform: scale(1.05);
}

.info-cell {
    padding: 20px;
    vertical-align: top;
}

.undian-info h4 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
}

.undian-meta {
    margin-bottom: 15px;
}

.meta-item {
    display: flex;
    align-items: center;
    color: #666;
    font-size: 0.9rem;
}

.meta-item i {
    margin-right: 8px;
    color: #667eea;
    font-size: 1rem;
}

.schedule-info-table {
    margin: 0;
    background: #f8f9fa;
    border-radius: 8px;
    padding: 10px;
}

.schedule-info-table td {
    padding: 5px 10px;
    border: none;
    vertical-align: middle;
}

.schedule-label {
    font-weight: 600;
    color: #666;
    font-size: 0.85rem;
    width: 40%;
}

.schedule-label i {
    margin-right: 6px;
    color: #667eea;
    font-size: 0.9rem;
}

.schedule-value {
    font-weight: 600;
    color: #333;
    font-size: 0.9rem;
}

.action-cell {
    width: 150px;
    padding: 20px;
    text-align: center;
    vertical-align: middle;
}

.undian-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
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

.btn-detail {
    display: inline-flex;
    align-items: center;
    padding: 10px 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-detail:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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
    
    .cta h3 {
        font-size: 1.5rem;
    }
    
    .filter-form .row .col-md-4 {
        margin-bottom: 15px;
    }
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