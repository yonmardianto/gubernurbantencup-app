@extends('admin.layouts.master')

@section('title')
    Admin - Edit Peserta
    @parent
@stop


@section('header_styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/select2.min.css') }}">
@stop


@section('content')

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">
                                Edit Peserta
                            </h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.participants.index') }}" class="btn btn-light btn-sm rounded">
                                    <span>&#8592; Back</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <x-auth-session-status class="mb-4" :status="session('success')" />
                            <form name="form-edit-peserta" method="post"
                                action="{{ route('admin.participants.update', $participant->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Nama</label>
                                        <div>
                                            <input type="text" class="form-control" name="nama_lengkap"
                                                value="{{ old('nama_lengkap', $participant->nama_lengkap) }}">
                                            <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <div>
                                            <input type="date" class="form-control" name="tgl_lahir"
                                                value="{{ old('tgl_lahir', $participant->tgl_lahir) }}">
                                            <x-input-error :messages="$errors->get('tgl_lahir')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Gender</label>
                                        <div>
                                            <select class="form-select" name="gender" id="gender">
                                                <option value="">Pilih Gender</option>
                                                <option value="Putra"
                                                    {{ old('gender', $participant->gender) == 'Putra' ? 'selected' : '' }}>
                                                    Putra
                                                </option>
                                                <option value="Putri"
                                                    {{ old('gender', $participant->gender) == 'Putri' ? 'selected' : '' }}>
                                                    Putri
                                                </option>
                                            </select>
                                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-6 mb-3">
                                        <label class="form-label">Club</label>
                                        <div>
                                            <input type="text" class="form-control" name="club"
                                                value="{{ old('club', $participant->club) }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Kategori</label>
                                        <div>
                                            <select class="form-select" name="kategori" id="kategori">
                                                <option value="">Pilih Kategori</option>
                                                <option value="Pemula"
                                                    {{ old('kategori', $participant->kategori) == 'Pemula' ? 'selected' : '' }}>
                                                    Pemula
                                                </option>
                                                <option value="Prestasi"
                                                    {{ old('kategori', $participant->kategori) == 'Prestasi' ? 'selected' : '' }}>
                                                    Prestasi
                                                </option>
                                            </select>
                                            <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Kategori Tanding</label>
                                        <div>
                                            <select class="form-select" name="kategori_tanding" id="kategori_tanding">
                                                <option value="">Pilih Kategori Tanding</option>
                                                <option value="KYORUGI" @selected(old('kategori_tanding', $participant->kategori_tanding) == 'KYORUGI')>KYORUGI</option>
                                                <option value="POOMSAE" @selected(old('kategori_tanding', $participant->kategori_tanding) == 'POOMSAE')>POOMSAE</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('kategori_tanding')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Level</label>
                                        <div>
                                            <select class="form-select" name="kategori_level" id="kategori_level">
                                                <option value="">Pilih Level</option>
                                                @if ($participant->kategori === 'Pemula')
                                                    <option value="PRACADET_4-5" @selected(isset($participant) && $participant->kategori_level === 'PRACADET_4-5')>PRACADET
                                                        4-5</option>
                                                    <option value="PRACADET_6-7" @selected(isset($participant) && $participant->kategori_level === 'PRACADET_6-7')>PRACADET
                                                        6-7</option>
                                                    <option value="PRACADET_8-9" @selected(isset($participant) && $participant->kategori_level === 'PRACADET_8-9')>PRACADET
                                                        8-9</option>
                                                    <option value="PRACADET_10-11" @selected(isset($participant) && $participant->kategori_level === 'PRACADET_10-11')>PRACADET
                                                        10-11</option>
                                                @else
                                                    <option value="PRACADET" @selected(isset($participant) && $participant->kategori_level === 'PRACADET')>PRACADET
                                                    </option>
                                                @endif

                                                <option value="CADET" @selected(isset($participant) && $participant->kategori_level === 'CADET')>CADET</option>
                                                <option value="JUNIOR" @selected(isset($participant) && $participant->kategori_level === 'JUNIOR')>JUNIOR</option>
                                                <option value="SENIOR" @selected(isset($participant) && $participant->kategori_level === 'SENIOR')>SENIOR</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                                        </div>
                                    </div>



                                    <div class="col-12 mb-3 {{ $participant->kategori_tanding === 'KYORUGI' ? ' d-block' : ' d-none' }}"
                                        id="berat_badan_field">
                                        <label for="berat_badan" class="form-label">Berat Badan (Kg)</label>
                                        <select name="berat_badan" class="form-select" id="berat_badan">
                                            <option value="">Pilih</option>
                                            @forelse ($kelas as $option)
                                                <option value="{{ $option->value }}" @selected($participant->berat_badan === $option->value)>
                                                    {{ $option->name }}
                                                </option>
                                            @empty
                                                <option value="" disabled>Tidak ada data kelas tersedia</option>
                                            @endforelse
                                        </select>
                                        <x-input-error :messages="$errors->get('berat_badan')" class="mt-2" />
                                    </div>

                                    @if ($participant->kategori === 'Pemula')
                                        <div class="col-12 mb-3 {{ $participant->kategori_tanding === 'KYORUGI' ? ' d-block' : ' d-none' }}"
                                            id="tinggi_badan_field">

                                            <label for="tinggi_badan" class="form-label"> Tinggi Badan
                                                (cm)</label>
                                            <input type="number" name="tinggi_badan" class="form-control"
                                                id="tinggi_badan" value="{{ $participant->tinggi_badan }}">

                                            <x-input-error :messages="$errors->get('tinggi_badan')" class="mt-2" />

                                        </div>
                                    @endif


                                    <div class="col-12 mb-3 {{ $participant->kategori_tanding === 'POOMSAE' ? ' d-block' : ' d-none' }}"
                                        id="kelompok_poomsae_field">

                                        <label for="kelompok_poomsae" class="form-label"> Kelompok
                                        </label>
                                        <select name="kelompok_poomsae" class="form-select" id="kelompok_poomsae">
                                            <option value="">Pilih</option>
                                            @foreach ($kelompok as $option)
                                                <option value="{{ $option->value }}" @selected($participant->kelompok_poomsae === $option->value)>
                                                    {{ $option->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <x-input-error :messages="$errors->get('kelompok_poomsae')" class="mt-2" />

                                    </div>


                                    <div class="col-12 mb-3 {{ $participant->kategori_tanding === 'KYORUGI' ? ' d-block' : ' d-none' }}"
                                        id="sabuk_kyorugi_field">

                                        <label for="sabuk_kyorugi" class="form-label"> Sabuk
                                        </label>
                                        <select name="sabuk_kyorugi" class="form-select" id="sabuk_kyorugi">
                                            <option value="">Pilih Sabuk</option>
                                            @foreach ($sabuk as $row)
                                                <option value="{{ $row->value }}" @selected($participant->sabuk_kyorugi === $row->value)>
                                                    {{ $row->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <x-input-error :messages="$errors->get('sabuk_kyorugi')" class="mt-2" />

                                    </div>


                                    <div class="col-12 mb-3 {{ $participant->kategori_tanding === 'POOMSAE' ? ' d-block' : ' d-none' }}"
                                        id="sabuk_poomsae_field">

                                        <label for="sabuk_poomsae" class="form-label"> Sabuk
                                        </label>
                                        <select name="sabuk_poomsae" class="form-select" id="sabuk_poomsae">
                                            <option value="">Pilih Sabuk</option>
                                            @foreach ($sabuk as $row)
                                                <option value="{{ $row->value }}" @selected($participant->sabuk_poomsae === $row->value)>
                                                    {{ $row->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <x-input-error :messages="$errors->get('sabuk_poomsae')" class="mt-2" />

                                    </div>


                                    <div class="col-12 mt-3">
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg> Update
                                            </button>

                                            <a href="{{ route('admin.participants.index') }}"
                                                class="btn btn-secondary rounded" role="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
    </div>
@stop

@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('frontend/assets/js/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {


            const dataLevelPrestasi = {
                PRACADET: "PRACADET",
                CADET: "CADET",
                JUNIOR: "JUNIOR",
                SENIOR: "SENIOR",
            };

            const dataLevelPemula = {
                "PRACADET_4-5": "PRACADET 4-5",
                "PRACADET_6-7": "PRACADET 6-7",
                "PRACADET_8-9": "PRACADET 8-9",
                "PRACADET_10-11": "PRACADET 10-11",
                CADET: "CADET",
                JUNIOR: "JUNIOR",
                SENIOR: "SENIOR",
            };

            $("#kategori").change(function() {

                $("#kategori_level").empty();
                $("#kategori_level").prepend(
                    `<option value="" selected>Pilih Level</option>`,
                );

                if ($(this).val() == "Pemula") {
                    //Pemula
                    $.each(dataLevelPemula, function(index, value) {
                        $("#kategori_level").append(
                            `<option value=${index} >${value}</option>`,
                        );
                    });
                } else if ($(this).val() == "Prestasi") {
                    //Prestasi
                    $.each(dataLevelPrestasi, function(index, value) {
                        $("#kategori_level").append(
                            `<option value=${index} >${value}</option>`,
                        );
                    });
                }
            });


            //Kategori Tanding Show/Hide Field
            $('#kategori_tanding').change(function() {
                var selectedValue = $(this).val();

                if (selectedValue === 'KYORUGI') {

                    $('#berat_badan_field').removeClass('d-none').addClass('d-block');
                    $('#berat_badan').prop('disabled', false);

                    $('#kelompok_poomsae_field').removeClass('d-block').addClass('d-none');
                    $('#tinggi_badan_field').removeClass('d-none').addClass('d-block');
                    $('#tinggi_badan').prop('disabled', false);

                    $("#sabuk_kyorugi_field").removeClass('d-none').addClass('d-block');
                    $("#sabuk_kyorugi").prop('disabled', false);

                    $("#sabuk_poomsae_field").removeClass('d-block').addClass('d-none');
                    $("#sabuk_poomsae").val('').prop('disabled', true);


                } else if (selectedValue === 'POOMSAE') {

                    $('#berat_badan_field').removeClass('d-block').addClass('d-none');
                    $('#berat_badan').val('').prop('disabled', true);

                    $('#kelompok_poomsae_field').removeClass('d-none').addClass('d-block');

                    $("#sabuk_poomsae_field").removeClass('d-none').addClass('d-block');
                    $("#sabuk_poomsae").prop('disabled', false);

                    $("#sabuk_kyorugi_field").removeClass('d-block').addClass('d-none');
                    $("#sabuk_kyorugi").val('').prop('disabled', true);


                    $('#tinggi_badan_field').removeClass('d-block').addClass('d-none');
                    $('#tinggi_badan').val('').prop('disabled', true);

                } else {
                    $('#berat_badan_field').removeClass('d-block').addClass('d-none');
                    $('#kelompok_poomsae_field').removeClass('d-block').addClass('d-none');
                    $('#tinggi_badan_field').removeClass('d-block').addClass('d-none');
                }

            });


            // Fetch Berat Badan / Kelas dynamic filter
            $('#gender, #kategori, #kategori_level, #kategori_tanding').on('change', function() {
                var filter_gender = $('#gender').val();
                var filter_kategori = $('#kategori').val();
                var filter_level = $('#kategori_level').val();
                var filter_kategori_tanding = $('#kategori_tanding').val();

                if (filter_gender && filter_kategori && filter_level && filter_kategori_tanding) {
                    $.ajax({
                        url: "{{ route('admin.ajax.get_kelas_berat_badan') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            filter_gender: filter_gender,
                            filter_kategori: filter_kategori,
                            filter_level: filter_level,
                            filter_kategori_tanding: filter_kategori_tanding
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#berat_badan').empty();
                            $('#berat_badan').append(
                                '<option value="">Pilih</option>');
                            $.each(response, function(key, value) {
                                $('#berat_badan').append('<option value="' +
                                    value.value + '">' + value.value + '</option>');
                            });
                            $('#berat_badan').trigger('change');
                        }
                    });
                } else {
                    $('#berat_badan').empty().trigger('change');
                }


                if (filter_kategori && filter_kategori_tanding) {

                    $.ajax({
                        url: "{{ route('admin.ajax.get_kelompok') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            filter_kategori: filter_kategori,
                            filter_kategori_tanding: filter_kategori_tanding
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#kelompok_poomsae').empty();
                            $('#kelompok_poomsae').append(
                                '<option value="">Pilih</option>');
                            $.each(response, function(key, value) {
                                $('#kelompok_poomsae').append('<option value="' +
                                    value.value + '">' + value.name + '</option>');
                            });
                            $('#kelompok_poomsae').trigger('change');
                        }
                    });

                    $.ajax({
                        url: "{{ route('admin.ajax.get_sabuk') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            filter_kategori: filter_kategori,
                            filter_kategori_tanding: filter_kategori_tanding
                        },
                        dataType: "json",
                        success: function(response) {
                            if ($('#kategori_tanding').val() === 'KYORUGI') {
                                $('#sabuk_kyorugi').empty();
                                $('#sabuk_kyorugi').append(
                                    '<option value="">Pilih Sabuk</option>');
                                $.each(response, function(key, value) {
                                    $('#sabuk_kyorugi').append('<option value="' +
                                        value.value + '">' + value.name +
                                        '</option>');
                                });
                                $('#sabuk_kyorugi').trigger('change');
                            } else if ($('#kategori_tanding').val() === 'POOMSAE') {
                                $('#sabuk_poomsae').empty();
                                $('#sabuk_poomsae').append(
                                    '<option value="">Pilih Sabuk</option>');
                                $.each(response, function(key, value) {
                                    $('#sabuk_poomsae').append('<option value="' +
                                        value.value + '">' + value.name +
                                        '</option>');
                                });
                                $('#sabuk_poomsae').trigger('change');
                            }
                        }
                    });


                } else {
                    $('#kelompok_poomsae').empty().trigger('change');
                    $('#sabuk_poomsae').empty().trigger('change');
                    $('#sabuk_kyorugi').empty().trigger('change');
                }

            });


        });
    </script>
@stop
