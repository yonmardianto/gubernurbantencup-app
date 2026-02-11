<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign Up </title>
    <!-- CSS files -->
    <link href="{{ asset('admin/assets/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/dist/css/demo.min.css?1692870487') }}" rel="stylesheet" />
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">

</head>

<body>

    <div class="container">
        <div class="d-flex py-7 flex-col gap-2">
            @if (!$lock)
                <div class="col col-lg-5">
                    <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/images/registrasi.jpeg') }}"
                            height="500px" width="500px" /> </a>
                </div>

                <div class="card card-info">

                    <form action="{{ route('register', ['type' => 'instructor']) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <h3 class="mb-4">Sign Up</h3>

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="required mb-2">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" placeholder="Nama" name="name"
                                            required value="{{ old('name') }}">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="required mb-2">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" value="{{ old('email') }}"
                                            placeholder="Your email" name="email" required>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="required mb-2">
                                        <label for="no_hp" class="form-label">No. Hp </label>
                                        <input class="form-control" name="no_hp" id="no_hp" type="text"
                                            placeholder="No. Handphone" value="{{ old('no_hp') }}">
                                        <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="required mb-2">
                                        <label for="club" class="form-label">Club / Team</label>
                                        <input class="form-control" name="club" id="club" type="text"
                                            placeholder="Your club/team" value="{{ old('club') }}">
                                        <x-input-error :messages="$errors->get('club')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="required mb-2">
                                        <label for="password" class="form-label">Password</label>
                                        <input class="form-control" type="password" placeholder="Your password"
                                            name="password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>


                                <div class="col-xl-12">
                                    <div class="required mb-2">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" placeholder="Your confirm password"
                                            name="password_confirmation" required>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="mt-3">
                                        <button type="submit" class="registrasi_btn w-100"> <i class="fas fa-edit"></i>
                                            SIGN UP</button>
                                    </div>
                                </div>
                                <div class="col-xl-12 mt-2">
                                    <p class="new_user">Sudah Punya Akun? <a href="{{ route('login') }}">Login</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </form>
            @endif



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
    <script>
        var lockApplication = '{{$lock}}';
        if(lockApplication){
           alert('Maaf pendaftaran sudah ditutup ');
           location.href='/';
        }
        
    </script>

</body>


</html>
