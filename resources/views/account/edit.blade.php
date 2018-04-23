@extends('layouts.app')
@section('title', __('Edit Account'))

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            {{ __('Edit Account') }}
        </h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            @include('part.profile')
        </div>
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('account.update', $account->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-header">
                        <h3 class="card-title">{{ __("Account Information") }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">{{ __('Account Name') }}</label>
                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="{{ __('Account Name') }} .." type="text"
                                value="{{ $account->name }}"> @if ($errors->has('name'))
                            <small class="invalid-feedback">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('Account Image/Icon') }}</label>
                            <input name="image" type="file">
                            <br> @if ($errors->has('image'))
                            <small class="invalid-feedback">{{ $errors->first('image') }}</small>
                            @else
                            <small class="text-info">{{ __('Empty if you do not want to change') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('Currency') }}</label>
                            <select name="currency" class="form-control{{ $errors->has('currency') ? ' is-invalid' : '' }}">
                                @foreach ($currencies as $code => $currency)
                                <option value="{{ $code }}" data-symbol="{{ $currency['symbol'] }}" @if($code == $account->currency) selected @endif>{{ $currency['name'] }} ({{ $currency['symbol'] }})</option>
                                @endforeach
                            </select>
                            @if ($errors->has('currency'))
                            <small class="invalid-feedback">{{ $errors->first('currency') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('Currency symbol placement') }}</label>
                            <select name="currency_placement" class="form-control{{ $errors->has('currency_placement') ? ' is-invalid' : '' }}">
                                <option value="before" @if( 'before' == $account->currency) selected @endif>{{ __('Before the Number') }}</option>
                                <option value="after" @if( 'after' == $account->currency) selected @endif>{{ __('After the Number') }}</option>
                            </select>
                            @if ($errors->has('currency_placement'))
                            <small class="invalid-feedback">{{ $errors->first('currency_placement') }}</small>
                            @endif
                        </div>


                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <button href="javascript:void(0)" type="reset" class="btn btn-link">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary ml-auto">{{ __('Save Account') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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