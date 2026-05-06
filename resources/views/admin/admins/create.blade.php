@extends('admin.layouts.master')

@section('title')
    Admin - Tambah Admin
    @parent
@stop


@section('header_styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/datatables.min.css') }}" />
@stop


@section('content')


    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">


                <div class="col-md-12 col-xl-8 ms-auto me-auto">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">
                                Tambah Admin Baru
                            </h3>


                        </div>
                        <div class="card-body">
                            <form name="form-admin" method="post" action="{{ route('admin.admins.store') }}">
                                @csrf
                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <label class="form-label required">Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Masukkan nama admin" name="name" value="{{ old('name') }}"
                                            required>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label required">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Masukkan email admin" name="email" value="{{ old('email') }}"
                                            required>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label required">Role</label>
                                        <select class="form-select @error('role') is-invalid @enderror" name="role"
                                            required>
                                            <option value="">-- Pilih Role --</option>
                                            <option value="administrator"
                                                {{ old('role') === 'administrator' ? 'selected' : '' }}>Administrator
                                            </option>
                                            <option value="admin-user" {{ old('role') === 'admin-user' ? 'selected' : '' }}>
                                                Admin User</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                    </div>

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
                                <small class="form-hint">Password minimal 8 karakter</small>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                    </div>

                    <div class="form-footer">
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-link">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    <script type="text/javascript">
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordField = document.querySelector('.password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
@stop
