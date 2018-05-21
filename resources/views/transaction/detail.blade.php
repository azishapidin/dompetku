<div class="well">
    {{ __('Transaction Date') }}: <strong>{{ $transaction->date }}</strong><br>
    {{ __('Transaction Type') }}: <strong>{{ strtoupper($transaction->type) }}</strong><br>
    {{ __('Amount') }}: <strong>{{ $transaction->formattedAmount }}</strong><br>
    {{ __('Balance') }}: <strong>{{ $transaction->formattedBalance }}</strong><br>
    {{ __('Description') }}:<br><strong>{{ $transaction->description }}</strong><br>
    @if($transaction->attachment->count() > 0)
    -----------------------<br>
    @endif
    @foreach($transaction->attachment as $file)
    <a href="{{ $file->url }}" target="_blank">{{ __('Attachment') }} <span class="fa fa-external-link"></span></a><br>
    @endforeach
</div>