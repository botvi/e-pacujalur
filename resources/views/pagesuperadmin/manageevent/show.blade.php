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
                <li class="breadcrumb-item" aria-current="page">Detail Data Event</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Data Event</h2>
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
              <h5 class="mb-0">Detail Data Event</h5>
              <div>
                <a href="{{ route('manageevent.edit', $event->id) }}" class="btn btn-warning me-2">
                  <i class="ti ti-edit me-1"></i> Edit
                </a>
                <a href="{{ route('manageevent.index') }}" class="btn btn-light">
                  <i class="ti ti-arrow-left me-1"></i> Kembali
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <!-- Gambar -->
                <div class="col-md-4 mb-4">
                  <div class="text-center">
                    @if($event->gambar)
                      <img src="{{ asset('image/event/' . $event->gambar) }}" 
                           alt="{{ $event->nama_event }}" 
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
                  <div class="mb-4">
                    <label class="form-label fw-bold text-muted">Nama Event</label>
                    <div class="border rounded p-3 bg-light">
                      <h4 class="mb-0 text-primary">{{ $event->nama_event }}</h4>
                    </div>
                  </div>
                  
                  <div class="row mb-4">
                    <div class="col-sm-6">
                      <label class="form-label fw-bold text-muted">Dibuat Pada</label>
                      <p class="mb-0">{{ $event->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label fw-bold text-muted">Terakhir Diupdate</label>
                      <p class="mb-0">{{ $event->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                  </div>
                  
                  <div class="mb-4">
                    <label class="form-label fw-bold text-muted">Deskripsi</label>
                    <div class="border rounded p-4 bg-light">
                      <div class="event-description">
                        {!! nl2br(e($event->deskripsi)) !!}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="card-footer">
              <div class="d-flex justify-content-between">
                <div>
                  <a href="{{ route('manageevent.edit', $event->id) }}" class="btn btn-warning me-2">
                    <i class="ti ti-edit me-1"></i> Edit Data
                  </a>
                  <form action="{{ route('manageevent.destroy', $event->id) }}" method="POST" 
                        style="display:inline;" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                      <i class="ti ti-trash me-1"></i> Hapus Data
                    </button>
                  </form>
                </div>
                <a href="{{ route('manageevent.index') }}" class="btn btn-light">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data event '{{ $event->nama_event }}' akan dihapus secara permanen!",
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

<style>
.event-description {
    line-height: 1.6;
    font-size: 1rem;
}

.event-description p {
    margin-bottom: 1rem;
}

.event-description p:last-child {
    margin-bottom: 0;
}

.img-fluid.rounded.shadow {
    transition: transform 0.3s ease-in-out;
}

.img-fluid.rounded.shadow:hover {
    transform: scale(1.05);
}
</style>
@endsection