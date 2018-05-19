@extends('layouts.app')
@section('title', __('Create Account'))

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ __("Account Information") }}</h4>
            </div>
            <div class="content">
                <form action="{{ route('account.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Account Name') }}</label>
                                <input class="form-control{{ $errors->has('name') ? ' has-error' : '' }}" name="name" placeholder="{{ __('Account Name') }}.." type="text"
                                    value="{{ old('name') }}"> @if ($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Account Image/Icon') }}</label>
                                <input name="image" type="file">
                                <br> @if ($errors->has('image'))
                                <small class="text-danger">{{ $errors->first('image') }}</small>
                                @else
                                <small class="text-info">{{ __('By default, account image is a wallet icon, max file size is 500kb.') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('Currency') }}</label>
                        <select name="currency" class="form-control{{ $errors->has('currency') ? ' has-error' : '' }}">
                            @foreach ($currencies as $code => $currency)
                            <option value="{{ $code }}" data-symbol="{{ $currency['symbol'] }}" @if($code==old( 'currency')) selected @endif>{{ $currency['name'] }} ({{ $currency['symbol'] }})</option>
                            @endforeach
                        </select>
                        @if ($errors->has('currency'))
                        <small class="text-danger">{{ $errors->first('currency') }}</small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('Currency symbol placement') }}</label>
                        <select name="currency_placement" class="form-control{{ $errors->has('currency_placement') ? ' has-error' : '' }}">
                            <option value="before" @if( 'before'==old( 'currency_placement')) selected @endif>{{ __('Before the Number') }}</option>
                            <option value="after" @if( 'after'==old( 'currency_placement')) selected @endif>{{ __('After the Number') }}</option>
                        </select>
                        @if ($errors->has('currency_placement'))
                        <small class="text-danger">{{ $errors->first('currency_placement') }}</small>
                        @endif
                    </div>

                    <div class="form-group" style="max-width: 300px;">
                        <label class="form-label">{{ __('Current Balance') }}</label>
                        <div class="input-group">
                            <span class="input-group-addon currency currency-prepend" style="display:none">$</span>
                            <input class="form-control text-right{{ $errors->has('balance') ? ' has-error' : '' }}" aria-label="Insert current balance"
                            placeholder="{{ __('Insert current Account balance') }}.." type="text" name="balance" value="{{ old('balance') }}">
                            <span class="input-group-addon currency currency-append">$</span>
                        </div>
                        @if ($errors->has('balance'))
                        <small class="text-danger" style="display:block">{{ $errors->first('balance') }}</small>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-info btn-fill pull-right">{{ __('Save Account') }}</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        @include('part.profile')
    </div>

</div>
@endsection

@section('after_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
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

        function setCurrency() {
            var currency = $("select[name=currency]").find(':selected').data('symbol');
            $(".currency").text(currency);
        }
        setBalanceInput();
        setCurrency();

        $("select[name=currency_placement]").on('change', function () {
            setBalanceInput();
        })
        $("select[name=currency]").on('change', function () {
            setCurrency();
        })
    });
</script>
@endsection