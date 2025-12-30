@extends('template-admin.layout')

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
                <li class="breadcrumb-item" aria-current="page">Form Tambah Data Gelanggang</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Tambah Data Gelanggang</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row justify-content-center">
        <!-- [ form-element ] start -->
        <div class="col-sm-8">
          <!-- Basic Inputs -->
          <div class="card">
            <div class="card-header">
              <h5>Form Tambah Data Gelanggang</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('managegelanggang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label">Nama Gelanggang <span class="text-danger">*</span></label>
                      <input type="text" name="nama_gelanggang" class="form-control @error('nama_gelanggang') is-invalid @enderror" 
                             placeholder="Masukkan nama gelanggang" value="{{ old('nama_gelanggang') }}" required>
                      @error('nama_gelanggang')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label">Lokasi Gelanggang <span class="text-danger">*</span></label>
                      <input type="text" name="lokasi_gelanggang" class="form-control @error('lokasi_gelanggang') is-invalid @enderror" 
                             placeholder="Masukkan lokasi gelanggang" value="{{ old('lokasi_gelanggang') }}" required>
                      @error('lokasi_gelanggang')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label">Latitude Longitude Maps <span class="text-danger">*</span></label>
                      <input type="text" name="latitudelongitude" class="form-control @error('latitudelongitude') is-invalid @enderror" 
                             placeholder="Latitude, Longitude" value="{{ old('latitudelongitude') }}" required>
                      <small class="form-text text-muted">Masukkan latitude longitude maps</small>
                      @error('latitudelongitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div> 
                  </div>
                </div>

                <div class="form-group mb-3">
                  <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                  <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                            rows="4" placeholder="Masukkan deskripsi gelanggang" required>{{ old('deskripsi') }}</textarea>
                  @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary me-2">
                    <i class="ti ti-plus me-1"></i> Simpan Data
                  </button>
                  <a href="{{ route('managegelanggang.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left me-1"></i> Kembali
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
<script>
    // Preview gambar sebelum upload
    document.querySelector('input[name="gambar"]').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Buat preview jika belum ada
                let preview = document.querySelector('.image-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.className = 'image-preview mt-2';
                    e.target.parentNode.appendChild(preview);
                }
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" style="max-width: 200px; max-height: 200px; object-fit: cover;" class="rounded border">
                    <p class="text-muted mt-1">Preview gambar</p>
                `;
            };
            reader.readAsDataURL(file);
        }
    });

    // Validasi URL Maps
    document.querySelector('input[name="maps"]').addEventListener('blur', function(e) {
        const url = e.target.value;
        if (url && !isValidUrl(url)) {
            e.target.classList.add('is-invalid');
            let feedback = e.target.parentNode.querySelector('.invalid-feedback');
            if (!feedback) {
                feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                e.target.parentNode.appendChild(feedback);
            }
            feedback.textContent = 'Format URL tidak valid';
        } else {
            e.target.classList.remove('is-invalid');
        }
    });

    function isValidUrl(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }
</script>
@endsection