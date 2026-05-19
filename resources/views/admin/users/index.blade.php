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

                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs" id="userTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="activeUsersTab" data-bs-toggle="tab"
                                    data-bs-target="#activeUsersContent" type="button" role="tab"
                                    aria-controls="activeUsersContent" aria-selected="true">
                                    Active Users
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="deletedUsersTab" data-bs-toggle="tab"
                                    data-bs-target="#deletedUsersContent" type="button" role="tab"
                                    aria-controls="deletedUsersContent" aria-selected="false">
                                    Archived Users
                                </button>
                            </li>
                        </ul>

                        <div class="card-body">
                            <!-- Tab Content -->
                            <div class="tab-content" id="userTabsContent">
                                <!-- Active Users Tab -->
                                <div class="tab-pane fade show active" id="activeUsersContent" role="tabpanel"
                                    aria-labelledby="activeUsersTab">
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

                                <!-- Deleted Users Tab -->
                                <div class="tab-pane fade" id="deletedUsersContent" role="tabpanel"
                                    aria-labelledby="deletedUsersTab">
                                    <div id="table-deleted" class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover"
                                            id="tbl_deleted_users">
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

        </div>

    </div>

    <!-- User Action  Modal -->
    <div class="modal modal-blur fade" id="userActionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status" id="modalStatus"></div>
                <div class="modal-body text-center py-4">
                    <svg id="modalIcon" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                        <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M17 21l4 -4" />
                    </svg>
                    <h3 id="modalTitle"></h3>
                    <div class="text-muted" id="modalDescription"></div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</a>
                    <button type="button" class="btn" id="confirmActionBtn"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete User Modal -->
    <div class="modal modal-blur fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon mb-2 text-danger">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 7l16 0" />
                        <path d="M10 11l0 6" />
                        <path d="M14 11l0 6" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v1" />
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-muted">You are about to archieve <strong id="deleteUserName"></strong>. </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        Archieve
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Restore/Force Delete User Modal -->
    <div class="modal modal-blur fade" id="restoreDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status" id="modalStatus"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon mb-2" id="modalIcon">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    </svg>
                    <h3 id="modalTitle">Confirm Action</h3>
                    <div class="text-muted">You are about to <strong id="modalAction"></strong> <strong
                            id="restoreUserName"></strong>.</div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="button" class="btn" id="confirmRestoreDeleteBtn">
                        Confirm
                    </button>
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

            let activeUsersTable = null;
            let deletedUsersTable = null;

            // Initialize Active Users Table
            function generateTableUsers() {
                activeUsersTable = $('#tbl_users').DataTable({
                    processing: true,
                    serverSide: true,
                    pageLength: 20,
                    order: [
                        [6, 'desc']
                    ],
                    columnDefs: [{
                        className: 'dt-left',
                        targets: [0, 1, 2, 3]
                    }],
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
                    }],
                    ajax: {
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        url: "{{ route('admin.user.data') }}",
                        type: "POST",
                        data: function(data) {
                            data.search = $('input[type="search"]').val();
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
                                actions +=
                                    `<a class="nav-link dropdown-toggle font-bold" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">`;
                                actions += '</a>';
                                actions +=
                                    '<div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);">';
                                actions +=
                                    `<a href=${url} class="dropdown-item" href="#"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-key"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg> &nbsp; Change Password </a>`;
                                actions +=
                                    `<button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-user-id="${row.id}" data-user-name="${row.name}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v1" /></svg> &nbsp; Archieve </button>`;

                                if (row.manual_unlock == "1") {
                                    actions +=
                                        `<button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#userActionModal" data-user-id="${row.id}" data-user-name="${row.name}" data-user-club="${row.club}" data-action="lock"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-cancel"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4" /><path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M17 21l4 -4" /></svg> &nbsp; Lock </button>`;

                                } else {
                                    actions +=
                                        `<button type="button" class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#userActionModal" data-user-id="${row.id}" data-user-name="${row.name}" data-user-club="${row.club}" data-action="unlock"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-check"><path stroke="none" d="M0 0h24v24H0z"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4" /><path d="M15 19l2 2l4 -4" /></svg> &nbsp; Unlock </button>`;

                                }

                                actions += '</div></div>';
                                return actions;
                            }
                        }
                    ]
                });
            }

            // Initialize Deleted Users Table
            function generateTableDeletedUsers() {
                deletedUsersTable = $('#tbl_deleted_users').DataTable({
                    processing: true,
                    serverSide: true,
                    pageLength: 20,
                    order: [
                        [6, 'desc']
                    ],
                    columnDefs: [{
                        className: 'dt-left',
                        targets: [0, 1, 2, 3]
                    }],
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
                            return 'Daftar User Terhapus ';
                        },
                    }],
                    ajax: {
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        url: "{{ route('admin.user.deleted.data') }}",
                        type: "POST",
                        data: function(data) {
                            data.search = $('input[type="search"]').val();
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
                                let actions = '<div class="nav-item dropdown">';
                                actions +=
                                    `<a class="nav-link dropdown-toggle font-bold" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">`;
                                actions += '</a>';
                                actions +=
                                    '<div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);">';

                                actions +=
                                    `<button type="button" class="dropdown-item text-success restore-user-btn" data-user-id="${row.id}" data-user-name="${row.name}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg> &nbsp; Restore </button>`;

                                // actions +=
                                //     `<button type="button" class="dropdown-item text-danger force-delete-user-btn" data-user-id="${row.id}" data-user-name="${row.name}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v1" /></svg> &nbsp; Delete Permanently </button>`;

                                actions += '</div></div>';
                                return actions;
                            }
                        }
                    ]
                });
            }

            // Initialize both tables
            generateTableUsers();
            generateTableDeletedUsers();

            // Tab switching - reload appropriate table
            $('#activeUsersTab').on('shown.bs.tab', function() {
                if (activeUsersTable) {
                    activeUsersTable.ajax.reload();
                }
            });

            $('#deletedUsersTab').on('shown.bs.tab', function() {
                if (deletedUsersTable) {
                    deletedUsersTable.ajax.reload();
                }
            });

            // Handle delete user modal (Active Users)
            let userToDeleteId = null;
            let userToDeleteName = null;

            $('#deleteUserModal').on('show.bs.modal', function(e) {
                const button = $(e.relatedTarget);
                userToDeleteId = button.data('user-id');
                userToDeleteName = button.data('user-name');
                $('#deleteUserName').text(userToDeleteName);
            });


            let targetUserId = null;
            let targetAction = null; // 'lock' or 'unlock'

            $('#userActionModal').on('show.bs.modal', function(e) {
                const button = $(e.relatedTarget);
                targetUserId = button.data('user-id');
                targetAction = button.data('action'); // 'lock' or 'unlock'

                const isLock = targetAction === 'lock';

                // Update modal content dynamically
                $('#modalTitle').text(isLock ? 'Lock User?' : 'Unlock User?');
                $('#modalIcon').attr('class', `icon mb-2 ${isLock ? 'text-danger' : 'text-success'}`);
                $('#modalStatus').attr('class', `modal-status ${isLock ? 'bg-danger' : 'bg-success'}`);
                $('#modalDescription').html(
                    `You are about to ${isLock ? 'lock' : 'unlock'} <strong>${button.data('user-name')}</strong>. <br />Club <strong>${button.data('user-club')}</strong>`
                );
                $('#confirmActionBtn')
                    .text(isLock ? 'Lock' : 'Unlock')
                    .attr('class', `btn ${isLock ? 'btn-danger' : 'btn-success'}`);
            });


            $('#confirmActionBtn').on('click', function() {
                if (!targetUserId || !targetAction) return;

                const url = targetAction === 'lock' ?
                    "{{ route('admin.user.lock', [':id']) }}".replace(':id', targetUserId) :
                    "{{ route('admin.user.unlock', [':id']) }}".replace(':id', targetUserId);

                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Content-Type': 'application/json'
                    },
                    success: function(response) {
                        if (response.success) {
                            bootstrap.Modal.getInstance(document.getElementById(
                                'userActionModal')).hide();
                            showAlert('Success', response.message, 'success');
                            setTimeout(() => $('#tbl_users').DataTable().ajax.reload(), 1000);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON || {};
                        showAlert('Error', response.message || `Failed to ${targetAction} user`,
                            'error');
                    }
                });
            });



            $('#confirmUnlockBtn').on('click', function() {
                if (!userToUnlockId) return;

                const url = "{{ route('admin.user.unlock', [':id']) }}".replace(':id', userToUnlockId);
                const token = "{{ csrf_token() }}";

                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    },
                    success: function(response) {
                        if (response.success) {
                            bootstrap.Modal.getInstance(document.getElementById(
                                'unlockUserModal')).hide();
                            showAlert('Success', response.message, 'success');
                            setTimeout(() => {
                                $('#tbl_users').DataTable().ajax.reload();
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON || {};
                        showAlert('Error', response.message || 'Failed to unlock user',
                            'error');
                    }
                });
            });

            $('#confirmDeleteBtn').on('click', function() {
                if (!userToDeleteId) return;

                const url = "{{ route('admin.users.destroy', [':id']) }}".replace(':id', userToDeleteId);
                const token = "{{ csrf_token() }}";

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    },
                    success: function(response) {
                        if (response.success) {
                            bootstrap.Modal.getInstance(document.getElementById(
                                'deleteUserModal')).hide();
                            showAlert('Success', response.message, 'success');
                            setTimeout(() => {
                                $('#tbl_users').DataTable().ajax.reload();
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON || {};
                        showAlert('Error', response.message || 'Failed to archieve user',
                            'error');
                    }
                });
            });

            // Handle restore user button
            $(document).on('click', '.restore-user-btn', function() {
                const userId = $(this).data('user-id');
                const userName = $(this).data('user-name');

                showRestoreDeleteModal('restore', userId, userName);
            });

            // Handle force delete user button
            $(document).on('click', '.force-delete-user-btn', function() {
                const userId = $(this).data('user-id');
                const userName = $(this).data('user-name');

                showRestoreDeleteModal('delete', userId, userName);
            });

            // Show restore/delete modal with appropriate content
            let restoreDeleteAction = null;
            let restoreDeleteUserId = null;

            function showRestoreDeleteModal(action, userId, userName) {
                restoreDeleteAction = action;
                restoreDeleteUserId = userId;

                const modal = new bootstrap.Modal(document.getElementById('restoreDeleteModal'));

                if (action === 'restore') {
                    $('#modalStatus').removeClass('bg-danger').addClass('bg-success');
                    $('#modalTitle').text('Restore User?');
                    $('#modalAction').text('restore');
                    $('#confirmRestoreDeleteBtn').removeClass('btn-danger').addClass('btn-success').text('Restore');
                    $('#modalIcon').removeClass('text-danger').addClass('text-success');
                } else {
                    $('#modalStatus').removeClass('bg-success').addClass('bg-danger');
                    $('#modalTitle').text('Permanently Delete User?');
                    $('#modalAction').text('permanently delete');
                    $('#confirmRestoreDeleteBtn').removeClass('btn-success').addClass('btn-danger').text('Delete');
                    $('#modalIcon').removeClass('text-success').addClass('text-danger');
                }

                $('#restoreUserName').text(userName);
                modal.show();
            }

            // Handle restore/force delete confirmation
            $('#confirmRestoreDeleteBtn').on('click', function() {
                if (!restoreDeleteUserId) return;

                let url, method;

                if (restoreDeleteAction === 'restore') {
                    url = "{{ route('admin.user.restore', [':id']) }}".replace(':id', restoreDeleteUserId);
                    method = 'POST';
                } else {
                    url = "{{ route('admin.user.force-delete', [':id']) }}".replace(':id',
                        restoreDeleteUserId);
                    method = 'DELETE';
                }

                const token = "{{ csrf_token() }}";

                $.ajax({
                    url: url,
                    type: method,
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    },
                    success: function(response) {
                        if (response.success) {
                            bootstrap.Modal.getInstance(document.getElementById(
                                'restoreDeleteModal')).hide();
                            showAlert('Success', response.message, 'success');

                            setTimeout(() => {
                                if (activeUsersTable) activeUsersTable.ajax.reload();
                                if (deletedUsersTable) deletedUsersTable.ajax.reload();
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON || {};
                        showAlert('Error', response.message || 'Operation failed', 'error');
                    }
                });
            });

            // Helper function to show alerts
            function showAlert(title, message, type) {
                const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
                const alertHtml = `
                    <div class="alert ${alertClass} alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                                <strong>${title}:</strong> ${message}
                            </div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                `;

                $('.page-body').prepend(alertHtml);

                setTimeout(() => {
                    $('.alert').fadeOut('slow', function() {
                        $(this).remove();
                    });
                }, 5000);
            }

        });
    </script>
@stop
