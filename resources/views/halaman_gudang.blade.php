<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('SELAMAT DATANG') }}</div>

                    <div class="card-body">
                        <h6>Anda login sebagai 
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <a class="nav-link" href="{{ route('login') }}"></a>
                                @endif
                                @else
                                {{ Auth::user()->role }}
                            @endguest
                            , silahkan pilih gudang untuk masuk ke halaman dashboard.
                        </h6>
                        <div class="dropdown col-md-4 offset-md-4">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                Pilih Gudang
                            </button>
                            <ul class="dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <li>
                                    @foreach ($dataGudang as $gudang)
                                        <a class="dropdown-item" href="/home/{{ $gudang->id_gudang }}">{{ $gudang->nama_gudang }}</a>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>


