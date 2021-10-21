<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Laporan Stok Barang')</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
            <h1 class="m-0">Laporan Stok Barang</h1>
          </div>
        </div><!-- /.row -->

        <div class="card-header">
          <div class="row">
            <div class="col-lg-6 col-6">
              <div class="small-box btn btn-success">
                <div class="inner">
                  <a href="/stokBarang/cetak" class="btn" target="blank">
                    <i class="fas fa-print"> Laporan (All Data)</i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-6">
              <div class="small-box btn btn-warning">
                <div class="inner">
                  <!-- Button Triger Modal -->
                  <button type="button" class="btn" data-toggle="modal" data-target="#laporanStok">
                    <i class="fas fa-calendar"> Laporan (Filter)</i>
                  </button>
                  <!-- Modal -->
                  <div class="modal fade" id="laporanStok" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Cetak Laporan Pertanggal</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="/laporanStokPertanggal/cetak" method="get" target="blank">
                            <div class="form-group">
                              <div class="my-3">
                                <label for="label">Tanggal Awal : </label>
                                <input type="date" name="tglawal" id="tglawal" class="form-control">
                              </div>
                              <div class="my-3">
                                <label for="label">Taggal Akhir : </label>
                                <input type="date" name="tglakhir" id="tglakhir" class="form-control">
                              </div>
                              <div class="my-3">
                                <label for="label">Lokasi : </label>
                                <select name="id_gudang" class="form-control">
                                  @foreach ($dataGudang as $item)
                                      <option value="{{ $item->id_gudang }}">{{ $item->nama_gudang }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <button type="submit" class="btn btn-primary"><i class="fas fa-print"> Cetak</i></button>
                              {{--  <div class="my-3">
                                <a href="" onclick="this.href='/laporanStokPertanggal/'+document.getElementById('tglawal').value + '/' 
                                + document.getElementById('tglakhir').value" target="_blank" class="btn btn-primary"><i class="fas fa-print"> Cetak</i></a>
                              </div>  --}}
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
            <div id="chartJenis"></div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
  
  @include('layouts/footer')

  <script src="https://code.highcharts.com/highcharts.js"></script>

      <script>
        Highcharts.chart('chartJenis', {
          chart: {
              type: 'column'
          },
          title: {
              text: 'Data Stok Barang'
          },
          xAxis: {
              categories: {!! json_encode($categories) !!},
              crosshair: true
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Jumlah'
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:1f} </b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              }
          },
          series: [{
              name: 'Jumlah',
              data: {!! json_encode($data) !!}

          }]
      });
      </script>
  </body>
</html>
  