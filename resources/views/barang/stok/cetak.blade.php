<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    table.static{
      position: relative;
      border: 1px cornsilk;
    }
  </style>
  <title>Cetak Data Stok</title>
</head>
<body>
  <div class="form-group">
    <p align="center"><b>Laporan Data Stok</b></p>
    <table class="table table-bordered" id="data-stok" align="center" rules="all" border="1px" style="width: 90%;">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Kode Barang</th>
          <th scope="col">Nama Barang</th>
          <th scope="col">Jenis</th>
          <th scope="col">Satuan</th>
          <th scope="col">Tanggal EXP</th>
          <th scope="col">Lokasi</th>
          <th scope="col">Jumlah Barang</th>
        </tr>
      </thead>
      <tbody align="center">
        @foreach ($stokBarang as $stokBarang)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $stokBarang->dataBarang->kode_barang }}</td>
          <td>{{ $stokBarang->dataBarang->nama_barang }}</td>
          <td>{{ $stokBarang->dataBarang->jenis->nama_jenis }}</td>
          <td>{{ $stokBarang->dataBarang->satuan->nama_satuan }}</td>
          <td>{{ $stokBarang->tgl_exp }}</td>
          <td>{{ $stokBarang->datagudang->nama_gudang }}</td>
          <td>{{ $stokBarang->jml_barang }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
            <th colspan="7">Total:</th>
            <th>{{ $total }}</th>
        </tr>
      </tfoot>
    </table>
  </div>
  <script class="text/javascript">
    window.print();
  </script>
</body>
</html>