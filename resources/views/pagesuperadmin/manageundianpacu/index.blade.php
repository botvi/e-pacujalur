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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Data Undian Pacu</a></li>
                <li class="breadcrumb-item" aria-current="page">Tabel Data Undian Pacu</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Tabel Data Undian Pacu</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- Zero config table start -->
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tabel Data Undian Pacu</h5>
                <a href="{{ route('manageundianpacu.create') }}" class="btn btn-primary">Tambah Data Undian Pacu</a>
            </div>
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap align-middle">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Event</th>
                      <th>Gelanggang</th>
                      <th>Tanggal</th>
                      <th>Jam</th>
                      <th>Hasil Undian Jalur</th>
                      <th>Dibuat Pada</th>
                      <th>Terakhir Diupdate</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($undianPacu as $j => $item)
                    @php
                      $participants = is_array($item->participants) ? $item->participants : (json_decode($item->participants, true) ?? []);
                      $pairing = $participants['pairing'] ?? [];
                      $hasPairing = is_array($pairing) && count($pairing) > 0;
                    @endphp
                    <tr>
                      <td>{{ $j+1 }}</td>
                      <td>{{ $item->event->nama_event }}</td>
                      <td>{{ $item->gelanggang->nama_gelanggang }}</td>
                      <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                      <td>{{ $item->jam }}</td>
                      <td class="text-center">
                        @if($hasPairing)
                          <a href="{{ route('manageundianpacu.export', $item->id) }}" class="btn btn-sm btn-success">
                            <i class="ti ti-download me-1"></i> Download Excel
                          </a>
                        @else
                          <span class="badge bg-secondary">Belum diundi</span>
                        @endif
                      </td>
                      <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                      <td>{{ $item->updated_at->format('d M Y, H:i') }}</td>
                      <td>
                        <a href="{{ route('manageundianpacu.show', $item->id) }}" class="btn btn-sm btn-info me-1">Lihat</a>
                        <a href="{{ route('manageundianpacu.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                        <form action="{{ route('manageundianpacu.destroy', $item->id) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Event</th>
                      <th>Gelanggang</th>
                      <th>Tanggal</th>
                      <th>Jam</th>
                      <th>Hasil Undian Jalur</th>
                      <th>Dibuat Pada</th>
                      <th>Terakhir Diupdate</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Zero config table end -->
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
                    text: "Data undian pacu ini akan dihapus secara permanen!",
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
  <script>
    $(document).ready(function() {
      $('#simpletable').DataTable();
    });
  </script>
  @endsection