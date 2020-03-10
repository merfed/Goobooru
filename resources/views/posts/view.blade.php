@extends('layouts.default')

@section('mini-nav')
@include('partials.mini-nav.posts')
@endsection

@section('sidebar')

@foreach ($metas as $meta)
@if ($post->$meta()->count() > 0)
<h4 class="mb-2">{{ ($post->$meta()->count() > 1) ? ucfirst($meta) : substr(ucfirst($meta), 0, -1) }}</h4>
<ul style="list-style-type: none;" class="mb-3">
    @foreach ($post->$meta as $tag)
    <li>@include('partials.tag', ['tag' => $tag])</li>
    @endforeach
</ul>
@endif
@endforeach

<h4 class="mb-2">Tags</h4>
<ul style="list-style-type: none;" class="mb-6">
    @foreach ($post->tags as $tag)
    <li>@include('partials.tag', ['tag' => $tag])</li>
    @endforeach
</ul>

<h4 class="mb-2">Statistics</h4>
<ul style="list-style-type: none;" class="mb-6">
    <li><b>ID:</b> {{ $post->id }}</li>
    <li><b>Posted:</b> {{ $post->created_at->diffForHumans() }}</li>
    <li><b>By:</b> {!! ($post->uploader_id == 0) ? '<i>System</i>' : '<a href="'. route('profile', ['id' => $post->uploader->id]) .'">'. $post->uploader->name .'</a>' !!}</li>
    <li><b>Size:</b> {{ $post->width }}x{{ $post->height }}</li>
    <li><b>Source:</b> {{ $post->getSource() }}</li>
    <li><b>Rating:</b> <span class="rating-{{ $post->getRating(true) }}">{{ $post->getRating() }}</span></li>
    <li><b>Score:</b> {{ $post->score }} <a href="#">&#x1F839;</a> <a href="#">&#x1F83B;</a></li>
</ul>

<h4 class="mb-2">Options</h4>
<ul style="list-style-type: none;" class="mb-6">
    @if ($post->locked)
    <li><a href="#" style="color: #f00;">Edit</a></li>
    @else
    <li><a href="{{ route('editPost', $post) }}">Edit</a></li>
    @endif

    <li><a href="{{ asset('uploads/'.$post->image) }}">Original image</a></li>
    <li><a href="{{ route('deletePost', $post) }}">Delete</a></li>
    <li><a href="{{ route('postFlag', ['id' => $post]) }}">{{ ($post->isFlagged()) ? 'Unflag for deletion' : 'Flag for deletion' }}</a></li>
    <li><a href="#">Add note</a></li>
    <li><a href="{{ route('postFav', $post) }}">{{ ($post->isFavorited()) ? 'Remove from Favorites' : 'Favorite' }}</a></li>
    <li><a href="{{ route('poolsAddPost', ['post' => $post->id]) }}">Add to pool</a></li>
    <li><a href="{{ route('postChangeLock', $post) }}">Lock</a></li>
</ul>

@endsection

@section('content')

@if ($post->getFileType() == 'webm')
<video controls loop="true" src="{{ asset('uploads/'.$post->image) }}"></video>
@else
<img src="{{ asset('thumbnails/'.'thumb_'.$post->image) }}" alt="">
@endif

<div class="actions mt-1 mb-3">
    <a href="{{ route('editPost', $post) }}">Edit</a> | <a href="{{ route('postFav', $post) }}">{{ ($post->isFavorited()) ? 'Remove from Favorites' : 'Favorite' }}</a> | <a href="{{ route('postFlag', ['id' => $post]) }}">{{ ($post->isFlagged()) ? 'Unflag' : 'Flag' }}</a>
</div>

<div class="container-sm comments my-3">
    <form action="{{ route('commentOnPost', ['id' => $post->id]) }}" method="POST">
        @csrf
        <div class="d-block" style="margin-bottom: 16px;">
            <textarea name="body" id="" cols="30" rows="10" class="form-control input-block"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Comment</button>
    </form>

    <h3 class="mt-3 mb-2">Comments <span style="color: #aaa">({{ ($post->comments->count() > 0) ? $post->comments->count() : '0' }})</span></h3>

    @if ($post->comments->count() > 0)
    @foreach ($post->comments as $comment)
    <div class="post-comment d-flex">
        <div class="post-comment-sidebar">
            <a class="username" href="{{ route('profile', ['id' => $comment->user->id]) }}">{{ $comment->user->name }}</a>
            <div class="when">{{ $comment->created_at->diffForHumans() }}</div>

            @if ($comment->user->avatar != null)
            <img width="50" height="50" src="{{ asset(config('goobooru.avatar_upload_path') .'/'. $comment->user->avatar) }}" alt="">
            @endif
        </div>
        <div class="post-comment-content flex-auto">
            {!! $comment->body !!}
        </div>
    </div>
    @endforeach
    @endif

</div>

@endsection
