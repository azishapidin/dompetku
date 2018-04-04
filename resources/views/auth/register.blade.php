@extends('layouts.auth')
@section('title', __('Register')) 

@section('content')
<form class="card" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="card-body p-6">
        <div class="card-title">{{ __('Register') }}</div>
        <div class="form-group">
                <label class="form-label">{{ __('Name') }}</label>
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
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
            </label>
            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" value="{{ old('password') }}">
            @if ($errors->has('password'))
                <small class="text-danger">{{ $errors->first('password') }}</small>
            @endif
        </div>
        <div class="form-group">
                <label class="form-label">
                    {{ __('Password Confirmation') }}
                </label>
                <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="{{ __('Password Confirmation') }}" value="{{ old('password_confirmation') }}">
                @if ($errors->has('password_confirmation'))
                    <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                @endif
            </div>
        {{-- <div class="form-group">
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" />
                <span class="custom-control-label">Agree the
                    <a href="terms.html">terms and policy</a>
                </span>
            </label>
        </div> --}}
        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
        </div>
    </div>
</form>

<div class="text-center text-muted">
    {{ __('Already have account?') }}
    <a href="{{ route('login') }}">{{ __('Login') }}</a>
</div>
@endsection