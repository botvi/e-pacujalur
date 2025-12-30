@extends('template-admin.layout')

@section('style')
<style>
    .custom-marker {
        background: transparent !important;
        border: none !important;
    }

    .leaflet-popup-content-wrapper {
        border-radius: 8px;
        box-shadow: 0 3px 14px rgba(0,0,0,0.2);
    }

    .leaflet-popup-tip {
        background-color: white;
    }

    .leaflet-container {
        border-radius: 8px;
    }
</style>
@endsection

@section('content')
<section class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard-asisten">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('managegelanggang.index') }}">Data Gelanggang</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail Data Gelanggang</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Data Gelanggang</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row justify-content-center">
        <div class="col-sm-8">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Detail Data Gelanggang</h5>
              <div>
                <a href="{{ route('managegelanggang.edit', $gelanggang->id) }}" class="btn btn-warning me-2">
                  <i class="ti ti-edit me-1"></i> Edit
                </a>
                <a href="{{ route('managegelanggang.index') }}" class="btn btn-light">
                  <i class="ti ti-arrow-left me-1"></i> Kembali
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <!-- Gambar -->
                <div class="col-md-4 mb-4">
                  <div class="text-center">
                    @if($gelanggang->gambar)
                      <img src="{{ asset('image/gelanggang/' . $gelanggang->gambar) }}" 
                           alt="{{ $gelanggang->nama_gelanggang }}" 
                           class="img-fluid rounded shadow" 
                           style="max-height: 300px; object-fit: cover;">
                    @else
                      <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                           style="height: 200px;">
                        <span class="text-muted">Tidak ada gambar</span>
                      </div>
                    @endif
                  </div>
                </div>
                
                <!-- Detail Informasi -->
                <div class="col-md-8">
                  <div class="row">
                    <div class="col-sm-6 mb-3">
                      <label class="form-label fw-bold text-muted">Nama Gelanggang</label>
                      <p class="mb-0">{{ $gelanggang->nama_gelanggang }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                      <label class="form-label fw-bold text-muted">Lokasi</label>
                      <p class="mb-0">{{ $gelanggang->lokasi_gelanggang }}</p>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-6 mb-3">
                      <label class="form-label fw-bold text-muted">Dibuat Pada</label>
                      <p class="mb-0">{{ $gelanggang->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                      <label class="form-label fw-bold text-muted">Terakhir Diupdate</label>
                      <p class="mb-0">{{ $gelanggang->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <label class="form-label fw-bold text-muted">Lokasi Maps</label>
                    @if($gelanggang->latitudelongitude)
                      <div class="card border-primary">
                        <div class="card-body p-3">
                          <!-- Leaflet Map Container -->
                          <div id="map" style="height: 300px; width: 100%; border-radius: 8px; margin-bottom: 15px;"></div>

                          <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                              <i class="ti ti-map-pin text-primary me-2"></i>
                              <small class="text-muted">Lokasi gelanggang ditampilkan pada peta di atas</small>
                            </div>
                            @if($gelanggang->maps)
                              <a href="{{ $gelanggang->maps }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="ti ti-external-link me-1"></i> Buka di Google Maps
                              </a>
                            @endif
                          </div>
                        </div>
                      </div>
                    @else
                      <div class="card border-secondary">
                        <div class="card-body p-3 text-center">
                          <i class="ti ti-map-pin-off text-secondary mb-2" style="font-size: 2rem;"></i>
                          <p class="text-muted mb-0">Belum ada data koordinat lokasi untuk gelanggang ini</p>
                          @if($gelanggang->maps)
                            <div class="mt-2">
                              <a href="{{ $gelanggang->maps }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="ti ti-external-link me-1"></i> Buka Link Maps
                              </a>
                            </div>
                          @endif
                        </div>
                      </div>
                    @endif
                  </div>
                  
                  <div class="mb-3">
                    <label class="form-label fw-bold text-muted">Deskripsi</label>
                    <div class="border rounded p-3 bg-light">
                      <p class="mb-0">{{ $gelanggang->deskripsi }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="card-footer">
              <div class="d-flex justify-content-between">
                <div>
                  <a href="{{ route('managegelanggang.edit', $gelanggang->id) }}" class="btn btn-warning me-2">
                    <i class="ti ti-edit me-1"></i> Edit Data
                  </a>
                  <form action="{{ route('managegelanggang.destroy', $gelanggang->id) }}" method="POST" 
                        style="display:inline;" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                      <i class="ti ti-trash me-1"></i> Hapus Data
                    </button>
                  </form>
                </div>
                <a href="{{ route('managegelanggang.index') }}" class="btn btn-light">
                  <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Leaflet Map
        @if($gelanggang->latitudelongitude)
            // Parse koordinat dari field latitudelongitude
            let lat = -2.5489; // Default: Center Indonesia
            let lng = 118.0149;
            let zoom = 5;

            try {
                const koordinatData = '{{ $gelanggang->latitudelongitude }}';

                // Coba parse berbagai format koordinat
                if (koordinatData.includes(',')) {
                    // Format: "latitude,longitude"
                    const [latStr, lngStr] = koordinatData.split(',');
                    lat = parseFloat(latStr.trim());
                    lng = parseFloat(lngStr.trim());
                    zoom = 15;
                } else if (koordinatData.includes('{') && koordinatData.includes('}')) {
                    // Format JSON: {"lat": -6.2088, "lng": 106.8456}
                    const koordinatJson = JSON.parse(koordinatData);
                    lat = parseFloat(koordinatJson.lat || koordinatJson.latitude);
                    lng = parseFloat(koordinatJson.lng || koordinatJson.longitude);
                    zoom = 15;
                }

                // Validasi koordinat
                if (isNaN(lat) || isNaN(lng) || lat < -90 || lat > 90 || lng < -180 || lng > 180) {
                    console.warn('Koordinat tidak valid, menggunakan default Indonesia');
                    lat = -2.5489;
                    lng = 118.0149;
                    zoom = 5;
                }
            } catch (error) {
                console.error('Error parsing koordinat:', error);
                lat = -2.5489;
                lng = 118.0149;
                zoom = 5;
            }

            // Initialize map
            const map = L.map('map').setView([lat, lng], zoom);

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
            }).addTo(map);

            // Add marker with popup
            const marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup(`
                <div style="text-align: center;">
                    <h6 style="margin: 0 0 8px 0; color: #333;">{{ $gelanggang->nama_gelanggang }}</h6>
                    <p style="margin: 0; font-size: 12px; color: #666;">
                        <i class="ti ti-map-pin"></i> {{ $gelanggang->lokasi_gelanggang }}
                    </p>
                    <small style="color: #999; margin-top: 4px; display: block;">
                        Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}
                    </small>
                </div>
            `).openPopup();

            // Add custom icon style
            marker.setIcon(L.divIcon({
                className: 'custom-marker',
                html: '<div style="background-color: #007bff; width: 20px; height: 20px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>',
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            }));
        @endif

        // SweetAlert for delete confirmation
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data gelanggang '{{ $gelanggang->nama_gelanggang }}' akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection