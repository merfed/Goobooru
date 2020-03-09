@extends('layouts.default')

@section('mini-nav')
@include('partials.mini-nav.posts')
@endsection

@section('sidebar')
<div style="margin-bottom: 8px;"><b>Tags</b></div>

@if ($tags->count())
<ul class="sidebar-tags">
    @foreach ($tags as $tag)
    <li>@include('partials.tag', ['tag' => $tag])</li>
    @endforeach
</ul>
@else
<small><i>No tags...</i></small>
@endif
@endsection

@section('content')
@if ($posts->count())
<div class="wrapper-masonry content">
    <div id="masonry">
        @foreach ($posts as $post)
        <a href="{{ route('post', ['id' => $post->id]) }}" class="image">
            @if ($post->getFileType() == 'webm')
            <video controls loop="true" src="{{ asset('thumbnails/'.'thumb_'. $post->image) }}"></video>
            @else
            <img src="{{ asset('uploads/'.$post->image) }}" alt="">
            @endif
        </a>
        @endforeach
    </div>
</div>

{{ $posts->links() }}
@else
<div style="border: 1px solid rgba(0, 0, 0, 0.2); background: #ffe2c2; padding: 16px;">
    <p><b>No posts exist!</b></p>
    <div class="d-block">You can help out by uploading an image.</div>
</div>
@endif
@endsection
