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
            @if ($post->getFileType() == 'webm')
            <video controls loop="true" src="{{ asset('uploads/'.$post->image) }}"></video>
            @else
            <img src="{{ asset('uploads/'.$post->image) }}" alt="">
            @endif
        </a>
        @endforeach
    </div>
</div>

{{ $posts->links() }}
@endsection
