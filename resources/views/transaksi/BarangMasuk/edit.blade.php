<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Ubah Data Barang Masuk')</title>
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
              <strong>Edit Barang Masuk</strong>
            </div>
            <div class="float-right">
              <button class="btn btn-secondary btn-sm" onclick="goBack()"><i class="fas fa-undo"> Back</i></button>
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

              @if (Session::get('failed'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('failed') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
              @endif
              <form class="p-3" method="POST" action="/BarangMasuk/{{ $barangMasuk->id_masuk }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                  <label for="id_stok" class="form-label">Nama Barang</label>
                  <select name="id_stok" id="id_stok" class="form-control @error('id_stok') is-invalid @enderror">
                    <option></option>
                      @foreach ($stokBarang as $item)
                        <option value="{{ $item->id_stok }}">{{ $item->databarang->nama_barang }}</option>
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
                  <input type="number" class="form-control @error('jml_barang') is-invalid @enderror" id="jml_barang" name="jml_barang" value="{{ $barangMasuk->jml_barang }}">
                  @error('jml_barang')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                  <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" id="tgl_masuk" name="tgl_masuk" value="{{ $barangMasuk->tgl_masuk }}">
                  @error('tgl_masuk')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="id_supplier" class="form-label">Nama Supplier</label>
                  <select name="id_supplier" id="id_supplier" class="form-control">
                    <option></option>
                      @foreach ($supplier as $key => $value)
                          <option value="{{ $key }}"
                              {{ $barangMasuk->id_supplier == $key ? 'selected' : '' }}>
                              {{ $value }}
                          </option>
                      @endforeach
                  </select>
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

  <script>
    function goBack() {
        window.history.back();
    }
  </script>

</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

  $("#id_stok").select2({
        placeholder: "Pilih Barang",
        allowClear: true
  });

  $("#id_supplier").select2({
        placeholder: "Pilih Supplier",
        allowClear: true
  });

  </script>

</body>
</html>