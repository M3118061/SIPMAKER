<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Data Supplier')</title>
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
            <h1 class="m-0">Data Supplier</h1>
          </div>
        </div><!-- /.row -->

        <div class="card-header">
          <div class="float-left">
            <form method="post">
              <a href="/supplier/create" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"> Tambah Data</i>
              </a>
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
                <th scope="col">Nama</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Alamat</th>
                <th scope="col">No Telp</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($supplier as $sup)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $sup->nama_supplier }}</td>
                <td>{{ $sup->jk }}</td>
                <td>{{ $sup->alamat }}</td>
                <td>{{ $sup->no_telp }}</td>
                <td class="text-center">
                  <div class="btn-group btn-sm">
                  <a href="/supplier/{{ $sup->id_supplier }}/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                  <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusSupplier{{ $sup->id_supplier }}"><i class="fas fa-trash"></i></button>

                  <div class="modal fade" id="modalHapusSupplier{{ $sup->id_supplier }}" tabindex="-1" aria-labelledby="modalHapusPengguna" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">
                          <h4 class="text-center">Yakin Hapus Supplier : <span>{{ $sup->nama_supplier }} ? </span></h4></h4>
                        </div>
                        <div class="modal-footer">
                          <form action="/supplier/{{ $sup->id_supplier }}" method="post">
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
      </div><!-- /.container-fluid -->
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

  