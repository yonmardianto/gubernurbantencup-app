<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <title>
        @section('title')
            | Gubernur Banten Cup 2026
        @show
    </title>

    <link rel="icon" href="{{ asset('frontend/assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animated_barfiller.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/select2.min.css') }}">
    <link rel=" stylesheet" href="{{ asset('frontend/assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">

    @yield('header_styles')
</head>

<body>

    <section class="wsus__dashboard ">
        <div class="container">

            <div class="row">
                <div class="col-xl-3 col-md-4 wow fadeInLeft">
                    @include('frontend.layouts.sidebar')
                </div>

                <div class="col-xl-9 col-md-8">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>


    <!--jquery library js-->
    <script src="{{ asset('frontend/assets/js/jquery-3.7.1.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('frontend/assets/js/Font-Awesome.js') }}"></script>



    <!--select2 js-->
    <script src="{{ asset('frontend/assets/js/select2.min.js') }}"></script>
    <!--wow js-->
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/app.js') }}"></script>

    @yield('footer_scripts')

    <script type="text/javascript">
        $(document).ready(function() {

            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 4000);


        });
    </script>
</body>

</html>
