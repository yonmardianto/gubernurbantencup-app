<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Registrasi </title>
    <!-- CSS files -->
    <link href="{{ asset('admin/assets/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/dist/css/demo.min.css?1692870487') }}" rel="stylesheet" />
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
            /* background-color: lightgray !important; */
        }



    </style>
</head>

<body>

    <div class="container">
        <div class="d-flex py-7 flex-col gap-2">

            <div class="col col-lg-5">
                <img src="{{ asset('frontend/assets/images/registrasi.jpeg') }}" />
            </div>

            <div class="card card-info">

                <div class="card-header py-3">
                    <h3 class="card-title"> <i class="fas fa-user"></i> FORM PENDAFTARAN</h3>

                </div>

                <form name="form-daftar" method="post" enctype="multipart/form-data" action="{{ route('store.registrasi') }}">
                    @csrf
                    <div class="card-body" style="overflow:auto; height:700px;scrollbar-color: #015d38 #ffc300;">
                        <div class="row">
                             <!-- Session Status -->
                             <x-auth-session-status class="mb-4" :status="session('success')" />

                            <div class="col-xl-12">
                                <div class="required mb-2">
                                    <label for="nama_lengkap" class="form-label">Nama </label>
                                    <input name="nama_lengkap" id="nama_lengkap" type="text" placeholder="Nama lengkap"
                                        class="form-control" value="{{ old('nama_lengkap') }}">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="required  mb-2">
                                    <label for="gender" class="form-label">Gender </label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option selected value="">Pilih</option>
                                        <option value="Putra">Putra</option>
                                        <option value="Putri">Putri</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="required  mb-2">
                                    <label for="email" class="form-label">Email </label>
                                    <input class="form-control" name="email" id="email" type="email"
                                        placeholder="Email" value="{{ old('email') }}">
                                 <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="required  mb-2">
                                    <label for="email" class="form-label">Club </label>
                                    <input class="form-control" name="club" id="club" type="text"
                                        placeholder="Club" value="{{ old('club') }}">
                                   <x-input-error :messages="$errors->get('club')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="required  mb-2">
                                    <label for="no_hp" class="form-label">No. Hp </label>
                                    <input class="form-control" name="no_hp" id="no_hp" type="text"
                                        placeholder="No. Handphone" value="{{ old('no_hp') }}">
                                    <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="required mb-2">
                                    <label for="kategori" class="form-label">Entry By Name </label>
                                    <select name="kategori" class="form-control select2" id="kategori" required>
                                        <option selected value="">Pilih</option>
                                        <option value="Pemula">Pemula</option>
                                        <option value="Prestasi">Prestasi</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="required mb-2">
                                    <label for="kategori_level" class="form-label">Kategori Level </label>
                                    <select name="kategori_level" class="form-control select2" id="kategori_level" required>

                                    </select>

                                    <x-input-error :messages="$errors->get('kategori_level')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="required mb-2">
                                    <label for="kategori_tanding" class="form-label">Kategori Pertandingan </label>
                                    <select name="kategori_tanding" class="form-control select2" id="kategori_tanding">
                                    </select>
                                    <x-input-error :messages="$errors->get('kategori_tanding')" class="mt-2" />
                                </div>
                            </div>


                            <div id="sectionPoomSae" class="d-none">

                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Pilih Kategori : </label>
                                        <select name="kelompok_poomsae" class="form-control select2" id="kelompok_poomsae">
                                        </select>

                                        <x-input-error :messages="$errors->get('kelompok_poomsae')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12 div-sabuk-poomsae">
                                    <div class="wsus__login_form_input">
                                        <label>Pilih Jenis Sabuk : </label>
                                        <select name="sabuk_poomsae" class="form-control select2" id="sabuk_poomsae">
                                        </select>
                                        <x-input-error :messages="$errors->get('sabuk_poomsae')" class="mt-2" />
                                    </div>
                                </div>

                            </div>



                            <div id="sectionKyorugi" class="d-none">

                                <div class="col-xl-12 div-kategori-usia">
                                    <div class="wsus__login_form_input">
                                        <label for="kategori_usia" class="form-label"> Pilih Usia </label>
                                        <select name="kategori_usia" class="form-control select2" id="kategori_usia">
                                        </select>
                                        <x-input-error :messages="$errors->get('kategori_usia')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label for="berat_badan"> Berat Badan</label>
                                        <select name="berat_badan" class="form-control select2" id="berat_badan">
                                        </select>
                                        <x-input-error :messages="$errors->get('berat_badan')" class="mt-2" />
                                    </div>
                                </div>


                            </div>


                            <div class="col-xl-12">
                                <div class="wsus__login_form_input">
                                    <label for="pembayaran"> Upload Bukti Pembayaran</label>
                                    <input type="file" name="pembayaran" id="pembayaran" />
                                    <x-input-error :messages="$errors->get('pembayaran')" class="mt-2" />
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="wsus__login_form_input">
                                    <button type="submit" class="registrasi_btn"><i class="fas fa-save" style="font-size: 18px;"></i> SUBMIT
                                        DATA</button>
                                </div>


                            </div>
                        </div>
                    </div>
               </form>

            </div>
        </div>

    </div>

    <!--jquery library js-->
    <script src="{{ asset('frontend/assets/js/jquery-3.7.1.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--select2 min js-->
    <script src="{{ asset('frontend/assets/js/select2.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('frontend/assets/js/Font-Awesome.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/app.js') }}"></script>

</body>


</html>
