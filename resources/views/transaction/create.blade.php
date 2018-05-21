@extends('layouts.app')
@section('title', __('Add Transaction'))

@section('before_script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ __('Add Transaction') }}</h4>
            </div>
            <div class="content">
                    <form action="{{ route('transaction.store', $account->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Transaction Type') }}</label>
                                <select name="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}">
                                    <option value="cr" @if( 'cr' == old( 'type')) selected @endif>{{ __('Credit/Income') }}</option>
                                    <option value="db" @if( 'db' == old( 'type')) selected @endif>{{ __('Debit/Expense') }}</option>
                                </select>
                                @if ($errors->has('type'))
                                <small class="text-danger">{{ $errors->first('type') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Amount') }}</label>
                                <input class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" placeholder="{{ __('Amount') }}.." type="number"
                                    value="{{ old('amount') }}"> @if ($errors->has('amount'))
                                <small class="text-danger">{{ $errors->first('amount') }}</small>
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
                            <div class="form-group">
                                <div class="form-label">{{ __('Transaction Attachment') }}</div>
                                @for ($input = 1; $input <= config('transaction.max_attachment'); $input++)
                                    <div class="custom-file" style="margin-bottom: 10px;">
                                        <input name="attachment[]" type="file">
                                    </div>
                                @endfor
                                @if ($errors->has('attachment.*'))
                                <small class="text-danger">{{ $errors->first('attachment.*') }}</small>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.js"></script>
<script>
    $(document).ready(function () {
        $('input[name=date]').datepicker({
            language: "en",
            dateFormat: "yyyy-mm-dd"
        });
    });
</script>
@endsection