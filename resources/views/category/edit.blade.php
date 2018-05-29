@extends('layouts.app')
@section('title', __('Edit Category'))

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ __("Edit Transaction Category") }}</h4>
            </div>
            <div class="content">
                <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Category Name') }}</label>
                                <input class="form-control{{ $errors->has('name') ? ' has-error' : '' }}" name="name" placeholder="{{ __('Category Name') }}.." type="text"
                                    value="{{ $category->name }}"> @if ($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Parent Category') }}</label>
                                <select name="parent_id" class="form-control{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                                    <option value="">-- {{ __('Select Parent') }} --</option>
                                    @foreach ($categories as $option)
                                    @if ($option->id == $category->id)
                                        @continue
                                    @endif
                                    <option value="{{ $option->id }}" @if($category->parent_id == $option->id) selected @endif>{{ $option->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('parent_id'))
                                <small class="text-danger">{{ $errors->first('parent_id') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Show on Statistics') }}</label>
                                <select name="show_on_stats" class="form-control{{ $errors->has('show_on_stats') ? ' has-error' : '' }}">
                                    <option value="1" @if($category->show_on_stats == 1) selected @endif>{{ __('Show') }}</option>
                                    <option value="0" @if($category->show_on_stats == 0) selected @endif>{{ __('Hide') }}</option>
                                </select>
                                @if ($errors->has('show_on_stats'))
                                <small class="text-danger">{{ $errors->first('show_on_stats') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info btn-fill pull-right">{{ __('Save Category') }}</button>
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
<script>

</script>
@endsection