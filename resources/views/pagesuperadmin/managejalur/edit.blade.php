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
                <li class="breadcrumb-item"><a href="{{ route('managejalur.index') }}">Data Jalur</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Edit Data Jalur</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Edit Data Jalur</h2>
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
              <h5>Form Edit Data Jalur</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('managejalur.update', $jalur->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label">Nama Jalur <span class="text-danger">*</span></label>
                      <input type="text" name="nama_jalur" class="form-control @error('nama_jalur') is-invalid @enderror" 
                             placeholder="Masukkan nama jalur" value="{{ old('nama_jalur', $jalur->nama_jalur) }}" required>
                      @error('nama_jalur')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label">Asal Jalur <span class="text-danger">*</span></label>
                      <input type="text" name="asal_jalur" class="form-control @error('asal_jalur') is-invalid @enderror" 
                             placeholder="Masukkan asal jalur" value="{{ old('asal_jalur', $jalur->asal_jalur) }}" required>
                      @error('asal_jalur')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label">Tahun Buat <span class="text-danger">*</span></label>
                      <input type="text" name="tahun_buat" class="form-control @error('tahun_buat') is-invalid @enderror" 
                             placeholder="Contoh: 2024" value="{{ old('tahun_buat', $jalur->tahun_buat) }}" required>
                      @error('tahun_buat')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label">Gambar Jalur</label>
                      <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" 
                             accept="image/*">
                      <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF, SVG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                      @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <!-- Preview gambar saat ini -->
                @if($jalur->gambar)
                <div class="form-group mb-3">
                  <label class="form-label">Gambar Saat Ini</label>
                  <div class="current-image">
                    <img src="{{ asset('image/jalur/' . $jalur->gambar) }}" alt="{{ $jalur->nama_jalur }}" 
                         style="max-width: 200px; max-height: 200px; object-fit: cover;" class="rounded border">
                    <p class="text-muted mt-1">Gambar yang sedang digunakan</p>
                  </div>
                </div>
                @endif

                <div class="form-group mb-3">
                  <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                  <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                            rows="4" placeholder="Masukkan deskripsi jalur" required>{{ old('deskripsi', $jalur->deskripsi) }}</textarea>
                  @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary me-2">
                    <i class="ti ti-edit me-1"></i> Update Data
                  </button>
                  <a href="{{ route('managejalur.index') }}" class="btn btn-light">
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
    // Preview gambar baru sebelum upload
    document.querySelector('input[name="gambar"]').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Buat preview jika belum ada
                let preview = document.querySelector('.new-image-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.className = 'new-image-preview mt-2';
                    e.target.parentNode.appendChild(preview);
                }
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" style="max-width: 200px; max-height: 200px; object-fit: cover;" class="rounded border">
                    <p class="text-success mt-1">Preview gambar baru</p>
                `;
            };
            reader.readAsDataURL(file);
        } else {
            // Hapus preview jika file dihapus
            const preview = document.querySelector('.new-image-preview');
            if (preview) {
                preview.remove();
            }
        }
    });
</script>
@endsection