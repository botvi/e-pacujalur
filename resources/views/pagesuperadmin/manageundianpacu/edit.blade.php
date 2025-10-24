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
                <li class="breadcrumb-item"><a href="{{ route('manageundianpacu.index') }}">Data Undian Pacu</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Edit Data Undian Pacu</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Edit Data Undian Pacu</h2>
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
              <h5>Form Edit Data Undian Pacu</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('manageundianpacu.update', $undianPacu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                  <label class="form-label">Event <span class="text-danger">*</span></label>
                  <select name="event_id" class="form-control @error('event_id') is-invalid @enderror" required>
                    <option value="">Pilih Event</option>
                    @foreach($event as $e)
                      <option value="{{ $e->id }}" {{ old('event_id', $undianPacu->event_id) == $e->id ? 'selected' : '' }}>
                        {{ $e->nama_event }}
                      </option>
                    @endforeach
                  </select>
                  @error('event_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label class="form-label">Gelanggang <span class="text-danger">*</span></label>
                  <select name="gelanggang_id" class="form-control @error('gelanggang_id') is-invalid @enderror" required>
                    <option value="">Pilih Gelanggang</option>
                    @foreach($gelanggang as $g)
                      <option value="{{ $g->id }}" {{ old('gelanggang_id', $undianPacu->gelanggang_id) == $g->id ? 'selected' : '' }}>
                        {{ $g->nama_gelanggang }}
                      </option>
                    @endforeach
                  </select>
                  @error('gelanggang_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                  <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" 
                         value="{{ old('tanggal', $undianPacu->tanggal) }}" required>
                  @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label class="form-label">Jam <span class="text-danger">*</span></label>
                  <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror" 
                         value="{{ old('jam', $undianPacu->jam) }}" required>
                  @error('jam')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label class="form-label">Gambar Undian Pacu</label>
                  <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" 
                         accept="image/*">
                  <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF, SVG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                  @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Preview gambar saat ini -->
                @if($undianPacu->gambar)
                <div class="form-group mb-3">
                  <label class="form-label">Gambar Saat Ini</label>
                  <div class="current-image">
                    <img src="{{ asset('image/undianpacu/' . $undianPacu->gambar) }}" alt="Gambar Undian Pacu" 
                         style="max-width: 200px; max-height: 200px; object-fit: cover;" class="rounded border">
                    <p class="text-muted mt-1">Gambar yang sedang digunakan</p>
                  </div>
                </div>
                @endif

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary me-2">
                    <i class="ti ti-edit me-1"></i> Update Data
                  </button>
                  <a href="{{ route('manageundianpacu.index') }}" class="btn btn-light">
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