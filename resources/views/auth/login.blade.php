<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login </title>
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


    </style>
</head>

<body>

    <div class="container">
        <div class="d-flex py-7 flex-col gap-2">

            <div class="col col-lg-5">
                <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/images/registrasi.jpeg') }}" height="500px" width="500px" /> </a>
            </div>

            <div class="card card-info">

                <form action="{{ route('login') }}" method="POST" id="form-login">
                    @csrf

                    <div class="card-body">
                        <h3 class="mb-4">Login</h3>

                        <div class="row">
                            <div class="col-xl-12 mb-4">
                                <div class="required">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}"
                                        required>

                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="required mb-2">

                                    <label for="password" class="form-label">Password </label>


                                        <div class="input-group input-group-flat">
                                            <input type="password" name="password" id="password" class="form-control password" placeholder="Your password"
                                                autocomplete="off" required>
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
                            </div>

                            <div class="col-xl-12">
                                <div class="mt-3">
                                    <button type="submit" class="login_btn text-white font-bold w-100"> <i class="fas fa-sign-in-alt"></i> LOGIN </button>
                                    <button type="button" class="loading_btn text-white font-bold w-100 d-none" disabled> Please Wait ... </button>
                                </div>
                            </div>


                            <div class="col-xl-12 mt-2">
                                <p class="create_account">Belum punya akun ? <a href="{{ route('register') }}">Klik disini
                                    <i class="far fa-arrow-right"
                                    aria-hidden="true"></i>  </a></p>
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
