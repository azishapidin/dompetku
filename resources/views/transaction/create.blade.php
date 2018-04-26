@extends('layouts.app')
@section('title', __('Add Transaction'))

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            {{ __('Add Transaction') }}
        </h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            @include('part.profile')
        </div>
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('account.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">{{ __("Add :account Transaction", ['account' => $account->name]) }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Transaction Type') }}</label>
                                    <select name="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}">
                                        <option value="before" @if( 'cr' == old( 'type')) selected @endif>{{ __('Credit/Income') }}</option>
                                        <option value="after" @if( 'db' == old( 'type')) selected @endif>{{ __('Debit/Expense') }}</option>
                                    </select>
                                    @if ($errors->has('type'))
                                    <small class="invalid-feedback">{{ $errors->first('type') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Amount') }}</label>
                                    <input class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" placeholder="{{ __('Amount') }}.." type="number"
                                        value="{{ old('amount') }}"> @if ($errors->has('amount'))
                                    <small class="invalid-feedback">{{ $errors->first('amount') }}</small>
                                    @endif
                                </div>
                            </div>

                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">{{ __('Memo') }}</label>
                            <textarea name="description" class="form-control" placeholder="{{ __('Insert transaction memo') }}..">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                            <small class="invalid-feedback">{{ $errors->first('description') }}</small>
                            @endif
                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <button href="javascript:void(0)" type="reset" class="btn btn-link">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary ml-auto">{{ __('Save Transaction') }}</button>
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
        
    });
</script>
@endsection