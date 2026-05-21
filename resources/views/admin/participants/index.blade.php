@extends('admin.layouts.master')

@section('title')
    Admin - Peserta
    @parent
@stop

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/select2.min.css') }}">
@stop

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">

                    <h2 class="page-title">
                        Daftar Peserta
                    </h2>
                </div>

            </div>
        </div>
    </div>

    <div class="page-body">

        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12" id="box-search">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Pencarian Lanjut</h3>
                        </div>


                        <form method="post" action="{{ route('admin.participants.download') }}">
                            @csrf
                            <div class="card-body">
                                <div class="mb-2 row">
                                    <label class="col-3 col-form-label">Nama Lengkap / Nama Club Team</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="filter_nama_lengkap"
                                            id="filter_nama_lengkap" placeholder="Input nama peserta atau nama club">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label class="col-3 col-form-label">Gender</label>
                                    <div class="col">
                                        <select name="filter_gender" class="form-control select2" id="filter_gender"
                                            multiple="true">
                                            <option value="Putra">Putra</option>
                                            <option value="Putri">Putri</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label class="col-3 col-form-label">Kategori</label>
                                    <div class="col">
                                        <select name="filter_kategori" class="form-control select2" id="filter_kategori"
                                            multiple="true">
                                            <option value="Prestasi">Prestasi</option>
                                            <option value="Pemula">Pemula</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label class="col-3 col-form-label">Level</label>
                                    <div class="col">
                                        <select name="filter_level" class="form-control select2" id="filter_level"
                                            multiple="true">
                                            <option value="PRACADET_4-5">PRACADET 4-5</option>
                                            <option value="PRACADET_6-7">PRACADET 6-7</option>
                                            <option value="PRACADET_8-9">PRACADET 8-9</option>
                                            <option value="PRACADET_10-11">PRACADET 10-11</option>
                                            <option value="CADET">CADET</option>
                                            <option value="JUNIOR">JUNIOR</option>
                                            <option value="SENIOR">SENIOR</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label class="col-3 col-form-label">Kategori Tanding</label>
                                    <div class="col">
                                        <select name="filter_kategori_tanding" class="form-control select2"
                                            id="filter_kategori_tanding" multiple="true">
                                            <option value="POOMSAE">POOMSAE</option>
                                            <option value="KYORUGI">KYORUGI</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="mb-2 row">
                                    <label class="col-3 col-form-label">Kelas</label>
                                    <div class="col">
                                        <select name="filter_berat_badan" class="form-control" id="filter_berat_badan">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-center">
                                <button type="button" class="btn btn-primary" id="js-Cari">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M21 21l-6 -6" />
                                    </svg>
                                    Cari</button>

                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                        <path d="M7 11l5 5l5 -5" />
                                        <path d="M12 4l0 12" />
                                    </svg> Download Excel
                                </button>

                            </div>
                        </form>
                    </div>


                </div>


            </div>
        </div>

        <div class="container-xl mt-2">



            <div class="row row-cards">

                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-status-top bg-info"></div>
                        <div class="card-body">
                            <div id="table-default" class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="tbl_peserta">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Gender</th>
                                            <th>Kategori</th>
                                            <th>Level</th>
                                            <th>Kategori Tanding</th>
                                            <th>Keterangan</th>
                                            <th>Tinggi Badan (cm)</th>
                                            <th>Club/Team</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@stop

