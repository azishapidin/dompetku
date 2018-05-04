@extends('layouts.master')
@section('title') @yield('title') @endsection 

@section('body')
<div class="page">
    <div class="page-main">
        <div class="header">
            <div class="container">
                <div class="d-flex">
                    <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo.png') }}" class="navbar-brand-img" alt="{{ config('app.name') }}">
                    </a>
                    <div class="ml-auto d-flex order-lg-2">
                        <div class="nav-item">
                            <a href="https://github.com/azishapidin/dompetku" target="_blank" class="btn btn-outline-primary btn-sm">Fork me on Github</a>
                        </div>
                        <div class="dropdown">
                            <a href="#" class="nav-link pr-0" data-toggle="dropdown">
                                <span class="avatar" style="background-image: url({{ Gravatar::src(Auth::user()->email) }})"></span>
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
                                <a href="{{ route('home') }}" class="nav-link active">
                                <i class="fe fe-activity"></i> {{ __('Summary') }} </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fe fe-database"></i> {{ __('All Transaction') }} </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link"><i class="fe fe-credit-card"></i> {{ __('Accounts') }}</a>
                                <div class="nav-submenu nav">
                                    <a href="{{ route('account.create') }}" class="nav-item">{{ __('Add Account') }} </a>
                                    <a href="{{ route('account.index') }}" class="nav-item">{{ __('Show All Account') }} </a>
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