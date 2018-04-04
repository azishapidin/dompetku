@extends('layouts.master') @section('title') @yield('title') @endsection

@section('body')
<div class="page">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    @yield('content')
                    <div class="text-center text-muted" style="margin-top: 20px;">
                        @php $no = 0; @endphp
                        @foreach (config('languages') as $lang => $language)
                            @php
                            $no++;
                            @endphp
                            @if ($lang != App::getLocale())
                                <a href="{{ route('lang.switch', $lang) }}">{{ $language }}</a>
                            @else
                                {{ $language }}
                            @endif
                            @if ($no != count(config('languages')))
                            &sdot;
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection