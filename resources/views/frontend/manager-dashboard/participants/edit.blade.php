@extends('frontend.layouts.dashboard')

@section('title')
    Edit
    @parent
@stop

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/venobox.min.css') }}">
@stop


@section('content')
    <form name="form-daftar" method="post" enctype="multipart/form-data"
        action="{{ route('manager-team.participants.update', $participant->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xl-12 col-sm-12 wow fadeInUp">
                <div class="wsus__dash_earning">

                    <h6 class="mb-5"><strong>Edit </strong></h6>

                    <x-auth-session-status class="mb-4" :status="session('success')" />

                    <div class="row">
                        <div class="col-xl-4">
                            <div class="required mb-2">
                                <label for="nama_lengkap" class="form-label">Nama </label>
                                <input name="nama_lengkap" id="nama_lengkap" type="text" placeholder="Nama lengkap"
                                    class="form-control"
                                    value="{{ isset($participant) && !empty($participant->nama_lengkap) ? $participant->nama_lengkap : old('nama_lengkap') }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="required  mb-2">
                                <label for="gender" class="form-label">Gender </label>
                                <select class="form-select" name="gender" id="gender">
                                    <option selected value="">Pilih</option>
                                    <option value="Putra" @selected(isset($participant) && $participant->gender === 'Putra')>Putra</option>
                                    <option value="Putri" @selected(isset($participant) && $participant->gender === 'Putri')>Putri</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="required  mb-2">
                                <label for="gender" class="form-label">Tanggal Lahir </label>
                                <input type="date" class="form-control  datetimepicker-input" data-target="#tgl_lahir"
                                    name="tgl_lahir"
                                    value="{{ isset($participant->tgl_lahir) && !empty($participant->tgl_lahir) ? $participant->tgl_lahir : '' }}" />

                                <x-input-error :messages="$errors->get('tgl_lahir')" class="mt-2" />
                            </div>
                        </div>



                        <div class="col-xl-12">
                            <div class="required  mb-2">
                                <label for="email" class="form-label">Club </label>
                                <input class="form-control" name="club" id="club" type="text" placeholder="Club"
                                    value="{{ auth()->user()->club }}" readonly
                                    style="background-color: #dfe6e9; !important;">
                                <x-input-error :messages="$errors->get('club')" class="mt-2" />
                            </div>
                        </div>



                        <div class="col-xl-6">
                            <div class="required mb-2">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori" class="form-control select2" id="kategori" required>
                                    <option selected value="">Pilih</option>
                                    <option value="Pemula" @selected(isset($participant) && $participant->kategori === 'Pemula')>Pemula</option>
                                    <option value="Prestasi" @selected(isset($participant) && $participant->kategori === 'Prestasi')>Prestasi</option>
                                </select>
                                <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="required mb-2">
                                <label for="kategori_level" class="form-label">Kategori Level </label>
                                <select name="kategori_level" class="form-control select2" id="kategori_level" required>
                                    <option selected value="">Pilih</option>
                                    @if ($participant->kategori === 'Pemula')
                                        <option value="PRACADET_4-5" @selected(isset($participant) && $participant->kategori_level === 'PRACADET_4-5')>PRACADET 4-5</option>
                                        <option value="PRACADET_6-7" @selected(isset($participant) && $participant->kategori_level === 'PRACADET_6-7')>PRACADET 6-7</option>
                                        <option value="PRACADET_8-9" @selected(isset($participant) && $participant->kategori_level === 'PRACADET_8-9')>PRACADET 8-9</option>
                                        <option value="PRACADET_10-11" @selected(isset($participant) && $participant->kategori_level === 'PRACADET_10-11')>PRACADET 10-11</option>
                                    @else
                                        <option value="PRACADET" @selected(isset($participant) && $participant->kategori_level === 'PRACADET')>PRACADET</option>
                                    @endif

                                    <option value="CADET" @selected(isset($participant) && $participant->kategori_level === 'CADET')>CADET</option>
                                    <option value="JUNIOR" @selected(isset($participant) && $participant->kategori_level === 'JUNIOR')>JUNIOR</option>
                                    <option value="SENIOR" @selected(isset($participant) && $participant->kategori_level === 'SENIOR')>SENIOR</option>
                                </select>

                                <x-input-error :messages="$errors->get('kategori_level')" class="mt-2" />
                            </div>
                        </div>


                        <div class="col-xl-12">
                            <div class="required mb-2">
                                <label for="kategori_tanding" class="form-label">Kategori Pertandingan </label>
                                <select name="kategori_tanding" class="form-control select2" id="kategori_tanding">
                                    <option selected value="">Pilih</option>
                                    <option value="POOMSAE"
                                        {{ isset($participant) && $participant->kategori_tanding === 'POOMSAE' ? 'selected' : '' }}>
                                        POOMSAE</option>
                                    <option value="KYORUGI"
                                        {{ isset($participant) && $participant->kategori_tanding === 'KYORUGI' ? 'selected' : '' }}>
                                        KYORUGI</option>
                                </select>
                                <x-input-error :messages="$errors->get('kategori_tanding')" class="mt-2" />
                            </div>
                        </div>




                        <div id="sectionPoomSae" class="{{ $participant->kategori_tanding === 'KYORUGI' ? 'd-none' : '' }}">
                            <div class="col-xl-12">
                                <div class="wsus__login_form_input">
                                    <label>Pilih Kategori : </label>
                                    <select name="kelompok_poomsae" class="form-control select2" id="kelompok_poomsae">
                                        <option selected value="">Pilih</option>
                                        <option value="Individu-Putra"
                                            {{ isset($participant) && $participant->kelompok_poomsae === 'Individu-Putra' ? 'selected' : '' }}>
                                            Individu Putra</option>
                                        <option value="Individu-Putri"
                                            {{ isset($participant) && $participant->kelompok_poomsae === 'Individu-Putri' ? 'selected' : '' }}>
                                            Individu Putri</option>
                                        <option value="Pair"
                                            {{ isset($participant) && $participant->kelompok_poomsae === 'Pair' ? 'selected' : '' }}>
                                            Pair</option>
                                        <option value="Beregu"
                                            {{ isset($participant) && $participant->kelompok_poomsae === 'Beregu' ? 'selected' : '' }}>
                                            Beregu</option>
                                    </select>

                                    <x-input-error :messages="$errors->get('kelompok_poomsae')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-xl-12 div-sabuk-poomsae">
                                <div class="wsus__login_form_input">
                                    <label>Pilih Jenis Sabuk : </label>
                                    <select name="sabuk_poomsae" class="form-control select2" id="sabuk_poomsae">
                                        <option selected value="">Pilih</option>

                                        <option value="PUTIH"
                                            {{ isset($participant) && $participant->sabuk_poomsae === 'PUTIH' ? 'selected' : '' }}>
                                            PUTIH</option>

                                        <option value="KUNING"
                                            {{ isset($participant) && $participant->sabuk_poomsae === 'KUNING' ? 'selected' : '' }}>
                                            KUNING</option>

                                        <option value="KUNING-STRIP"
                                            {{ isset($participant) && $participant->sabuk_poomsae === 'KUNING-STRIP' ? 'selected' : '' }}>
                                            KUNING STRIP</option>

                                        <option value="HIJAU"
                                            {{ isset($participant) && $participant->sabuk_poomsae === 'HIJAU' ? 'selected' : '' }}>
                                            HIJAU</option>

                                        <option value="HIJAU-STRIP"
                                            {{ isset($participant) && $participant->sabuk_poomsae === 'HIJAU-STRIP' ? 'selected' : '' }}>
                                            HIJAU STRIP</option>

                                        <option value="BIRU"
                                            {{ isset($participant) && $participant->sabuk_poomsae === 'BIRU' ? 'selected' : '' }}>
                                            BIRU</option>

                                        <option value="BIRU-STRIP"
                                            {{ isset($participant) && $participant->sabuk_poomsae === 'BIRU-STRIP' ? 'selected' : '' }}>
                                            BIRU STRIP</option>

                                        <option value="MERAH"
                                            {{ isset($participant) && $participant->sabuk_poomsae === 'MERAH' ? 'selected' : '' }}>
                                            MERAH</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('sabuk_poomsae')" class="mt-2" />
                                </div>
                            </div>

                        </div>



                        <div id="sectionKyorugi"
                            class="{{ $participant->kategori_tanding === 'POOMSAE' ? ' d-none' : '' }}">


                            {{-- <div class="col-xl-12 div-kategori-usia {{ ($participant->kategori_level !== 'PRACADET' ? ' d-none' : '') }}">
                                    <div class="wsus__login_form_input">
                                        <label for="kategori_usia" class="form-label"> Pilih Usia </label>
                                        <select name="kategori_usia" class="form-select select2" id="kategori_usia">
                                            <option selected value="">Pilih</option>
                                            <option value="4-5th" {{ (isset($participant) && ($participant->kategori_usia === '4-5th')) ? 'selected' : '' }}>4-5th</option>
                                            <option value="6-7th" {{ (isset($participant) && ($participant->kategori_usia === '6-7th')) ? 'selected' : '' }}>6-7th</option>
                                            <option value="8-9th" {{ (isset($participant) && ($participant->kategori_usia === '8-9th')) ? 'selected' : '' }}>8-9th</option>
                                            <option value="10-11th" {{ (isset($participant) && ($participant->kategori_usia === '10-11th')) ? 'selected' : '' }}>10-11th</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('kategori_usia')" class="mt-2" />
                                    </div>
                                </div> --}}



                            <div class="col-xl-12">
                                <div class="wsus__login_form_input">
                                    <label for="berat_badan"> Berat Badan</label>
                                    <select name="berat_badan" class="form-control select2" id="berat_badan">
                                        <option value="{{ $participant->berat_badan }} KG" selected>
                                            {{ $participant->berat_badan }} KG</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('berat_badan')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-xl-12 div-tinggi-badan">
                                <div class="wsus__login_form_input">
                                    <label for="tinggi_badan"> Tinggi Badan (cm)</label>
                                    <input type="number" name="tinggi_badan" class="form-control" id="tinggi_badan"
                                        value="{{ $participant->tinggi_badan }}">

                                    <x-input-error :messages="$errors->get('tinggi_badan')" class="mt-2" />
                                </div>
                            </div>



                        </div>




                        <div class="col-xl-12">
                            <div class="wsus__login_form_input">
                                <label for="foto"> Upload Foto Peserta</label>
                                <input type="file" name="foto" id="foto" accept="image/*" />
                                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                                @if (count($documents) > 0)
                                    @foreach ($documents as $item)
                                        <a class="venobox" href="{{ url('/' . $item->path) }}"> <img
                                                src="{{ url('/' . $item->path) }}" class="mt-3"
                                                style="width: 150px !important; height: 100px !important;" /> </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>



                        <div class="col-lg-12">
                            <div class="wsus__login_form_input">
                                <button type="submit" class="btn btn-primary text-white rounded-md"><i
                                        class="fas fa-save"></i>
                                    Update
                                </button>
                            </div>


                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>
@stop

@section('footer_scripts')
    <!--venobox js-->
    <script src="{{ asset('frontend/assets/js/venobox.min.js') }}"></script>
    <script type="text/javascript">
        $('.venobox').venobox();
    </script>
@stop
