<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("vendor/bootstrap/css/bootstrap.min.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("fonts/font-awesome-4.7.0/css/font-awesome.min.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("fonts/iconic/css/material-design-iconic-font.min.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("vendor/animate/animate.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("vendor/css-hamburgers/hamburgers.min.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("vendor/animsition/css/animsition.min.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("vendor/select2/select2.min.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("vendor/daterangepicker/daterangepicker.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("css/util-auth.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("css/main-auth.css") }}">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                @yield('content')
                <div class="text-center">
                    <div class="txt1 text-center text-muted" style="margin-top: 10px;">
                        @php $no = 0; @endphp @foreach (config('languages') as $lang => $language) @php $no++; @endphp @if ($lang != App::getLocale())
                        <a href="{{ route('lang.switch', $lang) }}" class="txt2">{{ $language }}</a>
                        @else {{ $language }} @endif @if ($no != count(config('languages'))) &sdot; @endif @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="{{ asset("vendor/jquery/jquery-3.2.1.min.js") }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset("vendor/animsition/js/animsition.min.js") }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset("vendor/bootstrap/js/popper.js") }}"></script>
    <script src="{{ asset("vendor/bootstrap/js/bootstrap.min.js") }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset("vendor/select2/select2.min.js") }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset("vendor/daterangepicker/moment.min.js") }}"></script>
    <script src="{{ asset("vendor/daterangepicker/daterangepicker.js") }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset("vendor/countdowntime/countdowntime.js") }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset("js/main-auth.js") }}"></script>

</body>

</html>