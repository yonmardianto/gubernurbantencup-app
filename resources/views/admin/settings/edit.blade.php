@extends('admin.layouts.master')

@section('title')
    Admin - Settings
    @parent
@stop


@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        System Settings
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
                            <h3 class="card-title">Settings</h3>
                        </div>

                        <form method="post" action="{{ route('admin.settings.update', $setting) }}">
                              @csrf
                              @method('PUT')
                            <div class="card-body">
                                <div class="mb-2 row">
                                    <label class="col-3 col-form-label">Lock Application</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="filter_nama_lengkap"
                                            id="filter_nama_lengkap" placeholder="Input nama peserta atau nama club">
                                    </div>
                                </div>




                            </div>
                            <div class="card-footer text-center">

                                <div class="col-12 mt-3">
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg> Edit
                                        </button>

                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary rounded"
                                            role="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                                            </svg>
                                            Cancel </a>

                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>


                </div>


            </div>
        </div>

    </div>

@endsection
