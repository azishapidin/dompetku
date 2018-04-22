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
                            <th class="w-1">No.</th>
                            <th>Name</th>
                            <th>Currency</th>
                            <th>Balance</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accounts as $key => $account)
                        <tr>
                            <td>
                                <span class="text-muted">{{ $key + 1 }}</span>
                            </td>
                            <td>{{ $account->name }}</td>
                            <td><strong>{{ $account->currency }}</strong></td>
                            <td>{{ $account->formattedBalance }}</td>
                            <td class="text-right">
                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Show Transaction</a>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                </div>
                            </td>
                            <td>
                                <a class="icon" href="javascript:void(0)">
                                    <i class="fe fe-folder-plus"></i>
                                </a>
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