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
                            {{-- <h3 class="card-title">Settings</h3> --}}
                        </div>

                        <x-auth-session-status class="mb-4" :status="session('success')" />

                        <form method="post" action="{{ route('admin.settings.store') }}">
                              @csrf
                            <div class="card-body">

                                @foreach($settings as $setting)
                                    <div class="mb-3 row">
                                    <label class="row">
                                        <span class="col">{{ucfirst($setting->key)}}</span>
                                        <span class="col-auto">
                                        @if($setting->tipe === 'checkbox')
                                            <label class="form-check form-check-single form-switch">
                                                <input class="form-check-input" name="data[{{ $setting->key }}]" type="checkbox" value='1' @checked($setting->value === '1') />
                                            </label>
                                        @endif

                                        @if($setting->tipe === 'input')
                                            <label class="form-check form-check-single form-switch">
                                                <input type="text" name="data[{{ $setting->key }}]" class="form-control" value="{{ $setting->value }}" />
                                            </label>
                                        @endif


                                        </span>
                                    </label>

                                    </div>
                                 @endforeach
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
                                            </svg> Update
                                        </button>


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
