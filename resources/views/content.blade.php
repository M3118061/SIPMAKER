<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Jenis Barang')</title>
  @include('layouts/header')
  <link rel="stylesheet" href="/assets/dataTables/datatables.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
</head>
<div class="row">
  @if (auth()->user()->role == 'Admin')
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Data Users</span>
        <span class="info-box-number">
          {{ \App\Models\User::count() }}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Jenis Barang</span>
        <span class="info-box-number">{{ \App\Models\JenisBarang::count() }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Satuan Barang</span>
        <span class="info-box-number">{{ \App\Models\SatuanBarang::count() }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Data Barang</span>
        <span class="info-box-number">{{ \App\Models\DataBarang::count() }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Data Supplier</span>
        <span class="info-box-number">{{ \App\Models\Supplier::count() }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Data Gudang</span>
        <span class="info-box-number">{{ \App\Models\Gudang::count() }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  @endif

  @if (auth()->user()->role == 'Pegawai')
  <div class="container">
    <div class="card card-body">
      <div class="text-center">
        <h2 class="section">Pilih Aksi</h2><br>
      </div>
      <div class="row text-center">
        <div class="col-md-4">
            <span class="fa-stack fa-4x">
                <i class="fas fa-circle fa-stack-2x text-success"></i>
                <i class="fas fa-cubes fa-stack-1x fa-inverse"></i>
            </span>
            <div class="row-md-4 mt-4">
              <a href="/stokBarang/{{ $id_gudang }}" class="btn btn-info">Stok Barang</a>
            </div>
          </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-dolly-flatbed fa-stack-1x fa-inverse"></i>
          </span>
          <div class="row-md-4 mt-4">
            <a href="/BarangMasuk/{{ $id_gudang }}" class="btn btn-info">Barang Masuk</a>
          </div>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-dark"></i>
              <i class="fas fa-dolly fa-stack-1x fa-inverse"></i>
          </span>
          <div class="row-md-4 mt-4">
            <a href="/BarangKeluar/{{ $id_gudang }}" class="btn btn-info">Barang Keluar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

  @if (auth()->user()->role == 'Manajer')
  <div class="container-fluid">
    <div class="card-deck">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Barang Kedaluwarsa</h3>
            </div>
              <div class="card-body">
                <section class="content">
                  <table class="table data-table dt-head-center table-sm table-bordered table-hover table-striped" id="datatablesStokEXP">
                    <thead class="text-center">
                      <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Tanggal EXP</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $no = 1;
                      @endphp
                      @foreach ($stokBarang as $stok)
                        @if ($stok->tgl_exp <= date('Y-m-d'))
                        <tr>
                          <td class="text-center">{{ $no++ }}</td>
                          <td>{{ $stok->dataBarang->kode_barang }}</td>
                          <td>{{ $stok->dataBarang->nama_barang }}</td>
                          <td>{{ $stok->tgl_exp }}</td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </section>
              </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Stok Minimum</h3>
                </div>
                <div class="card-body">
                  <section class="content">
                    <table class="table data-table dt-head-center table-sm table-bordered table-hover table-striped" id="datatablesStokMin">
                      <thead class="text-center">
                        <tr class="text-center">
                          <th scope="col">No</th>
                          <th scope="col">Kode Barang</th>
                          <th scope="col">Nama Barang</th>
                          <th scope="col">Stok Barang</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($stokBarang as $stok)
                          @if ($stok->jml_barang <= $stok->jml_min)
                          <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $stok->dataBarang->kode_barang }}</td>
                            <td>{{ $stok->dataBarang->nama_barang }}</td>
                            <td class="text-center">{{ $stok->jml_barang }}</td>
                          </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                  </section>
                </div>
            </div>
          </div>
        </div>

  <!-- /.col -->
  @endif

</div>
<!-- /.row -->
@if(Auth::check())
    <script>
      $(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          expiredNotif();
          setInterval(expiredNotif, 10000);
      });
      function expiredNotif(){
          $.ajax({
              url: "{{ route('products.expiryCheck') }}",
              type: "GET",
              data: {"format": "json"},
              dataType: "json",
              success:function(data) {
                  $('#notif_expired_badge').text(data.count);
                  $('#notif_expired').text(data.count);
              }
          });
          $.ajax({
              url: "{{ route('products.expiryCheck') }}",
              type: "GET",
              data: {"format": "json", "interval":true},
              dataType: "json",
              success:function(data) {
                  $('#notif_reminder_badge').text(data.count);
                  $('#notif_reminder').text(data.count);
              }
          });
      }
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
    @endif

    @section('footer')
    <script src="/assets/dataTables/datatables.min.js"></script>
    <script type="text/javascript">
      $(document).ready( function () {
        $('#datatablesStokMin').DataTable();
      } );
    </script>

    <script src="/assets/dataTables/datatables.min.js"></script>
    <script type="text/javascript">
      $(document).ready( function () {
        $('#datatablesStokEXP').DataTable();
      } );
    </script>
    @endsection
    
