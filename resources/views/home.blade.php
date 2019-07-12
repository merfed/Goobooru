@extends('layouts.landing')

@section('content')
<div class="landing">
    <h1><a href="{{ route('landing') }}">Goobooru</a></h1>

    <div class="landing-nav">
        <a href="{{ route('posts') }}"><b>Posts</b></a>
        <a href="#">Comments</a>
        <a href="{{ route('forum') }}">Forum</a>
        <a href="#">Wiki</a>
        <a href="#">My Account</a>
        <a href="#">»</a>
    </div>

    <div class="landing-search">
        <input type="text">
    </div>

    <div class="mt-2 landing-counter">
        @if (config('goobooru.counter_type') == 'text')
            @if (config('goobooru.counter_style') == 'normal')
            {{ $count }}
            @else
                @foreach ($split_count as $i)
                <span style="color: {{ $rainbow[$i] }}; margin-right: -10px;">{{ $i }}</span>
                @endforeach
            @endif
        @else
            @foreach ($split_count as $i)
            <img src="{{ asset('/imgs/dudes/'. config('goobooru.counter_style') .'-'. $i .'.png') }}" alt="">
            @endforeach
        @endif
    </div>
</div>
@endsection
