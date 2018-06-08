@extends('layouts.app')
@section('title', __('Account'))

@section('before_script')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<style>
    .account-type button {
        margin-top: 5px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="account-type" style="margin-bottom: 10px;">
            <a href="{{ route('account.create') }}">
                <button class="btn btn-success btn-fill">{{ __('Create Account') }}</button>
            </a>
            <a href="{{ route('account.index') }}">
                <button class="btn @if(!$showDeleted)  btn-fill btn-primary disabled @endif" @if(!$showDeleted) disabled @endif>{{ __('Show Active Account') }}</button>
            </a>
            <a href="{{ route('account.index', [
                'show' => 'trash'
            ]) }}">
                <button class="btn @if($showDeleted) btn-fill btn-primary disabled @endif" @if($showDeleted) disabled @endif>{{ __('Show Trash') }}</button>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th class="w-1">#</th>
                            <th></th>
                            <th>{{ __('Account Name') }}</th>
                            <th>{{ __('Currency') }}</th>
                            <th>{{ __('Balance') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($accounts->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">{{ __('No data found') }}</td>
                        </tr>
                        @endif @foreach($accounts as $key => $account)
                        <tr>
                            <td>
                                <span class="text-muted">{{ $key + 1 }}</span>
                            </td>
                            <td>
                                @if(!is_null($account->image))
                                <img src="{{ asset('storage/' . $account->image) }}" style="max-width: 100px; max-height: 30px;" alt="Logo">
                                @else
                                <i class="pe-7s-wallet"></i>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('account.show', $account->id) }}">{{ $account->name }}
                                    <span class="fa fa-external-link"></span>
                                </a>
                            </td>
                            <td>
                                <strong>{{ $account->currency }}</strong>
                            </td>
                            <td>{{ $account->formattedBalance }}</td>
                            <td class="text-right">
                                @if (is_null($account->deleted_at))
                                    <a href="{{ route('transaction.create', $account->id) }}" class="btn btn-fill btn-success btn-secondary btn-sm">{{ __('Add Transaction') }}</a>
                                @endif
                                @if (!is_null($account->deleted_at))
                                <a class="btn btn-fill btn-primary btn-secondary btn-sm" href="{{ route('account.restore', $account->id) }}">{{ __('Restore Account') }}</a>
                                <a class="btn btn-fill btn-danger btn-secondary btn-sm delete-permanent">
                                    {{ __('Delete Permanently') }}
                                    <form id="delete-{{ $account->id }}" action="{{ route('account.deletePermanent', $account->id) }}" method="POST" style="display:none">
                                        {{ method_field('delete') }} {{ csrf_field() }}
                                    </form>
                                </a>
                                @endif
                                @if (is_null($account->deleted_at))
                                <a class="btn btn-fill btn-primary btn-secondary btn-sm" href="{{ route('account.show', $account->id) }}">{{ __('Show Transaction') }}</a>
                                <a class="btn btn-fill btn-info btn-secondary btn-sm" href="{{ route('account.edit', $account->id) }}">{{ __('Edit Account') }}</a>
                                <a class="btn btn-fill btn-danger btn-secondary btn-sm delete">
                                    {{ __('Move to Trash') }}
                                    <form id="delete-{{ $account->id }}" action="{{ route('account.destroy', $account->id) }}" method="POST" style="display:none">
                                        {{ method_field('delete') }} {{ csrf_field() }}
                                    </form>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection

@section('after_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
    $('.delete').on('click', function () {
        var form = $(this).find('form');
        swal({
            title: '{{ __("Are you sure?") }}',
            text: '{{ __("Account will be moved to Trash") }}.',
            html: true,
            confirmButtonColor: '#d9534f',
            showCancelButton: true,
        }, function () {
            form.submit();
        });
        return false;
    });

    $('.delete-permanent').on('click', function () {
        var form = $(this).find('form');
        swal({
            title: '{{ __("Are you sure?") }}',
            text: '{{ __("Account will be permanently deleted") }}.',
            html: true,
            confirmButtonColor: '#d9534f',
            showCancelButton: true,
        }, function () {
            form.submit();
        });
        return false;
    });
</script>
@endsection