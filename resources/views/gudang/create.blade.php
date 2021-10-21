<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Tambah Data Gudang')</title>
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
              <strong>Tambah Data Gudang</strong>
            </div>
            <div class="float-right">
              <a href="/dataGudang" class="btn btn-secondary btn-sm"><i class="fas fa-undo"> Back</i></a>
            </div>          
          </div>
        </div><!-- /.row -->
        <!-- Main content -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-4 offset-md-4">
              <section class="content">
              <form class="p-3" method="POST" action="/gudang">
                @csrf
                <div class="mb-3">
                  <label for="nama_gudang" class="form-label">Nama Gudang</label>
                  <input type="text" class="form-control @error('nama_gudang') is-invalid @enderror" id="nama_gudang" placeholder="Masukkan nama gudang" name="nama_gudang" value="{{ old('nama_gudang') }}">
                  @error('nama_gudang')
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

  