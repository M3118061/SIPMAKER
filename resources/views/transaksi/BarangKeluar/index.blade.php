<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Barang Keluar')</title>
  <link rel="stylesheet" href="/assets/dataTables/datatables.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
  @include('layouts/header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('layouts/navbar')

  @include('layouts/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="card card-into card card-outline card-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Barang Keluar</h1>
          </div>
        </div><!-- /.row -->
        <div class="card-header">
          <div class="float-left">
            <form method="post">
              <a href="/BarangKeluar/{{ $id_gudang }}/create" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"> Tambah Data</i>
              </a>&nbsp;
            </form>
          </div>
        </div>
        <br>
        <!-- Main content -->
        <section class="content">
          <table class="table data-table dt-head-center table-sm table-bordered table-hover table-striped" id="datatables">
            <thead class="text-center">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jenis</th>
                <th scope="col">Jumlah Barang</th>
                <th scope="col">Satuan</th>
                <th scope="col">Tanggal Keluar</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($barangKeluar as $brgKeluar)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $brgKeluar->stokBarang->dataBarang->kode_barang }}</td>
                <td>{{ $brgKeluar->stokBarang->dataBarang->nama_barang }}</td>
                <td>{{ $brgKeluar->stokBarang->dataBarang->jenis->nama_jenis }}</td>
                <td>{{ $brgKeluar->jml_barang }}</td>
                <td>{{ $brgKeluar->stokBarang->dataBarang->satuan->nama_satuan }}</td>
                <td>{{ $brgKeluar->tgl_keluar }}</td>
                <td class="text-center">
                  <div class="btn-group btn-group-sm">
                  <a href="/BarangKeluar/{{ $brgKeluar->id_keluar }}/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                  <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusBarangKeluar{{ $brgKeluar->id_keluar }}"><i class="fas fa-trash"></i></button>

                  <div class="modal fade" id="modalHapusBarangKeluar{{ $brgKeluar->id_keluar }}" tabindex="-1" aria-labelledby="modalHapusBarangKeluar" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">
                          <h4 class="text-center">Yakin Hapus : <span>{{ $brgKeluar->stokBarang->databarang->nama_barang }} ? </span></h4></h4>
                        </div>
                        <div class="modal-footer">
                          <form action="/BarangKeluar/{{ $brgKeluar->id_keluar }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-primary">Ok</button>
                          </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>

  @include('layouts/footer')

  <script src="/assets/dataTables/datatables.min.js"></script>
  <script type="text/javascript">
    $(document).ready( function () {
      $('#datatables').DataTable();
    } );
  </script>

  <script>
    $(function(){

        @if(Session::has('success'))
            Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ Session::get("success") }}'
        })
        @endif

        @if(Session::has('error'))
            Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ Session::get("error") }}'
        })
        @endif
    });
    </script>
</body>
</html>
