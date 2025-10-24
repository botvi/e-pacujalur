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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Data Jalur</a></li>
                <li class="breadcrumb-item" aria-current="page">Tabel Data Jalur</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Tabel Data Jalur</h2>
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
                <h5 class="mb-0">Tabel Data Jalur</h5>
                <a href="{{ route('managejalur.create') }}" class="btn btn-primary">Tambah Data Jalur</a>
            </div>
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Gambar</th>
                      <th>Nama Jalur</th>
                      <th>Deskripsi</th>
                      <th>Asal Jalur</th>
                      <th>Tahun Buat</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($jalur as $j => $item)
                    <tr>
                      <td>{{ $j+1 }}</td>
                      <td>
                        @if($item->gambar)
                          <img src="{{ asset('image/jalur/' . $item->gambar) }}" alt="{{ $item->nama_jalur }}" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                        @else
                          <span class="text-muted">Tidak ada gambar</span>
                        @endif
                      </td>
                      <td>{{ $item->nama_jalur }}</td>
                      <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                      <td>{{ $item->asal_jalur }}</td>
                      <td>{{ $item->tahun_buat }}</td>
                      <td>
                        <a href="{{ route('managejalur.show', $item->id) }}" class="btn btn-sm btn-info me-1">Lihat</a>
                        <a href="{{ route('managejalur.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                        <form action="{{ route('managejalur.destroy', $item->id) }}" method="POST" style="display:inline;" class="delete-form">
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
                      <th>Nama Jalur</th>
                      <th>Deskripsi</th>
                      <th>Asal Jalur</th>
                      <th>Tahun Buat</th>
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
                    text: "Data jalur ini akan dihapus secara permanen!",
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