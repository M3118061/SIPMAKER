<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @if (Request::get('status') == 1)
            @yield('title', 'Barang Expired')
        @else(Request::get('status') == 2)
            @yield('title', 'Barang Segera Expired')
        @endif
    </title>
    @include('layouts/header')
    <link rel="stylesheet" href="/assets/dataTables/datatables.min.css">
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
                            </div>
                        </div><!-- /.row -->
                        <!-- Main content -->
                        <div class="container-fluid">
                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatables"
                                                class="table data-table dt-head-center table-sm table-bordered table-hover table-striped">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>{{ __('Kode Barang') }}</th>
                                                        <th>{{ __('Nama Barang') }}</th>
                                                        <th>{{ __('Jenis') }}</th>
                                                        <th>{{ __('Jumlah Barang') }}</th>
                                                        <th>{{ __('Satuan') }}</th>
                                                        <th>{{ __('Tanggal Expired') }}</th>
                                                        <th>{{ __('Lokasi') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                        @foreach ($data as $p)
                                                            <tr>
                                                                <td>{{ $i++ }}</td>
                                                                <td>{{ $p->databarang->kode_barang }}</td>
                                                                <td>{{ $p->databarang->nama_barang }}</td>
                                                                <td>{{ $p->databarang->jenis->nama_jenis }}</td>
                                                                <td>{{ $p->jml_barang }}</td>
                                                                <td>{{ $p->databarang->satuan->nama_satuan }}</td>
                                                                <td>{{ $p->tgl_exp }}</td>
                                                                <td>{{ $p->datagudang->nama_gudang }}</td>
                                                            </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.content -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
            </div>

            @section('custom-js')
                <script src="/plugins/toastr/toastr.min.js"></script>
                <script src="/plugins/moment/moment.min.js"></script>
                <script src="/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
                <script src="/plugins/daterangepicker/daterangepicker.js"></script>
                <script src="/plugins/select2/js/select2.full.min.js"></script>
                <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
                <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                <script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
                <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
                <script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
                <script>
                    $('.select2').select2({
                        theme: 'bootstrap4'
                    });

                    bsCustomFileInput.init();

                    $('#tgl_exp').datetimepicker({
                        viewMode: 'years',
                        format: 'DD/MM/YYYY'
                    });

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var table = $('#table').DataTable({
                        processing: false,
                        serverSide: true,
                        ajax: {
                            "url": "{{ route('products') }}",
                            "data": {
                                "status": "{{ Request::get('status') }}"
                            }
                        },
                        'columnDefs': [{
                            "targets": [0, 4, 7],
                            "className": "text-center"
                        }],
                        initComplete: function() {
                            var api = this.api();
                            var role = "{{ Auth::user()->role }}";
                            if (role == 'Admin') {
                                api.column(1).visible(true);
                            } else {
                                api.column(1).visible(false);
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'id_barang',
                                name: 'id_barang'
                            },
                            {
                                data: 'jenis',
                                name: 'jenis'
                            },
                            {
                                data: 'jml_barang',
                                name: 'jml_barang'
                            },
                            {
                                data: 'satuan',
                                name: 'satuan'
                            },
                            {
                                data: 'tgl_exp',
                                name: 'tgl_exp'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: true
                            },
                        ]
                    });
                </script>
                @endsection

                @include('layouts/footer')

                <script src="/assets/dataTables/datatables.min.js"></script>
                <script type="text/javascript">
                    $(document).ready( function () {
                    $('#datatables').DataTable();
                    } );
                </script>