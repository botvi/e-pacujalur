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
                <li class="breadcrumb-item"><a href="{{ route('managejuarapacujalur.index') }}">Data Juara Pacu Jalur</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail Data Juara Pacu Jalur</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Data Juara Pacu Jalur</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row justify-content-center">
        <div class="col-sm-10">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Detail Data Juara Pacu Jalur</h5>
              <div>
                <a href="{{ route('managejuarapacujalur.edit', $juaraPacuJalur->id) }}" class="btn btn-warning me-2">
                  <i class="ti ti-edit me-1"></i> Edit
                </a>
                <a href="{{ route('managejuarapacujalur.index') }}" class="btn btn-light">
                  <i class="ti ti-arrow-left me-1"></i> Kembali
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="row mb-4">
                    <div class="col-sm-6">
                      <label class="form-label fw-bold text-muted">Gelanggang</label>
                      <div class="border rounded p-3 bg-light">
                        <h5 class="mb-0 text-primary">{{ $juaraPacuJalur->gelanggang->nama_gelanggang }}</h5>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label fw-bold text-muted">Event</label>
                      <div class="border rounded p-3 bg-light">
                        <h5 class="mb-0 text-primary">{{ $juaraPacuJalur->event->nama_event }}</h5>
                      </div>
                    </div>
                  </div>
                  
                  <div class="mb-4">
                    <label class="form-label fw-bold text-muted">Tahun</label>
                    <div class="border rounded p-3 bg-light">
                      <h5 class="mb-0 text-primary">{{ $juaraPacuJalur->tahun }}</h5>
                    </div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label fw-bold text-muted">Daftar Juara</label>
                    <div class="border rounded p-4 bg-light">
                      @php
                        $daftarJuara = json_decode($juaraPacuJalur->daftar_juara, true);
                      @endphp
                      @if($daftarJuara && count($daftarJuara) > 0)
                        <div class="row">
                          @foreach($daftarJuara as $index => $juara)
                            @php
                              $jalur = \App\Models\Jalur::find($juara['jalur_id']);
                            @endphp
                            @if($jalur)
                              <div class="col-md-6 mb-3">
                                <div class="card border-primary">
                                  <div class="card-body text-center">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                      <i class="ti ti-trophy text-warning me-2" style="font-size: 1.5rem;"></i>
                                      <h4 class="mb-0 text-primary">Juara {{ $index + 1 }}</h4>
                                    </div>
                                    <p class="mb-0 fw-bold">{{ $jalur->nama_jalur }}</p>
                                  </div>
                                </div>
                              </div>
                            @endif
                          @endforeach
                        </div>
                      @else
                        <div class="text-center text-muted">
                          <i class="ti ti-info-circle me-2"></i>
                          Tidak ada data juara
                        </div>
                      @endif
                    </div>
                  </div>
                  
                  <div class="row mb-4">
                    <div class="col-sm-6">
                      <label class="form-label fw-bold text-muted">Dibuat Pada</label>
                      <p class="mb-0">{{ $juaraPacuJalur->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label fw-bold text-muted">Terakhir Diupdate</label>
                      <p class="mb-0">{{ $juaraPacuJalur->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="card-footer">
              <div class="d-flex justify-content-between">
                <div>
                  <a href="{{ route('managejuarapacujalur.edit', $juaraPacuJalur->id) }}" class="btn btn-warning me-2">
                    <i class="ti ti-edit me-1"></i> Edit Data
                  </a>
                  <form action="{{ route('managejuarapacujalur.destroy', $juaraPacuJalur->id) }}" method="POST" 
                        style="display:inline;" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                      <i class="ti ti-trash me-1"></i> Hapus Data
                    </button>
                  </form>
                </div>
                <a href="{{ route('managejuarapacujalur.index') }}" class="btn btn-light">
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
                    text: "Data juara pacu jalur ini akan dihapus secara permanen!",
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
.card.border-primary {
    transition: transform 0.2s ease-in-out;
}

.card.border-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.ti-trophy {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}
</style>
@endsection