@extends('layouts.auth')
@section('title', __('Login'))

@section('content')
<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
    @csrf
    <span class="login100-form-title p-b-48">
        {{ __('Login') }}
    </span>

    @include('part.error')
    <br>

    <div class="wrap-input100 validate-input" data-validate="{{ __('validation.email', ['attribute' => '']) }}">
        <input class="input100" type="text" name="email">
        <span class="focus-input100" data-placeholder="{{ __('E-Mail Address') }}"></span>
    </div>

    <div class="wrap-input100 validate-input" data-validate="{{ __('validation.required', ['attribute' => '']) }}">
        <span class="btn-show-pass">
            <i class="zmdi zmdi-eye"></i>
        </span>
        <input class="input100" type="password" name="password">
        <span class="focus-input100" data-placeholder="{{ __('Password') }}"></span>
    </div>
    <a href="{{ route('password.request') }}" class="pull-right small">{{ __('Forgot Your Password?') }}</a>

    <br>
    <br>
    <div class="container-login100-form-btn">
        <div class="wrap-login100-form-btn">
            <div class="login100-form-bgbtn"></div>
            <button class="login100-form-btn">
                {{ __('Login') }}
            </button>
        </div>
    </div>
</form>

<br>
<br>
<div class="text-center">
    <span class="txt1">
        {{ __("Don't have account yet?") }}
        <a href="{{ route('register') }}" class="txt2">{{ __("Sign Up") }}</a>
    </span>
    <br>
</div>
@endsection