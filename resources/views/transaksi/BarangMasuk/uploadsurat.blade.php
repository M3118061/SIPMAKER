<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Ubah Data Barang Masuk')</title>
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
      <div class="card">
        <div class="card-outline">
          <div class="card-header">
            <div class="float-left">
              <strong>Edit Barang Masuk</strong>
            </div>
            <div class="float-right">
              <a href="/BarangMasuk" class="btn btn-secondary btn-sm"><i class="fas fa-undo"> Back</i></a>
            </div>
          </div>
        </div><!-- /.row -->
        <!-- Main content -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-4 offset-md-4">
              <section class="content">
              <form class="p-3" method="POST" action="/BarangMasuk/{{ $barangMasuk->id_masuk }}/suratupload" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="mb-3">
                  <label for="surat_masuk" class="form-label">Upload Surat</label>
                  <input type="file" class="form-control @error('surat_masuk') is-invalid @enderror" id="surat_masuk" name="surat_masuk" value="{{ $barangMasuk->surat_masuk }}">
                  @error('surat_masuk')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
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

  