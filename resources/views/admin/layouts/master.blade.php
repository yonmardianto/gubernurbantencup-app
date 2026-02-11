<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        @section('title')
            | Kajati Cup Banten 2025
        @show
    </title>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <!-- CSS files -->
    <link href="{{ asset('admin/assets/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
    @yield('header_styles')
</head>

<body>
    <script src="{{ asset('admin/assets/dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.header')

        <div class="page-wrapper">
            @yield('content')

            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- Tabler Core -->
    <!--jquery library js-->
    <script src="{{ asset('frontend/assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script type="text/javascript">
        $(document).ready(function() {

            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 4000);


        });
    </script>
    @yield('footer_scripts')
</body>

</html>

