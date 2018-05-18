@extends('layouts.auth')
@section('title', __('Register') . ' ~ ' . config('app.name'))

@section('content')
<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
    @csrf
    <span class="login100-form-title p-b-48">
        {{ __('Register') }}
    </span>

    @include('part.error')

    <div class="wrap-input100 validate-input" data-validate="{{ __('validation.required', ['attribute' => '']) }}">
        <input class="input100" type="text" name="name">
        <span class="focus-input100" data-placeholder="{{ __('Name') }}"></span>
    </div>

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

    <div class="wrap-input100 validate-input" data-validate="{{ __('validation.required', ['attribute' => '']) }}">
        <span class="btn-show-pass">
            <i class="zmdi zmdi-eye"></i>
        </span>
        <input class="input100" type="password" name="password_confirmation">
        <span class="focus-input100" data-placeholder="{{ __('Password Confirmation') }}"></span>
    </div>

    <div class="container-login100-form-btn">
        <div class="wrap-login100-form-btn">
            <div class="login100-form-bgbtn"></div>
            <button class="login100-form-btn">
                {{ __('Register') }}
            </button>
        </div>
    </div>
</form>

<br>
<br>
<div class="text-center">
    <span class="txt1">
        {{ __('Already have account?') }}
        <a href="{{ route('login') }}" class="txt2">{{ __('Login') }}</a>
    </span>
    <br>
</div>
@endsection