@extends('layouts.app')
@section('title', __('Account'))

@section('before_script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            {{ __('Account') }}
        </h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            @include('part.profile')
        </div>
        <div class="col-md-8">
            <div class="account-type" style="margin-bottom: 10px;">
                <a href="{{ route('account.create') }}"><button class="btn btn-success">{{ __('Create Account') }}</button></a>
                <a href="{{ route('account.index') }}"><button class="btn @if(!$showDeleted) btn-primary disabled @endif" @if(!$showDeleted) disabled @endif>{{ __('Show Active Account') }}</button></a>
                <a href="{{ route('account.index', [
                    'show' => 'trash'
                ]) }}"><button class="btn @if($showDeleted) btn-primary disabled @endif" @if($showDeleted) disabled @endif>{{ __('Show Trash') }}</button></a>
            </div>

            <div class="card">
                {{-- Table --}}
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th class="w-1">#</th>
                            <th>{{ __('Account Name') }}</th>
                            <th>{{ __('Currency') }}</th>
                            <th>{{ __('Balance') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($accounts->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">{{ __('No data found') }}</td>
                        </tr>
                        @endif
                        @foreach($accounts as $key => $account)
                        <tr>
                            <td>
                                <span class="text-muted">{{ $key + 1 }}</span>
                            </td>
                            <td><a href="{{ route('account.show', $account->id) }}">{{ $account->name }}  <span class="fa fa-external-link"></span></a></td>
                            <td><strong>{{ $account->currency }}</strong></td>
                            <td>{{ $account->formattedBalance }}</td>
                            <td class="text-right">
                                @if (is_null($account->deleted_at))
                                <a href="{{ route('transaction.create', $account->id) }}" class="btn btn-secondary btn-sm">{{ __('Add Transaction') }}</a>
                                @endif
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                                       <i class="fe fe-grid mr-2"></i> {{ __('Actions') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        @if (!is_null($account->deleted_at))
                                            <a class="dropdown-item" href="{{ route('account.restore', $account->id) }}">{{ __('Restore Account') }}</a>
                                            <a class="dropdown-item delete-permanent">
                                                {{ __('Delete Permanently') }}
                                                <form id="delete-{{ $account->id }}" action="{{ route('account.deletePermanent', $account->id) }}" method="POST" style="display:none">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                </form>
                                            </a>   
                                        @endif
                                        @if (is_null($account->deleted_at))
                                            <a class="dropdown-item" href="{{ route('account.show', $account->id) }}">{{ __('Show Transaction') }}</a>
                                            <a class="dropdown-item" href="{{ route('account.edit', $account->id) }}">{{ __('Edit Account') }}</a>
                                            <a class="dropdown-item delete">
                                                {{ __('Move to Trash') }}
                                                <form id="delete-{{ $account->id }}" action="{{ route('account.destroy', $account->id) }}" method="POST" style="display:none">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                </form>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- Table --}}
            </div>
        </div>
    </div>

</div>
@endsection

@section('after_script')
<script
	src="https://code.jquery.com/jquery-2.2.4.min.js"
	integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
	crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
$('.delete').on('click',function(){
    var form = $(this).find('form');
    swal({
        title: '{{ __("Are you sure?") }}',
        text: '{{ __("Account will be moved to Trash") }}.',
        html: true,
        confirmButtonColor: '#d9534f',
        showCancelButton: true,
    },function(){
        form.submit();
    });
    return false;
});

$('.delete-permanent').on('click',function(){
    var form = $(this).find('form');
    swal({
        title: '{{ __("Are you sure?") }}',
        text: '{{ __("Account will be permanently deleted") }}.',
        html: true,
        confirmButtonColor: '#d9534f',
        showCancelButton: true,
    },function(){
        form.submit();
    });
    return false;
});
</script>
@endsection