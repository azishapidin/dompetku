@extends('layouts.app')
@section('title', __('All Transaction'))

@section('before_script')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th class="w-1">#</th>
                            <th></th>
                            <th>{{ __('Transaction Date') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($transactions->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">{{ __('No data found') }}</td>
                        </tr>
                        @endif
                        @php $no = 1; @endphp
                        @foreach($transactions as $key => $transaction)
                        <tr>
                            <td>{{ ($transactions->currentPage() - 1) * $transactions->perPage() + ($no + $key) }}</td>
                            <td>
                                @if(!is_null($transaction->account->image))
                                <img src="{{ asset('storage/' . $transaction->account->image) }}" style="max-width: 100px; max-height: 30px;" alt="{{ $transaction->account->name }}" title="{{ $transaction->account->name }}">
                                @else
                                <i class="pe-7s-wallet"></i>
                                @endif
                            </td>
                            <td>
                                {{ $transaction->date }}
                            </td>
                            <td>
                                @if($transaction->type == 'cr')
                                <span class="text-success">{{ $transaction->formattedAmount }}</span>
                                @endif
                                @if($transaction->type == 'db')
                                <span class="text-danger">- {{ $transaction->formattedAmount }}</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $transaction->excerpt }}</small>
                            </td>
                            <td>                                
                                <!-- Link to open the modal -->
                                <button class="btn btn-default btn-sm open-detail" data-id="{{ $transaction->id }}"> <span class="fa fa-eye"></span> {{ __("Detail") }}</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ $transactions->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @include('part.profile')
    </div>
</div>
<div id="dialog" title="{{ __('Transaction Detail') }}"></div>
@endsection

@section('after_script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$('.open-detail').on('click', function(){
    var id = $(this).attr('data-id');
    $.ajax({
		url: '{{ url('') }}/transaction/'+id+'/detail',
		type: "GET",
		success:function(response)
		{
            $('#dialog').html('');
            $('#dialog').html(response);
            $("#dialog").dialog();
		}
	});
});
</script>
@endsection