@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('frontend/assets/js/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $("#filter_gender, #filter_kategori, #filter_level, #filter_kategori_tanding").select2({
            width: '100%',
            placeholder: '-- Pilih --',
            allowClear: true
        });
        $(function() {

            $('#js-Cari').click(function(event) {
                event.preventDefault();
                var search_filter = {}
                search_filter['filter_nama_lengkap'] = $('#filter_nama_lengkap').val();
                search_filter['filter_gender'] = $('#filter_gender').val();
                search_filter['filter_kategori'] = $('#filter_kategori').val();
                search_filter['filter_level'] = $('#filter_level').val();
                search_filter['filter_kategori_tanding'] = $('#filter_kategori_tanding').val();
                search_filter['filter_berat_badan'] = $('#filter_berat_badan').val();

                $('#tbl_peserta').DataTable().destroy();
                generateTablePeserta(search_filter);


            });

            generateTablePeserta();

            function generateTablePeserta(search_filter = {}) {
                $('#tbl_peserta').DataTable({
                    processing: true,
                    serverSide: true,
                    pageLength: 10,
                    searching: false,
                    order: [
                        [10, 'desc']
                    ],
                    ajax: {
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        url: "{{ route('admin.participants.data') }}",
                        type: "POST",

                        data: function(data) {
                            // data.search = $('input[type="search"]').val(); //search default from datatables
                            data.customFilter = JSON.stringify(search_filter);

                        }
                    },
                    columns: [{
                            data: 'no',
                            name: 'no',
                            orderable: false,
                            searchable: false,
                            'render': function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'nama_lengkap',
                            name: 'nama_lengkap'
                        },
                        {
                            data: 'tgl_lahir',
                            name: 'tgl_lahir',
                            'render': function(data, type) {
                                if (data) {
                                    return type === 'sort' ? data : moment(data).format(
                                        'DD-MM-YYYY');
                                } else {
                                    return null;
                                }

                            }
                        },
                        {
                            data: 'gender',
                            name: 'gender',
                            orderable: false
                        },
                        {
                            data: 'kategori',
                            name: 'kategori',
                            orderable: false
                        },
                        {
                            data: 'kategori_level',
                            name: 'kategori_level',
                            orderable: false,
                            'render': function(data, type, row) {
                                return row.kategori_level.replace('_', ' ');
                            }
                        },

                        {
                            data: 'kategori_tanding',
                            name: 'kategori_tanding',
                            orderable: false
                        },

                        {
                            data: 'keterangan',
                            name: 'keterangan',
                            orderable: false,
                            'render': function(data, type, row) {
                                if (row['kategori_tanding'] === 'KYORUGI') {
                                    return row.berat_badan;
                                } else {
                                    return row.kelompok_poomsae;
                                }
                            }
                        },

                        {
                            data: 'tinggi_badan',
                            name: 'tinggi_badan',
                            orderable: false,
                            'render': function(data, type, row) {
                                if (row['kategori'] === 'Pemula') {
                                    return row.tinggi_badan;
                                } else {
                                    return '-';
                                }
                            }
                        },

                        {
                            data: 'club',
                            name: 'club',
                            orderable: false
                        },

                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false,
                            'render': function(data, type, row) {
                                let url = "{{ route('admin.participants.show', [':id']) }}";
                                let urlEdit = "{{ route('admin.participants.edit', [':id']) }}";
                                
                                urlEdit = urlEdit.replace(':id', row.id);
                                url = url.replace(':id', row.id);

                                let actions = '';

                                actions +=
                                    `<a href=${url}><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg></a>`;

                                actions +=
                                    `<a href=${urlEdit}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /></svg></a>`;


                                return actions;
                            }
                        }


                    ]
                });


            }

            // Fetch Berat Badan / Kelas dynamic filter
            $('#filter_gender, #filter_kategori, #filter_level, #filter_kategori_tanding').on('change', function() {
                var filter_gender = $('#filter_gender').val();
                var filter_kategori = $('#filter_kategori').val();
                var filter_level = $('#filter_level').val();
                var filter_kategori_tanding = $('#filter_kategori_tanding').val();

                if (filter_gender && filter_kategori && filter_level && filter_kategori_tanding) {
                    $.ajax({
                        url: "{{ route('admin.ajax.get_kelas_berat_badan') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            filter_gender: filter_gender.join(','),
                            filter_kategori: filter_kategori.join(','),
                            filter_level: filter_level.join(','),
                            filter_kategori_tanding: filter_kategori_tanding.join(',')
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#filter_berat_badan').empty();
                            $('#filter_berat_badan').append(
                                '<option value="">-- Pilih Kelas --</option>');
                            $.each(response, function(key, value) {
                                $('#filter_berat_badan').append('<option value="' +
                                    value.value + '">' + value.name + '</option>');
                            });
                            $('#filter_berat_badan').trigger('change');
                        }
                    });
                } else {
                    $('#filter_berat_badan').empty().trigger('change');
                }
            });


        });
    </script>
@stop
