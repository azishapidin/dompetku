@extends('layouts.auth')
@section('title', __('Login'))

@section('content')
<form class="card" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="card-body p-6">
        <div class="card-title">{{ __('Login') }}</div>
        <div class="form-group">
            <label class="form-label">{{ __('E-Mail Address') }}</label>
            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <small class="text-danger">{{ $errors->first('email') }}</small>
            @endif
        </div>
        <div class="form-group">
            <label class="form-label">
                {{ __('Password') }}
                <a href="{{ route('password.request') }}" class="pull-right small">{{ __('Forgot Your Password?') }}</a>
            </label>
            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" value="{{ old('password') }}">
            @if ($errors->has('password'))
                <small class="text-danger">{{ $errors->first('password') }}</small>
            @endif
        </div>
        <div class="form-group">
            <label class="custom-control custom-checkbox">
                <input type="checkbox" name="remember" {{ old( 'remember') ? 'checked' : '' }} class="custom-control-input" />
                <span class="custom-control-label">{{ __('Remember Me') }}</span>
            </label>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
        </div>
    </div>
</form>
<div class="text-center text-muted">
    {{ __("Don't have account yet?") }}
    <a href="{{ route('register') }}">{{ __("Sign Up") }}</a>
</div>
@endsection