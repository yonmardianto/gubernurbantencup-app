@extends('admin.layouts.master')

@section('title')
    Admin - Admins
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
                        Daftar Admins
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Tambah Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="page-body">

        <div class="container-xl mt-2">

            <x-auth-session-status class="mb-4" :status="session('success')" />
            <x-auth-session-status class="mb-4" :status="session('error')" />

            <div class="row row-cards">

                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-status-top bg-info"></div>
                        <div class="card-body">
                            <div id="table-default" class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="tbl_admins">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Dibuat</th>
                                            <th style="width: 15%;">Actions</th>
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

            function generateTableAdmins() {
                $('#tbl_admins').DataTable({
                    processing: true,
                    serverSide: true,
                    pageLength: 10,
                    order: [
                        [3, 'desc']
                    ],
                    columnDefs: [{
                        className: 'dt-left',
                        targets: [0, 1, 2, 3]
                    }, ],
                    dom: 'Bflrtip',
                    buttons: [],
                    ajax: {
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        url: "{{ route('admin.admins.data') }}",
                        type: "POST",

                        data: function(data) {
                            data.search = $('input[type="search"]').val();
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'id',
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'email',
                            name: 'email'
                        },

                        {
                            data: 'created_at',
                            name: 'created_at',
                            searchable: false
                        },

                        {
                            data: 'actions',
                            name: 'actions',
                            searchable: false,
                            orderable: false,
                            'render': function(data, type, row) {
                                return data;
                            }
                        }

                    ]
                });
            }

            generateTableAdmins();

        });
    </script>

@stop
