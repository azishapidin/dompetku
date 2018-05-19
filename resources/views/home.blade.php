@extends('layouts.app')
@section('title', __('Summary'))

@section('before_script')
<style>
    .d-flex div {
        padding: 2px 10px;
    }
</style>
@endsection

@section('content')
<div class="">
    <div class="row row-cards">

        <!-- First row -->
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                        <i class="fe fe-credit-card"></i>
                    </span>
                    <div>
                        <h4 class="m-0">
                            <a href="javascript:void(0)">
                                <span class="counter">{{ $account_count }}</span>
                                <small>{{ __('Accounts') }}</small>
                            </a>
                        </h4>
                        <small class="text-muted">{{ __("Number of accounts") }}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3">
                        <i class="fe fe-database"></i>
                    </span>
                    <div>
                        <h4 class="m-0">
                            <a href="javascript:void(0)">
                                <span class="counter">{{ $transaction_count }}</span>
                                <small>{{ __('Transaction') }}</small>
                            </a>
                        </h4>
                        <small class="text-muted">{{ __("Number of transactions") }}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                        <i class="fe fe-upload"></i>
                    </span>
                    <div>
                        <h4 class="m-0">
                            <a href="javascript:void(0)">
                                <span class="counter">{{ $debit_count }}</span>
                                <small>{{ __('Debit Data') }}</small>
                            </a>
                        </h4>
                        <small class="text-muted">{{ __("Number of debit transactions") }}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue-light mr-3">
                        <i class="fe fe-download"></i>
                    </span>
                    <div>
                        <h4 class="m-0">
                            <a href="javascript:void(0)">
                                <span class="counter">{{ $credit_count }}</span>
                                <small>{{ __('Credit Data') }}</small>
                            </a>
                        </h4>
                        <small class="text-muted">{{ __("Number of credit transactions") }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('after_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
<script>
    $('.counter').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 1500,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
</script>
@endsection