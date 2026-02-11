@extends('admin.layouts.master')

@section('title')
Admin - Change Password
@parent
@stop


@section('header_styles')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/datatables.min.css') }}" />
{{-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/venobox.min.css') }}"> --}}
@stop


@section('content')


<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">


            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">
                           Change Password
                        </h3>


                    </div>
                    <div class="card-body">
                        <form name="form-user" method="post" action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-4 mb-3">
                                <label class="form-label">Nama</label>
                                <div>
                                    <input type="text" class="form-control-plaintext" value="{{ $user->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="form-label">Email</label>
                                <div>
                                    <input type="email" class="form-control-plaintext" value="{{ $user->email }}" readonly>
                                </div>
                            </div>

                            <div class="col-4 mb-3">
                                <label class="form-label">No Hp</label>
                                <div>
                                    <input type="text" class="form-control-plaintext" value="{{ $user->no_hp }}" readonly>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Club</label>
                                <div>
                                    <input type="text" class="form-control-plaintext" value="{{ $user->club }}" readonly>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <label class="form-label required">Password</label>
                                <div class="input-group input-group-flat">
                                    <input type="password" class="form-control password" placeholder="Password" name="password">

                                    <span class="input-group-text toggle-password">
                                        <a href="javascript:;" class="link-secondary" title="Show password"
                                            data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </a>
                                    </span>

                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>


                            <div class="col-6 mb-3">
                                <label class="form-label required">Confirm Password</label>
                                <div class="input-group input-group-flat">
                                    <input type="password" class="form-control confirm-password" placeholder="Confirm Password" name="confirm_password">

                                    <span class="input-group-text toggle-confirm-password">
                                        <a href="javascript:;" class="link-secondary" title="Show password"
                                            data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </a>
                                    </span>

                                </div>
                                <x-input-error :messages="$errors->get('confirm_password')" class="mt-2" />
                            </div>


                            <div class="col-12 mt-3">
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary rounded">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>  Edit
                                    </button>

                                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary rounded" role="button">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
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

</div>

@stop

@section('footer_scripts')
<script type="text/javascript" src="{{ asset('frontend/assets/js/datatables/datatables.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('frontend/assets/js/venobox.min.js') }}"></script> --}}
<script type="text/javascript">
    $('.toggle-password').on('click', function () {
    if ($('.password').attr('type') == 'password') {
        $('.password').attr('type', 'text');
    } else {
        $('.password').attr('type', 'password');
    }
   });


   $('.toggle-confirm-password').on('click', function () {
    if ($('.confirm-password').attr('type') == 'password') {
        $('.confirm-password').attr('type', 'text');
    } else {
        $('.confirm-password').attr('type', 'password');
    }
});
</script>


@stop
