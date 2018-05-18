@extends('layouts.auth')
@section('title', __('Forgot Password')) 

@section('content')
<form class="login100-form validate-form" method="POST" action="{{ route('password.email') }}">
    @csrf
    <span class="login100-form-title p-b-48">
        {{ __('Forgot Password') }}
    </span>
    
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @else
    <p class="text-muted text-center">{{ __('Enter your email address and your will get reset password link via email.') }}</p>
    @endif
    <br>
    
    <div class="wrap-input100 validate-input" data-validate="{{ __('validation.email', ['attribute' => '']) }}">
        <input class="input100" type="text" name="email">
        <span class="focus-input100" data-placeholder="{{ __('E-Mail Address') }}"></span>
    </div>
    
    <div class="container-login100-form-btn">
        <div class="wrap-login100-form-btn">
            <div class="login100-form-bgbtn"></div>
            <button class="login100-form-btn">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </div>
</form>
    
<br>
<br>
<div class="text-center">
    <a href="{{ route('login') }}" class="txt2">{{ __('Back to Login') }}</a>
</div>
{{-- <form class="card" method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="card-body p-6">
        <div class="card-title">{{ __('Forgot Password') }}</div>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @else
        <p class="text-muted">{{ __('Enter your email address and your will get reset password link via email.') }}</p>
        @endif
        <div class="form-group">
            <label class="form-label">{{ __('E-Mail Address') }}</label>
            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <small class="text-danger">{{ $errors->first('email') }}</small>
            @endif
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
        </div>
    </div>
</form>

<div class="text-center text-muted">
    <a href="{{ route('login') }}">{{ __('Back to Login') }}</a>
</div> --}}
@endsection