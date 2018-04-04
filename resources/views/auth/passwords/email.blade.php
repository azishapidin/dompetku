@extends('layouts.auth')
@section('title', __('Forgot Password')) 

@section('content')
<form class="card" method="POST" action="{{ route('password.email') }}">
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
</div>
@endsection