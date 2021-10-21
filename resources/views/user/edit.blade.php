<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Ubah Data Pegawai')</title>
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
              <strong>Edit Data Pegawai</strong>
            </div>
            <div class="float-right">
              <a href="/user" class="btn btn-secondary btn-sm"><i class="fas fa-undo"> Back</i></a>
            </div>
          </div>
        </div><!-- /.row -->
        <!-- Main content -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-4 offset-md-4">
              <section class="content">
                <form class="p-3" method="POST" action="/user/{{ $user->id }}">
                  @method('patch')
                  @csrf
                  <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan nama" name="name" value="{{ $user->name }}">
                    @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="jk" class="form-labe">Jenis Kelamin</label><br>
                    <select class="form-control @error('jk') is-invalid @enderror" id="jk" name="jk" value="{{ $user->jk }}">
                      <option value="">Pilih Jenis Kelamin</option>
                      <option value="Laki-laki"
                          {{ $user->jk == 'Laki-laki' ? 'selected' : '' }}> Laki-laki
                      </option>
                      <option value="Perempuan" {{ $user->jk == 'Perempuan' ? 'selected' : '' }}>
                          Perempuan
                      </option>
                      @error('jk')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan alamat" name="alamat" value="{{ $user->alamat }}">
                    @error('alamat')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="no_telp" class="form-label">No Telp</label>
                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" placeholder="Masukkan no telp" name="no_telp" value="{{ $user->no_telp }}">
                    @error('no_telp')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email" name="email" value="{{ $user->email }}">
                    @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="role" class="form-labe">Role</label><br>
                    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" value="{{ $user->role }}">
                      <option value="">Pilih Role</option>
                      <option value="Admin"
                          {{ $user->role == 'Admin' ? 'selected' : '' }}> Admin
                      </option>
                      <option value="Pegawai" {{ $user->role == 'Pegawai' ? 'selected' : '' }}>
                          Pegawai
                      </option>
                      @error('role')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
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

  