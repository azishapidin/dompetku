@extends('layouts.app')
@section('title', __('Create Account'))

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            {{ __('Create Account') }}
        </h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-header" style="background-image: url({{ asset('assets/images/cover.jpg') }});"></div>
                <div class="card-body text-center">
                    <img class="card-profile-img" src="{{ Gravatar::src(Auth::user()->email) }}">
                    <h3 class="mb-3">{{ Auth::user()->name }}</h3>
                    <p class="mb-4">
                        Backend Engineer :D
                    </p>
                    <button class="btn btn-outline-primary btn-sm">
                        <span class="fa fa-pencil"></span> {{ __("Update Profile") }}
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __("Account Information") }}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Account Name</label>
                        <input class="form-control" name="name" placeholder="Account name.." type="text">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Account Image/Icon</label>
                        <input name="name" type="file"><br>
                        <small class="text-info">By default, account image is a wallet icon.</small>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Currency</label>
                        <select name="currency" class="form-control">
                            <option value="IDR" data-symbol="Rp">Rupiah (Rp)</option>
                            <option value="USD" data-symbol="$">US Dollar ($)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Currency symbol placement</label>
                        <select name="currency_placement" class="form-control">
                            <option value="before">Before the Number</option>
                            <option value="after">After the Number</option>
                        </select>
                    </div>

                    <div class="form-group" style="max-width: 300px;">
                        <label class="form-label">Current Balance</label>
                        <div class="input-group">
                          <span class="input-group-prepend currency-prepend" style="display:none">
                            <span class="input-group-text currency">$</span>
                          </span>
                          <input class="form-control text-right" aria-label="Insert current balance" placeholder="Insert current Account balance.." type="text" name="balance">
                          <span class="input-group-append currency-append" style="display:none">
                            <span class="input-group-text currency">$</span>
                          </span>
                        </div>
                    </div>


                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                      <a href="javascript:void(0)" type="reset" class="btn btn-link">Cancel</a>
                      <button type="submit" class="btn btn-primary ml-auto">Save Data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('after_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $( document ).ready(function() {
        function setBalanceInput() {
            var value = $("select[name=currency_placement]").val();
            if (value == 'before') {
                $(".currency-prepend").show();
                $(".currency-append").hide();
            } else {
                $(".currency-prepend").hide();
                $(".currency-append").show();
            }
        }
        function setCurrency(){
            var currency = $("select[name=currency]").find(':selected').data('symbol');
            $(".currency").text(currency);
        }
        setBalanceInput();
        setCurrency();

        $("select[name=currency_placement]").on('change', function() {
            setBalanceInput();
        })
        $("select[name=currency]").on('change', function() {
            setCurrency();
        })
    });
</script>
@endsection