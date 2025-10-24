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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Data Gelanggang</a></li>
                <li class="breadcrumb-item" aria-current="page">Tabel Data Gelanggang</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Tabel Data Gelanggang</h2>
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
                <h5 class="mb-0">Tabel Data Gelanggang</h5>
                <a href="{{ route('managegelanggang.create') }}" class="btn btn-primary">Tambah Data Gelanggang</a>
            </div>
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Gambar</th>
                      <th>Nama Gelanggang</th>
                      <th>Deskripsi</th>
                      <th>Lokasi</th>
                      <th>Maps</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($gelanggang as $g => $item)
                    <tr>
                      <td>{{ $g+1 }}</td>
                      <td>
                        @if($item->gambar)
                          <img src="{{ asset('image/gelanggang/' . $item->gambar) }}" alt="{{ $item->nama_gelanggang }}" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                        @else
                          <span class="text-muted">Tidak ada gambar</span>
                        @endif
                      </td>
                      <td>{{ $item->nama_gelanggang }}</td>
                      <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                      <td>{{ $item->lokasi_gelanggang }}</td>
                      <td>
                        @if($item->maps)
                          <a href="{{ $item->maps }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="ti ti-map-pin me-1"></i> Lihat Maps
                          </a>
                        @else
                          <span class="text-muted">Tidak ada maps</span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('managegelanggang.show', $item->id) }}" class="btn btn-sm btn-info me-1">Lihat</a>
                        <a href="{{ route('managegelanggang.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                        <form action="{{ route('managegelanggang.destroy', $item->id) }}" method="POST" style="display:inline;" class="delete-form">
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
                      <th>Gambar</th>
                      <th>Nama Gelanggang</th>
                      <th>Deskripsi</th>
                      <th>Lokasi</th>
                      <th>Maps</th>
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
                    text: "Data gelanggang ini akan dihapus secara permanen!",
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