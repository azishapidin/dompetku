@extends('layouts.app')
@section('title', __('Transaction Category'))

@section('before_script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div style="margin-bottom: 10px;">
            <a href="{{ route('category.create') }}">
                <button class="btn btn-success btn-fill">{{ __('Create Transaction Category') }}</button>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th class="w-1">#</th>
                            <th>{{ __('Category Name') }}</th>
                            <th>{{ __('Parent') }}</th>
                            <th>{{ __('Transactions Count') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($categories->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">{{ __('No data found') }}</td>
                        </tr>
                        @endif
                        @foreach($categories as $key => $category)
                        <tr>
                            <td>
                                <span class="text-muted">{{ $key + 1 }}</span>
                            </td>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                @if(!is_null($category->parent))
                                {{ $category->parent->name }}
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                {{ $category->transactions()->count() }}
                            </td>
                            <td class="text-right">
                                <a class="btn btn-fill btn-info btn-secondary btn-sm" href="{{ route('category.edit', $category->id) }}">{{ __('Edit Category') }}</a>
                                <a class="btn btn-fill btn-danger btn-secondary btn-sm delete-permanent">
                                    {{ __('Delete') }}
                                    <form id="delete-{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:none">
                                        {{ method_field('delete') }} {{ csrf_field() }}
                                    </form>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $categories->links('vendor.pagination.bootstrap-4') }}
    </div>
    <div class="col-md-4">
        @include('part.profile')
    </div>
</div>
@endsection

@section('after_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
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