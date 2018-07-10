@extends('layouts.app')
@section('title', __('Transfer Money'))

@section('before_script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ __('Transfer Money to Another Account') }}</h4>
            </div>
            <div class="content">
                    <form action="{{ route('account.transfer.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('From') }}</label>
                            <select name="from" class="form-control{{ $errors->has('from') ? ' is-invalid' : '' }}">
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('from'))
                            <small class="text-danger">{{ $errors->first('from') }}</small>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('To') }}</label>
                            <select name="to" class="form-control{{ $errors->has('to') ? ' is-invalid' : '' }}">
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('to'))
                            <small class="text-danger">{{ $errors->first('to') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Amount') }}</label>
                                <input class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" placeholder="{{ __('Amount') }}.." type="number"
                                    value="{{ old('amount') }}"> @if ($errors->has('amount'))
                                <small class="text-danger">{{ $errors->first('amount') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Transaction Category') }}</label>
                                <select name="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}">
                                    <option value=""- {{ __('Select Category') }} --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                <small class="text-danger">{{ $errors->first('category_id') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label">{{ __('Date') }}</label>
                                <input class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" placeholder="{{ __('Transaction Date') }}.." type="text"
                                    value="{{ old('date') }}"> @if ($errors->has('date'))
                                <small class="text-danger">{{ $errors->first('date') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label class="form-label">{{ __('Memo') }}</label>
                                <textarea name="description" class="form-control" placeholder="{{ __('Insert transaction memo') }}.." rows="5">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                <small class="text-danger">{{ $errors->first('description') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info btn-fill pull-right">{{ __('Save Transaction') }}</button>
                    <div class="clearfix"></div>
                {{-- </form> --}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/en.js"></script>
<script>
    $(document).ready(function () {
        $('input[name=date]').datepicker({
            language: "en",
            dateFormat: "yyyy-mm-dd"
        });
        $('select[name=category_id]').select2();
    });
</script>
@endsection