<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Detail Jenis Barang')</title>
  @include('layouts/header')
  <link rel="stylesheet" href="/assets/dataTables/datatables.min.css">
  {{--  <style>
    .scroll{
      height: 400px;
      overflow: scroll;
    }
  </style>  --}}
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('layouts/navbar')

  @include('layouts/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="card">
        <div class="card-outline">
          <div class="card-header">
            <div class="float-left">
              <strong>Data Barang</strong>
            </div>
            <div class="float-right">
              <a href="/jenis" class="btn btn-secondary btn-sm"><i class="fas fa-undo"> Back</i></a>
            </div>
          </div>
        </div><!-- /.row -->

        <!-- Main content -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-10 offset-md-1">
              <section class="content">
                <div class="scroll">
                <table class="table data-table dt-head-center table-sm table-bordered table-hover table-striped " id="datatables">
                  <thead class="text-center">
                    <tr class="text-center">
                      <th scope="col">No</th>
                      <th scope="col">Nama Barang</th>
                      <th scope="col">Kode Barang</th>
                      <th scope="col">Jenis Barang</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($barang as $item)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $item->nama_barang }}</td>
                      <td>{{ $item->kode_barang }}</td>
                      <td>{{ $item->nama_jenis }}</td>
                    </tr>
                    @endforeach                  
                  </tbody>
                </table>
              </div>
              </section>
            </div>
          </div>
        </div>
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

  