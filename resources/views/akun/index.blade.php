<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Ubah Profil')</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
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
            <h1 class="m-0">Ubah Profil</h1>
          </div>
          </div><!-- /.row -->
            <!-- Main content -->
            <div class="container-fluid">
                <div class="card-deck">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Profile</h3>
                        </div>
                        <div class="card-body">
                            <form role="form" id="update" action="{{ route('setting.akun.update') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">{{ __('Email') }}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="email" value="{{ Auth::user()->email }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exp_reminder" class="col-sm-4 col-form-label">{{ __('Pengingat Expired') }}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="exp_reminder" name="exp_reminder" min="1" value="{{ Auth::user()->exp_reminder }}"/>
                                            <div class="input-group-append">
                                                <div class="input-group-text">hari sebelum expired.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button id="button-update" type="button" class="btn btn-primary float-right" onclick="$('#update').submit();">{{ __('Update Profile') }}</button>
                        </div>
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

  