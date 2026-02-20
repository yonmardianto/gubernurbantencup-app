@extends('frontend.layouts.dashboard')

@section('title')
    Entry By Name
    @parent
@stop

@section('content')

    @if ($lock)
        <div class="row">
            <div class="col-xl-12 col-sm-12 wow fadeInUp">
                <div class="wsus__dash_earning">
                    <h6 class="mb-5 text-danger text-center"><strong>MAAF, Pendaftaran Sudah Ditutup</strong></h6>

                </div>

            </div>

        </div>
    @else
        <form name="form-daftar" method="post" enctype="multipart/form-data"
            action="{{ route('manager-team.participants.store') }}">
            @csrf
            <div class="row">
                <div class="col-xl-12 col-sm-12 wow fadeInUp">
                    <div class="wsus__dash_earning">

                        <h6 class="mb-5"><strong>Entry By Name</strong></h6>

                        <x-auth-session-status class="mb-4" :status="session('success')" />

                        <div class="row">
                            <div class="col-xl-4">
                                <div class="required mb-2">
                                    <label for="nama_lengkap" class="form-label">Nama </label>
                                    <input name="nama_lengkap" id="nama_lengkap" type="text" placeholder="Nama lengkap"
                                        class="form-control form-control-sm" value="{{ old('nama_lengkap') }}">
                                    <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="required  mb-2">
                                    <label for="gender" class="form-label">Gender </label>
                                    <select class="form-select form-select-sm" name="gender" id="gender">
                                        <option selected value="">Pilih</option>
                                        <option value="Putra">Putra</option>
                                        <option value="Putri">Putri</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="required  mb-2">
                                    <label for="gender" class="form-label">Tanggal Lahir </label>
                                    <input type="date" class="form-control form-control-sm  datetimepicker-input"
                                        data-target="#tgl_lahir" name="tgl_lahir" value="" />


                                    <x-input-error :messages="$errors->get('tgl_lahir')" class="mt-2" />
                                </div>
                            </div>



                            <div class="col-xl-12">
                                <div class="required  mb-2">
                                    <label for="email" class="form-label">Club </label>
                                    <input class="form-control form-control-sm" name="club" id="club" type="text"
                                        placeholder="Club" value="{{ auth()->user()->club }}" readonly
                                        style="background-color: #dfe6e9; !important;">
                                    <x-input-error :messages="$errors->get('club')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="required mb-2">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select name="kategori" class="form-select form-select-sm select2" id="kategori"
                                        required>
                                        <option selected value="">Pilih</option>
                                        <option value="Pemula">Pemula</option>
                                        <option value="Prestasi">Prestasi</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="required mb-2">
                                    <label for="kategori_level" class="form-label">Kategori Level </label>
                                    <select name="kategori_level" class="form-select form-select-sm select2"
                                        id="kategori_level" required>

                                    </select>

                                    <x-input-error :messages="$errors->get('kategori_level')" class="mt-2" />
                                </div>
                            </div>


                            <div class="col-xl-12">
                                <div class="required mb-2">
                                    <label for="kategori_tanding" class="form-label">Kategori Pertandingan </label>
                                    <select name="kategori_tanding" class="form-select form-select-sm select2"
                                        id="kategori_tanding">
                                    </select>
                                    <x-input-error :messages="$errors->get('kategori_tanding')" class="mt-2" />
                                </div>
                            </div>

                            <div id="sectionPoomSae" class="d-none">

                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Pilih Kategori : </label>
                                        <select name="kelompok_poomsae" class="form-select form-select-sm select2"
                                            id="kelompok_poomsae">
                                        </select>

                                        <x-input-error :messages="$errors->get('kelompok_poomsae')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12 div-sabuk-poomsae">
                                    <div class="wsus__login_form_input">
                                        <label>Pilih Jenis Sabuk : </label>
                                        <select name="sabuk_poomsae" class="form-select form-select-sm select2"
                                            id="sabuk_poomsae">
                                        </select>
                                        <x-input-error :messages="$errors->get('sabuk')" class="mt-2" />
                                    </div>
                                </div>

                            </div>

                            <div id="sectionKyorugi" class="d-none">

                                {{-- <div class="col-xl-12 div-kategori-usia">
                                <div class="wsus__login_form_input">
                                    <label for="kategori_usia" class="form-label"> Pilih Usia </label>
                                    <select name="kategori_usia" class="form-control select2" id="kategori_usia">
                                    </select>
                                    <x-input-error :messages="$errors->get('kategori_usia')" class="mt-2" />
                                </div>
                            </div> --}}

                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label for="berat_badan"> Berat Badan (Kg)</label>
                                        <select name="berat_badan" class="form-select form-select-sm select2"
                                            id="berat_badan">
                                        </select>
                                        <x-input-error :messages="$errors->get('berat_badan')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12 div-tinggi-badan">
                                    <div class="wsus__login_form_input">
                                        <label for="tinggi_badan"> Tinggi Badan (cm)</label>
                                        <input type="number" name="tinggi_badan" class="form-control form-control-sm"
                                            id="tinggi_badan" id="tinggi_badan">

                                        <x-input-error :messages="$errors->get('tinggi_badan')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12 div-sabuk-kyorugi">
                                    <div class="wsus__login_form_input">
                                        <label>Pilih Jenis Sabuk : </label>
                                        <select name="sabuk_kyorugi" class="form-select form-select-sm select2"
                                            id="sabuk_kyorugi">
                                        </select>
                                        <x-input-error :messages="$errors->get('sabuk_kyorugi')" class="mt-2" />
                                    </div>
                                </div>


                            </div>


                            <div class="col-xl-12">
                                <div class="wsus__login_form_input">
                                    <label for="foto"> Upload Foto Peserta </label>
                                    <input type="file" name="foto" id="foto" accept="image/*" />
                                    <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="wsus__login_form_input">
                                    <button type="submit" class="btn btn-primary text-white rounded-md"><i
                                            class="fas fa-save"></i>
                                        Submit
                                    </button>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    @endif
@stop
