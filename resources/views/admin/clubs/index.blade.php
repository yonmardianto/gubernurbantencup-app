@extends('admin.layouts.master')

@section('title')
    Admin - Club
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
                        Daftar Club/Team
                    </h2>
                </div>
            </div>
        </div>
    </div>


    <div class="page-body">

        <div class="container-xl mt-2">


            <div class="row row-cards">

                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-status-top bg-info"></div>
                        <div class="card-body">
                            <div id="table-default" class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="tbl_club">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Club Team</th>
                                            <th>Manager Team</th>
                                            <th>No Hp</th>
                                            <th>Jumlah Peserta</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
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
        $(function() {

            function generateTableClub() {
                $('#tbl_club').DataTable({
                    processing: true,
                    serverSide: true,
                    pageLength: 10,
                    order: [
                        [5, 'desc']
                    ],
                    columnDefs: [{
                        className: 'dt-left',
                        targets: [0, 1, 2, 3]
                    }, ],
                    dom: 'Bflrtip',
                    buttons: [{
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5],
                                    modifier: {
                                        page: 'all',
                                        selected: false
                                    },
                                },
                                text: 'Download',
                                filename: function() {
                                    return 'Daftar Club ';
                                },
                            }

                    ],
                    ajax: {
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        url: "{{ route('admin.clubs.data') }}",
                        type: "POST",

                        data: function(data) {
                            data.search = $('input[type="search"]')
                        .val(); //search default from datatables
                            // data.customFilter = JSON.stringify(search_filter);

                        }
                    },
                    columns: [{
                            data: 'no',
                            name: 'no',
                            searchable: false,
                            orderable: false,
                            'render': function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'club',
                            name: 'club'
                        },

                        {
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'no_hp',
                            name: 'no_hp'
                        },

                        {
                            data: 'jml_peserta',
                            name: 'jml_peserta',
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
                                let url = "{{ route('admin.user.payments', [':id']) }}";
                                let urlPeserta =  "{{ route('admin.user.participants', [':id']) }}";

                                url = url.replace(':id', row.id);
                                urlPeserta = urlPeserta.replace(':id', row.id);

                                let actions = '<div class="nav-item dropdown">';

                                actions += `<a class="nav-link dropdown-toggle font-bold" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">`;
                                actions += '</a>';


                                actions += '<div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);">';
                                actions +=  `<a href=${url} class="dropdown-item" href="#"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-checklist"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" /><path d="M14 19l2 2l4 -4" /><path d="M9 8h4" /><path d="M9 12h2" /></svg> &nbsp; Bukti Transfer </a>`;


                                actions +=  `<a href=${urlPeserta} class="dropdown-item" href="javascript:;"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-group"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg> &nbsp; Peserta </a>`;

                                actions += '</div></div>';

                                return actions;
                            }
                        }


                    ]
                });


            }

            generateTableClub();



        });
    </script>
@stop
