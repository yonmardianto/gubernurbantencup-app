@extends('admin.layouts.master')

@section('title')
    Admin - Users
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
                        Daftar Users
                    </h2>
                </div>
            </div>
        </div>
    </div>


    <div class="page-body">

        <div class="container-xl mt-2">

            <x-auth-session-status class="mb-4" :status="session('success')" />
            <div class="row row-cards">

                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-status-top bg-info"></div>
                        <div class="card-body">
                            <div id="table-default" class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="tbl_users">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Hp</th>
                                            <th>Club/Team</th>
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

            function generateTableUsers() {
                $('#tbl_users').DataTable({
                    processing: true,
                    serverSide: true,
                    pageLength: 10,
                    order: [
                        [6, 'desc']
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
                                    return 'Daftar User ';
                                },
                            }

                    ],
                    ajax: {
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        url: "{{ route('admin.user.data') }}",
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
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'email',
                            name: 'email'
                        },

                        {
                            data: 'no_hp',
                            name: 'no_hp'
                        },

                        {
                            data: 'club',
                            name: 'club'
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
                                let url = "{{ route('admin.users.edit', [':id']) }}";
                                url = url.replace(':id', row.id);

                                let actions = '<div class="nav-item dropdown">';

                                actions += `<a class="nav-link dropdown-toggle font-bold" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">`;
                                actions += '</a>';

                                actions += '<div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);">';
                                actions +=  `<a href=${url} class="dropdown-item" href="#"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-key"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg> &nbsp; Change Password </a>`;

                                actions += '</div></div>';

                                return actions;
                            }
                        }


                    ]
                });


            }

            generateTableUsers();



        });
    </script>
@stop
