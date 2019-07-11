@extends('layouts.default')

@section('mini-nav')
@include('partials.mini-nav.posts')
@endsection

@section('sidebar')
<div style="margin-bottom: 8px;"><b>Tags</b></div>

<ul class="sidebar-tags">
    @foreach ($tags as $tag)
    <li>
        <a href="#" style="margin-right: 4px;">?</a>
        <a href="#">{{ $tag->name }}</a>
        <span style="color: #ccc;">{{ number_format($tag->posts_count) }}</span>
    </li>
    @endforeach
</ul>
@endsection

@section('content')
<div class="wrapper-masonry content">
    <div id="masonry">
        @foreach ($posts as $post)
        <a href="{{ route('post', ['id' => $post->id]) }}" class="image">
            <img src="{{ asset('uploads/'.$post->image) }}" alt="">
        </a>
        @endforeach
    </div>
</div>

{{ $posts->links() }}
@endsection
