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
                <li class="breadcrumb-item"><a href="{{ route('manageevent.index') }}">Data Event</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Tambah Data Event</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Tambah Data Event</h2>
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
              <h5>Form Tambah Data Event</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('manageevent.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                  <label class="form-label">Nama Event <span class="text-danger">*</span></label>
                  <input type="text" name="nama_event" class="form-control @error('nama_event') is-invalid @enderror" 
                         placeholder="Masukkan nama event" value="{{ old('nama_event') }}" required>
                  @error('nama_event')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                  <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                            rows="6" placeholder="Masukkan deskripsi event" required>{{ old('deskripsi') }}</textarea>
                  @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label class="form-label">Gambar Event <span class="text-danger">*</span></label>
                  <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" 
                         accept="image/*" required>
                  <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF, SVG. Maksimal 2MB</small>
                  @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary me-2">
                    <i class="ti ti-plus me-1"></i> Simpan Data
                  </button>
                  <a href="{{ route('manageevent.index') }}" class="btn btn-light">
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
    // Auto-resize textarea
    document.querySelector('textarea[name="deskripsi"]').addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    // Character counter untuk deskripsi
    const textarea = document.querySelector('textarea[name="deskripsi"]');
    const counter = document.createElement('small');
    counter.className = 'form-text text-muted';
    counter.textContent = '0 karakter';
    textarea.parentNode.appendChild(counter);

    textarea.addEventListener('input', function() {
        counter.textContent = this.value.length + ' karakter';
    });

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
</script>
@endsection