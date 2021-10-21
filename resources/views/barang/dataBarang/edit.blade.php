<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Ubah Data Barang')</title>
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
              <strong>Edit Data Barang</strong>
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
              <form class="p-3" method="POST" action="/dataBarang/{{ $dataBarang->id_barang }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                  <label for="kode_barang" class="form-label">Kode Barang</label>
                  <input type="text" readonly class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang" placeholder="Masukkan kode barang" name="kode_barang" value="{{ $dataBarang->kode_barang }}">
                  @error('kode_barang')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="nama_barang" class="form-label">Nama Barang</label>
                  <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" placeholder="Masukkan nama barang" name="nama_barang" value="{{ $dataBarang->nama_barang }}">
                  @error('nama_barang')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="id_jenis" class="form-label">Jenis Barang</label>
                  <select name="id_jenis" id="id_jenis" class="form-control">
                    <option value="">--Pilih--</option>
                      @foreach ($jenisBarang as $key => $value)
                          <option value="{{ $key }}"
                              {{ $dataBarang->id_barang == $key ? 'selected' : '' }}>
                              {{ $value }}
                          </option>
                      @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="id_satuan" class="form-label">Satuan Barang</label>
                  <select name="id_satuan" id="id_satuan" class="form-control">
                    <option value="">--Pilih--</option>
                    @foreach ($satuanBarang as $key => $value)
                    <option value="{{ $key }}"
                        {{ $dataBarang->id_barang == $key ? 'selected' : '' }}>
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

  