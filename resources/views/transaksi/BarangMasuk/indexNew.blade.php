<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Barang Masuk')</title>
    <link rel="stylesheet" href="/assets/dataTables/datatables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
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
                            <h1 class="m-0">Barang Masuk</h1>
                        </div>
                    </div><!-- /.row -->
                    <div class="card-header">
                        <div class="float-left">
                            <form method="post">
                                <a href="/BarangMasuk/{{ $id_gudang }}/create" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"> Tambah Data</i>
                                </a>&nbsp;
                            </form>
                        </div>
                        <div class="float-left">
                            <a href="{{ route('template_surat_terima') }}" class="btn btn-success btn-sm"><i
                                    class="fas fa-download"> Unduh Surat Penerimaan Barang</i></a>
                        </div>
                    </div>
                    <br>
                    <!-- Main content -->
                    <section class="content">
                        <table class="table data-table dt-head-center table-sm table-bordered table-hover table-striped"
                            id="datatables">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Nama Barang</th>
                                    {{-- <th scope="col">Jenis</th> --}}
                                    <th scope="col">Jumlah Masuk</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Nama Supplier</th>
                                    <th scope="col">Bukti Masuk</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangMasuk as $brgMasuk)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $brgMasuk->stokBarang->dataBarang->kode_barang }}</td>
                                        <td>{{ $brgMasuk->stokBarang->dataBarang->nama_barang }}</td>
                                        {{-- <td>{{ $brgMasuk->stokBarang->dataBarang->jenis->nama_jenis }}</td> --}}
                                        <td>{{ $brgMasuk->jml_barang }}</td>
                                        <td>{{ $brgMasuk->stokBarang->dataBarang->satuan->nama_satuan }}</td>
                                        <td>{{ $brgMasuk->tgl_masuk }}</td>
                                        <td>{{ $brgMasuk->supplier->nama_supplier }}</td>
                                        <td class="text-center">
                                            @if ($brgMasuk->surat_masuk == null)
                                                <span class="badge badge-danger">Belum Upload</span>
                                            @else
                                                <span class="badge badge-success">Sudah Upload</span>
                                            @endif
                                        </td>
                                        <td class="text-center">

                                            <div class="btn-group btn-sm">
                                                <a href="/BarangMasuk/{{ $brgMasuk->id_masuk }}/edit"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                                                <!-- Button Trigger Modal -->
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modalHapusBarangMasuk{{ $brgMasuk->id_masuk }}"><i
                                                        class="fas fa-trash"></i></button>
                                                <!-- Modal Body -->
                                                <div class="modal fade"
                                                    id="modalHapusBarangMasuk{{ $brgMasuk->id_masuk }}" tabindex="-1"
                                                    aria-labelledby="modalHapusPengguna" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h4 class="text-center">Yakin Hapus :
                                                                    <span>{{ $brgMasuk->stokBarang->databarang->nama_barang }}
                                                                        ? </span></h4>
                                                                </h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="/BarangMasuk/{{ $brgMasuk->id_masuk }}"
                                                                    method="post">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Ok</button>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end modal -->

                                                <!-- Button Trigger Modal -->
                                                <button class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#modalSuratMasuk{{ $brgMasuk->id_masuk }}"><i
                                                        class="fas fa-upload"></i></button>
                                                <!-- Modal Body -->
                                                <div class="modal fade" id="modalSuratMasuk{{ $brgMasuk->id_masuk }}"
                                                    tabindex="-1" aria-labelledby="modalHapusPengguna"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h4 class="text-center">Upload Surat Terima Barang</h4>

                                                                <div class="mb-3">
                                                                    <input type="file"
                                                                        class="form-control @error('surat_masuk') is-invalid @enderror"
                                                                        id="surat_masuk" name="surat_masuk"
                                                                        value="{{ old('surat_masuk') }}">
                                                                    @error('surat_masuk')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('uploadSuratTerima') }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end modal -->
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </section>
                    <!-- /.content -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
        </div>

        @include('layouts/footer')
        <script src="/assets/dataTables/datatables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatables').DataTable();
            });
        </script>

        <script>
            $(function() {

                @if (Session::has('success'))
                    Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ Session::get('success') }}'
                    })
                @endif

                @if (Session::has('error'))
                    Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ Session::get('error') }}'
                    })
                @endif
            });
        </script>
</body>

</html>
