@extends('layouts.landing')

@section('content')
<div class="landing">
    <h1><a href="{{ route('landing') }}">Goobooru</a></h1>

    <div class="landing-nav">
        <a href="{{ route('posts') }}"><b>Posts</b></a>
        <a href="#">Comments</a>
        <a href="#">Forum</a>
        <a href="#">Wiki</a>
        <a href="#">My Account</a>
        <a href="#">»</a>
    </div>

    <div class="landing-search">
        <input type="text">
    </div>

    <div class="mt-2 landing-counter">
        {{ $count }}
    </div>
</div>
@endsection
