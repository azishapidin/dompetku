@extends('layouts.app')
@section('title', __('Summary'))

@section('before_script')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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

    <div class="row">
        <div class="col-md-6">

            <div class="card">
                <div class="header">
                    <h4 class="title">{{ __('Statistics') }}</h4>
                    <p class="category">{!! __('Statistics from :start to :end', [
                        'start' => '<strong>'.$byDate['from'].'</strong>',
                        'end' => '<strong>'.$byDate['to'].'</strong>',
                    ]) !!}</p>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="well text-center">
                                <small>{{ __('Credit Transaction') }}</small><br>
                                <strong>{{ number_format($byDate['credit']) }}</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="well text-center">
                                <small>{{ __('Debit Transaction') }}</small><br>
                                <strong>{{ number_format($byDate['debit']) }}</strong>
                            </div>
                        </div>

                        <form action="" method="GET">
                            {{-- <div class="col-md-3">
                                <select name="type" class="form-control">
                                    <option value="db">{{ __('Debit') }}</option>
                                    <option value="cr">{{ __('Credit') }}</option>
                                </select>
                            </div> --}}
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="dates">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success">{{ __('Show') }}</button>
                            </div>
                        </form>

                        <div class="col-md-12">

                            <br>
                            <table class="table table-striped">
                                <tr>
                                    <th>{{ __('Category Name') }}</th>
                                    <th>{{ __('Total') }}</th>
                                </tr>
                                @foreach ($byDate['category'] as $category)
                                    <tr>
                                        <td>
                                            {{ $category['name'] }}
                                        </td>
                                        <td>
                                            {{ number_format($category['total']) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">

            <div class="card">
                <div class="header">
                    <h4 class="title">{{ __('Transaction Counter') }}</h4>
                </div>
                <div class="content">
                    {!! $lava->render('PieChart', 'TypeCounter', 'type-counter') !!}
                    <div class="chart">
                        <div id="type-counter"></div>
                    </div>
                    <hr>
                    {!! $lava->render('BarChart', 'CategoryCounter', 'category-counter') !!}
                    <div class="chart">
                        <div id="category-counter" style="height: 500px;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@section('after_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
    $('input[name="dates"]').daterangepicker({
        "startDate": "{{ date("Y-F-d", strtotime($byDate['from'])) }}",
        "endDate": "{{ date("Y-F-d", strtotime($byDate['to'])) }}",
        locale: {
            format: 'YYYY-MMMM-DD'
        }
    });
</script>
@endsection