@extends('layouts.no-sidebar')

@section('mini-nav')
@include('partials.mini-nav.pools')
@endsection

@section('content')

<div class="d-flex">
    <div class="flex-auto">
        <h2 class="mb-4">{{ $pool->name }} <span style="color: #ccc;">({{ ($pool->posts->count() > 0) ? $pool->posts->count() : 0 }})</span></h2>
    </div>

    <a href="{{ route('editPool', $pool) }}" class="mr-2">Edit</a>
    <a href="{{ route('deletePool', $pool) }}" style="color: #f00">Delete</a>
</div>

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
<div class="warning">
    <p><b>No posts exist!</b></p>
    <div class="d-block">You can help out by uploading an image.</div>
</div>
@endif

@endsection
