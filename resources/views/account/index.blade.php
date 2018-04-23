@extends('layouts.app')
@section('title', __('Account'))

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
                        @foreach($accounts as $key => $account)
                        <tr>
                            <td>
                                <span class="text-muted">{{ $key + 1 }}</span>
                            </td>
                            <td><a href="{{ route('account.show', $account->id) }}">{{ $account->name }}  <span class="fa fa-external-link"></span></a></td>
                            <td><strong>{{ $account->currency }}</strong></td>
                            <td>{{ $account->formattedBalance }}</td>
                            <td class="text-right">
                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm">{{ __('Add Transaction') }}</a>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                                       <i class="fe fe-grid mr-2"></i> {{ __('Actions') }}
                                    </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="{{ route('account.show', $account->id) }}">{{ __('Show Transaction') }}</a>
                                      <a class="dropdown-item" href="{{ route('account.edit', $account->id) }}">{{ __('Edit Account') }}</a>
                                      <a class="dropdown-item" href="#">{{ __('Move to Trash') }}</a>
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