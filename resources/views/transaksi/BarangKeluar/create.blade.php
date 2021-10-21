<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Tambah Data Barang Keluar')</title>
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
              <strong>Tambah Data Barang Keluar</strong>
            </div>
            <div class="float-right">
              <a href="/BarangKeluar/{{ $id_gudang }}" class="btn btn-secondary btn-sm"><i class="fas fa-undo"> Back</i></a>
            </div>
          </div>
        </div><!-- /.row -->
        <!-- Main content -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-4 offset-md-4">
              <section class="content">
              <!-- Session -->
              @if (Session::get('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
              @endif

              @if (Session::get('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
              @endif
              <form class="p-3" method="POST" action="/BarangKeluar">
                @csrf
                <div class="mb-3">
                  <label for="id_stok" class="form-label">ID Stok</label>
                  <select name="id_stok" id="id_stok" class="form-control @error('id_stok') is-invalid @enderror">
                    <option></option>
                    @foreach ($stokBarang as $item)
                      @if ($item->tgl_exp >= now())
                        <option value="{{ $item->id_stok }}">{{ $item->dataBarang->nama_barang }}</option>
                      @endif
                    @endforeach
                  </select>
                  @error('id_stok')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="jml_barang" class="form-label">Jumlah Barang</label>
                  <input type="number" class="form-control @error('jml_barang') is-invalid @enderror" id="jml_barang" placeholder="Masukkan jumlah barang" name="jml_barang" value="{{ old('jml_barang') }}">
                  @error('jml_barang')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="tgl_keluar" class="form-label">Tanggal Keluar</label>
                  <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" id="tgl_keluar" name="tgl_keluar" value="{{ old('tgl_keluar') }}">
                  @error('tgl_keluar')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                {{-- INI INPUT HIDDEN ID GUDANG --}}
                <input type="hidden" name="id_gudang" value="{{ $id_gudang }}">
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

    $("#id_stok").select2({
          placeholder: "Pilih Barang",
          allowClear: true
    });

    </script>

</body>
</html>