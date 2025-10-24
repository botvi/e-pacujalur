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
                <li class="breadcrumb-item" aria-current="page">Form Tambah Data Juara Pacu Jalur</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Tambah Data Juara Pacu Jalur</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row justify-content-center">
        <!-- [ form-element ] start -->
        <div class="col-sm-10">
          <!-- Basic Inputs -->
          <div class="card">
            <div class="card-header">
              <h5>Form Tambah Data Juara Pacu Jalur</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('managejuarapacujalur.store') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label">Gelanggang <span class="text-danger">*</span></label>
                      <select name="gelanggang_id" class="form-control @error('gelanggang_id') is-invalid @enderror" required>
                        <option value="">Pilih Gelanggang</option>
                        @foreach($gelanggang as $g)
                          <option value="{{ $g->id }}" {{ old('gelanggang_id') == $g->id ? 'selected' : '' }}>
                            {{ $g->nama_gelanggang }}
                          </option>
                        @endforeach
                      </select>
                      @error('gelanggang_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label">Event <span class="text-danger">*</span></label>
                      <select name="event_id" class="form-control @error('event_id') is-invalid @enderror" required>
                        <option value="">Pilih Event</option>
                        @foreach($event as $e)
                          <option value="{{ $e->id }}" {{ old('event_id') == $e->id ? 'selected' : '' }}>
                            {{ $e->nama_event }}
                          </option>
                        @endforeach
                      </select>
                      @error('event_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="form-group mb-3">
                  <label class="form-label">Tahun <span class="text-danger">*</span></label>
                  <select name="tahun" class="form-control @error('tahun') is-invalid @enderror" required>
                    <option value="">Pilih Tahun</option>
                    @php
                      $tahun_ini = date('Y');
                      $tahun_awal = $tahun_ini - 20;
                      $tahun_akhir = $tahun_ini + 3;
                    @endphp
                    @for ($th = $tahun_awal; $th <= $tahun_akhir; $th++)
                      <option value="{{ $th }}" {{ old('tahun') == $th ? 'selected' : '' }}>{{ $th }}</option>
                    @endfor
                  </select>
                  @error('tahun')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                

                <div class="form-group mb-3">
                  <label class="form-label">Daftar Juara <span class="text-danger">*</span></label>
                  <div id="daftar-juara-container">
                    <div class="juara-item mb-3 p-3 border rounded">
                      <div class="row">
                        <div class="col-md-6">
                          <label class="form-label">Juara 1</label>
                          <select name="daftar_juara[0][jalur_id]" class="form-control @error('daftar_juara.0.jalur_id') is-invalid @enderror" required>
                            <option value="">Pilih Jalur</option>
                            @foreach($jalur as $j)
                              <option value="{{ $j->id }}" {{ old('daftar_juara.0.jalur_id') == $j->id ? 'selected' : '' }}>
                                {{ $j->nama_jalur }}
                              </option>
                            @endforeach
                          </select>
                          @error('daftar_juara.0.jalur_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                          <button type="button" class="btn btn-danger btn-sm remove-juara" style="display: none;">
                            <i class="ti ti-trash me-1"></i> Hapus
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" id="tambah-juara">
                    <i class="ti ti-plus me-1"></i> Tambah Juara
                  </button>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary me-2">
                    <i class="ti ti-plus me-1"></i> Simpan Data
                  </button>
                  <a href="{{ route('managejuarapacujalur.index') }}" class="btn btn-light">
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
    let juaraCount = 1;

    document.getElementById('tambah-juara').addEventListener('click', function() {
        const container = document.getElementById('daftar-juara-container');
        const newJuaraItem = document.createElement('div');
        newJuaraItem.className = 'juara-item mb-3 p-3 border rounded';
        
        newJuaraItem.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Juara ${juaraCount + 1}</label>
                    <select name="daftar_juara[${juaraCount}][jalur_id]" class="form-control" required>
                        <option value="">Pilih Jalur</option>
                        @foreach($jalur as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jalur }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm remove-juara">
                        <i class="ti ti-trash me-1"></i> Hapus
                    </button>
                </div>
            </div>
        `;
        
        container.appendChild(newJuaraItem);
        juaraCount++;
        
        // Tampilkan tombol hapus untuk semua item
        document.querySelectorAll('.remove-juara').forEach(btn => {
            btn.style.display = 'block';
        });
    });

    // Event delegation untuk tombol hapus
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-juara')) {
            e.target.closest('.juara-item').remove();
            
            // Update nomor juara
            updateJuaraNumbers();
            
            // Sembunyikan tombol hapus jika hanya ada 1 item
            if (document.querySelectorAll('.juara-item').length === 1) {
                document.querySelector('.remove-juara').style.display = 'none';
            }
        }
    });

    function updateJuaraNumbers() {
        document.querySelectorAll('.juara-item').forEach((item, index) => {
            const label = item.querySelector('label');
            const select = item.querySelector('select');
            label.textContent = `Juara ${index + 1}`;
            select.name = `daftar_juara[${index}][jalur_id]`;
        });
    }
</script>
@endsection