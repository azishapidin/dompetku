{{--
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li>
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html> --}}
@extends('layouts.master') @section('title') @yield('title') @endsection 

@section('body')
<div class="page">
    <div class="page-main">
        <div class="header">
            <div class="container">
                <div class="d-flex">
                    <a class="navbar-brand" href="./index.html">
                    <img src="{{ asset('assets/images/logo.png') }}" class="navbar-brand-img" alt="{{ config('app.name') }}">
                    </a>
                    <div class="ml-auto d-flex order-lg-2">
                        <div class="nav-item">
                            <a href="https://github.com/azishapidin/dompetku" target="_blank" class="btn btn-outline-primary btn-sm">Fork me on Github</a>
                        </div>
                        <div class="dropdown">
                            <a href="#" class="nav-link pr-0" data-toggle="dropdown">
                                <span class="avatar" style="background-image: url({{ asset('assets/images/azishapidin.jpg') }})"></span>
                                <span class="ml-2 d-none d-lg-block">
                                    <span class="text-default">{{ Auth::user()->name }}</span>
                                    <small class="text-muted d-block mt-1">Superman</small>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">
                                    {{ __('Account Setting') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-nav d-none d-lg-flex">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link active">
                                <i class="fe fe-activity"></i> {{ __('Summary') }} </a>
                            </li>
                            <li class="nav-item">
                                <a href="./docs/index.html" class="nav-link">
                                    <i class="fe fe-database"></i> {{ __('All Transaction') }} </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link"><i class="fe fe-credit-card"></i> {{ __('Accounts') }}</a>
                                <div class="nav-submenu nav">
                                    <a href="#" class="nav-item">{{ __('Add Account') }} </a>
                                    <a href="#" class="nav-item">{{ __('Show All Account') }} </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3 ml-auto">
                        <form class="input-icon">
                            <input type="search" class="form-control header-search" placeholder="{{ __('Search') }}&hellip;" tabindex="1">
                            <div class="input-icon-addon">
                                <i class="fe fe-search"></i>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            @yield('content') 
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-auto">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                @php $no = 0; @endphp
                                @foreach (config('languages') as $lang => $language)
                                    @php
                                    $no++;
                                    @endphp
                                    @if ($lang != App::getLocale())
                                        <li class="list-inline-item">
                                                <a href="{{ route('lang.switch', $lang) }}">{{ $language }}</a>
                                        </li>
                                    @else
                                        <li class="list-inline-item">
                                            {{ $language }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-auto">
                            <a href="https://github.com/azishapidin/dompetku" target="_blank" class="btn btn-outline-primary btn-sm">Fork me on Github</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    {{ __('Copyright') }} © {{ date('Y') }}
                    <a href="{{ url('') }}">{{ config('app.name') }}</a>. {{ __('System developed by') }} <a href="https://azishapidin.com/" target="_blank">Azis Hapidin</a> | Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a> All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection