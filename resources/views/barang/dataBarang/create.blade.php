<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Tambah Data Barang')</title>
  @include('layouts/header')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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
              <strong>Tambah Data Barang</strong>
            </div>
            <div class="float-right">
              <a href="/dataBarang" class="btn btn-secondary btn-sm"><i class="fas fa-undo"> Back</i></a>
            </div>
          </div>
        </div><!-- /.row -->
        <!-- Main content -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-4 offset-md-4">
              <section class="content">
                <form class="p-3" method="POST" action="/dataBarang">
                  @csrf
                  <div class="mb-3">
                    <label for="kode_barang" class="form-label">Kode Barang</label>
                    <input type="text" readonly class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang" placeholder="Masukkan kode barang" name="kode_barang" value="{{ $nomor }}">
                    @error('kode_barang')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" placeholder="Masukkan nama barang" name="nama_barang" value="{{ old('nama_barang') }}">
                    @error('nama_barang')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="id_jenis" class="form-label">Jenis Barang</label>
                    <select name="id_jenis" id="id_jenis" class="form-control @error('id_jenis') is-invalid @enderror">
                      <option></option>
                      @foreach ($jenisBarang as $jenisBarang)
                        <option value="{{ $jenisBarang->id_jenis }}">{{ $jenisBarang->nama_jenis }}</option>
                      @endforeach
                    </select>
                    @error('id_jenis')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="id_satuan" class="form-label">Satuan Barang</label>
                    <select name="id_satuan" id="id_satuan" class="form-control @error('id_satuan') is-invalid @enderror">
                      <option></option>
                      @foreach ($satuanBarang as $satuanBarang)
                        <option value="{{ $satuanBarang->id_satuan }}">{{ $satuanBarang->nama_satuan }}</option>
                      @endforeach
                    </select>
                    @error('id_satuan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </section>
            </div>
          </div>
        </div>
        
        <!-- /.content -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
  </div>
  
  @include('layouts/footer')

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

  <script type="text/javascript">

    $("#id_jenis").select2({
          placeholder: "Pilih Jenis",
          allowClear: true
    });

    $("#id_satuan").select2({
          placeholder: "Pilih Satuan",
          allowClear: true
    });
    </script>

</body>
</html>
  