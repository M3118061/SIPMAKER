<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Ubah Password')</title>
  @include('layouts/header')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
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
            <h1 class="m-0">Ubah Password</h1>
          </div>
        </div><!-- /.row -->

        <!-- Main content -->
        <section class="content">

          {{-- <!-- Session -->
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
          @endif --}}

          <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Password</h3>
            </div>
              <div class="card-body">
                  <form role="form" id="update_password" action="{{ route('update-password') }}" method="post">
                      @csrf
                      <div class="form-group row">
                          <label for="old_password" class="col-sm-4 col-form-label">{{ __('Password Lama') }}</label>
                          <div class="col-sm-8">
                              <input type="password" class="form-control" id="old_password" name="old_password">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="password" class="col-sm-4 col-form-label">{{ __('Password Baru') }}</label>
                          <div class="col-sm-8">
                              <input type="password" class="form-control" id="password" name="password">
                          </div>
                          @error('password')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                      </div>
                      <div class="form-group row">
                          <label for="password" class="col-sm-4 col-form-label">{{ __('Confirm Password') }}</label>
                          <div class="col-sm-8">
                              <input type="password" class="form-control" id="password" name="password_confirmation">
                          </div>
                      </div>
                  </form>
              </div>
              <div class="card-footer">
                  <button id="button-update" type="button" class="btn btn-primary float-right" onclick="$('#update_password').submit();">{{ __('Change Password') }}</button>
              </div>
          </div>
        </section>
        
        <!-- /.content -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
  
  @include('layouts/footer')

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
</body>
</html>