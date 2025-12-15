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
                <li class="breadcrumb-item" aria-current="page">Form Tambah Data Undian Pacu</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Tambah Data Undian Pacu</h2>
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
              <h5>Form Tambah Data Undian Pacu</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('manageundianpacu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

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

                <div class="form-group mb-3">
                  <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                  <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" 
                         value="{{ old('tanggal') }}" required>
                  @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label class="form-label">Jam <span class="text-danger">*</span></label>
                  <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror" 
                         value="{{ old('jam') }}" required>
                  @error('jam')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                {{-- Pilih Jalur Peserta --}}
                @php
                    $oldPeserta = old('jalur_peserta', []);
                @endphp
                <div class="form-group mb-3">
                  <label class="form-label">Pilih Jalur Peserta <span class="text-danger">*</span></label>
                  <div class="border rounded p-2" style="max-height: 220px; overflow-y: auto;">
                    @foreach($jalur as $j)
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="jalur_peserta[]" id="jalur-check-{{ $j->id }}" value="{{ $j->id }}"
                               {{ in_array($j->id, $oldPeserta ?: []) ? 'checked' : '' }}>
                        <label class="form-check-label" for="jalur-check-{{ $j->id }}">
                          {{ $j->nama_jalur }}
                        </label>
                      </div>
                    @endforeach
                  </div>
                  @error('jalur_peserta')
                    <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>

                {{-- Spinner Undian Jalur --}}
                <div class="form-group mb-3">
                  <label class="form-label">Undian Jalur (Spinner) <span class="text-danger">*</span></label>

                  <div class="mb-2">
                    <button type="button" class="btn btn-outline-primary w-100" id="btn-spin-jalur">
                      <span class="spinner-border spinner-border-sm me-2 d-none" id="spinner-jalur" role="status" aria-hidden="true"></span>
                      Acak Seluruh Jalur Peserta (Kiri vs Kanan + Bay)
                    </button>
                    <small class="text-muted d-block mt-1">
                      Centang dulu jalur yang ikut, lalu klik tombol untuk mengacak. Contoh: Jalur 1 (kiri) vs Jalur 2 (kanan),
                      Jalur 3 (kanan) vs Jalur 4 (kiri), Jalur 5 (bay).
                    </small>
                  </div>

                  <div class="table-responsive border rounded" id="pairing-display">
                    <table class="table table-sm table-bordered mb-0 align-middle">
                      <thead class="table-light">
                        <tr>
                          <th style="width: 50px;">#</th>
                          <th>Jalur Kiri</th>
                          <th>Jalur Kanan / Bay</th>
                        </tr>
                      </thead>
                      <tbody id="pairing-body">
                        <tr>
                          <td colspan="3" class="text-center text-muted">Belum ada hasil undian.</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  {{-- hidden container untuk menyimpan hasil pair ke array participants --}}
                  <div id="participants-hidden-container"></div>

                  @error('participants')
                    <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary me-2">
                    <i class="ti ti-plus me-1"></i> Simpan Data
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
    (function () {
        const jalurData = @json($jalur ?? []);

        const btnSpin = document.getElementById('btn-spin-jalur');
        const spinner = document.getElementById('spinner-jalur');
        const pairingBody = document.getElementById('pairing-body');
        const hiddenContainer = document.getElementById('participants-hidden-container');
        const checkboxNodes = document.querySelectorAll('input[name="jalur_peserta[]"]');

        function getNamaJalurById(id) {
            const found = jalurData.find(j => String(j.id) === String(id));
            return found ? found.nama_jalur : '-';
        }

        function getSelectedJalur() {
            const selectedIds = Array.from(checkboxNodes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            return jalurData.filter(j => selectedIds.includes(String(j.id)));
        }

        function shuffle(array) {
            const arr = array.slice();
            for (let i = arr.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [arr[i], arr[j]] = [arr[j], arr[i]];
            }
            return arr;
        }

        function renderPairingPreview(order) {
            pairingBody.innerHTML = '';
            if (!order.length) {
                pairingBody.innerHTML = '<tr><td colspan=\"3\" class=\"text-center text-muted\">Belum ada hasil undian.</td></tr>';
                return;
            }

            let pairIndex = 0;
            for (let i = 0; i < order.length; i += 2) {
                const tr = document.createElement('tr');

                const tdNo = document.createElement('td');
                tdNo.textContent = pairIndex + 1;
                tr.appendChild(tdNo);

                const tdKiri = document.createElement('td');
                const tdKanan = document.createElement('td');

                if (i + 1 < order.length) {
                    const kiri = order[i];
                    const kanan = order[i + 1];
                    tdKiri.textContent = kiri.nama_jalur + ' (kiri)';
                    tdKanan.textContent = kanan.nama_jalur + ' (kanan)';
                } else {
                    const bay = order[i];
                    tdKiri.textContent = '-';
                    tdKanan.textContent = bay.nama_jalur + ' (bay)';
                }

                tr.appendChild(tdKiri);
                tr.appendChild(tdKanan);

                pairingBody.appendChild(tr);
                pairIndex++;
            }
        }

        function savePairingToHidden(order) {
            hiddenContainer.innerHTML = '';
            if (!order.length) return;

            let pairIndex = 0;
            for (let i = 0; i < order.length; i += 2) {
                if (i + 1 < order.length) {
                    const kiri = order[i];
                    const kanan = order[i + 1];

                    const kiriInput = document.createElement('input');
                    kiriInput.type = 'hidden';
                    kiriInput.name = `participants[${pairIndex}][kiri]`;
                    kiriInput.value = kiri.id;

                    const kananInput = document.createElement('input');
                    kananInput.type = 'hidden';
                    kananInput.name = `participants[${pairIndex}][kanan]`;
                    kananInput.value = kanan.id;

                    hiddenContainer.appendChild(kiriInput);
                    hiddenContainer.appendChild(kananInput);
                } else {
                    const bay = order[i];

                    const bayInput = document.createElement('input');
                    bayInput.type = 'hidden';
                    bayInput.name = `participants[${pairIndex}][bay]`;
                    bayInput.value = bay.id;

                    hiddenContainer.appendChild(bayInput);
                }
                pairIndex++;
            }
        }

        if (btnSpin) {
            btnSpin.addEventListener('click', function () {
                const activeJalur = getSelectedJalur();

                if (!activeJalur.length) {
                    alert('Silakan centang dulu jalur yang akan menjadi peserta.');
                    return;
                }
                if (activeJalur.length < 2) {
                    alert('Minimal harus ada 2 jalur peserta untuk diacak.');
                    return;
                }

                btnSpin.disabled = true;
                spinner.classList.remove('d-none');

                let step = 0;
                const maxStep = 20; // durasi putaran

                let lastOrder = activeJalur;

                const interval = setInterval(() => {
                    // acak urutan seluruh jalur peserta
                    lastOrder = shuffle(activeJalur);
                    renderPairingPreview(lastOrder);

                    step++;
                    if (step >= maxStep) {
                        clearInterval(interval);
                        // simpan hasil akhir ke hidden input participants[*]
                        savePairingToHidden(lastOrder);
                        spinner.classList.add('d-none');
                        btnSpin.disabled = false;
                    }
                }, 100);
            });
        }
    })();
</script>
@endsection
