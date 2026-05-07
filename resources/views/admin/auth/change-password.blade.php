@extends('admin.layouts.master')

@section('title')
    Admin - Change Password
    @parent
@stop

@section('header_styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@stop

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-12 col-xl-6 ms-auto me-auto">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">
                                Change Password
                            </h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.password.update') }}">
                                @csrf
                                @method('put')

                                <div class="mb-3" x-data="{ showPassword: false }">
                                    <label class="form-label required">Current Password</label>
                                    <div class="input-group">
                                        <input type="password"
                                            class="form-control password-current @error('current_password', 'updatePassword') is-invalid @enderror"
                                            name="current_password" placeholder="Enter your current password" required>

                                        <span class="input-group-text toggle-password-current" style="cursor: pointer;">
                                            <a href="javascript:;" class="link-secondary" title="Show password"
                                                data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path
                                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                            </a>
                                        </span>
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </div>


                                <div class="mb-3" x-data="{ showPassword: false }">
                                    <label class="form-label required">New Password</label>
                                    <div class="input-group">
                                        <input type="password"
                                            class="form-control new-password @error('password', 'updatePassword') is-invalid @enderror"
                                            name="password" placeholder="Enter new password (min 8 characters)" required>
                                        <span class="input-group-text toggle-password-new" style="cursor: pointer;">
                                            <a href="javascript:;" class="link-secondary" title="Show password"
                                                data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path
                                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                            </a>
                                        </span>
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>

                                <div class="mb-3" x-data="{ showPassword: false }">
                                    <label class="form-label required">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password"
                                            class="form-control password-confirmation @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                            name="password_confirmation" placeholder="Confirm new password" required>

                                        <span class="input-group-text toggle-password-confirm" style="cursor: pointer;">
                                            <a href="javascript:;" class="link-secondary" title="Show password"
                                                data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path
                                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                            </a>
                                        </span>

                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                </div>

                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary ms-auto">Save Password</button>
                                </div>

                                @if (session('status') === 'password-updated')
                                    <div class="alert alert-success mt-3" x-data="{ show: true }" x-show="show"
                                        x-transition x-init="setTimeout(() => show = false, 4000)">
                                        Password updated successfully.
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('footer_scripts')
    <script type="text/javascript">
        document.querySelector('.toggle-password-current').addEventListener('click', function() {
            const passwordField = document.querySelector('.password-current');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });

        document.querySelector('.toggle-password-new').addEventListener('click', function() {
            const passwordField = document.querySelector('.new-password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });

        document.querySelector('.toggle-password-confirm').addEventListener('click', function() {
            const passwordField = document.querySelector('.password-confirmation');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
@stop
