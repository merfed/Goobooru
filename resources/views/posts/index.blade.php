@extends('layouts.default')

@section('mini-nav')
@include('partials.mini-nav.posts')
@endsection

@section('sidebar')
<div style="margin-bottom: 8px;"><b>Tags</b></div>

<ul class="sidebar-tags">
    @foreach ($tags as $tag)
    <li>@include('partials.tag', ['tag' => $tag])</li>
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
