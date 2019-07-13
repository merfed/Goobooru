@extends('layouts.no-sidebar')

@section('content')
<p>User comments are <b>mostly</b> unmoderated. Howerver, we request that you do not spam our site with useless comments or advertisments for other sites. If it does not contribute at all it will result in you getting a ban from contributing to our site. We take the internet cereally. If you are unsure what type of comment is appropriate, you may view our wiki on <a href="#">how to comment</a>.</p>

@foreach ($comments as $comment)
<div class="recent-comment d-flex">
    <div class="recent-comment-image d-flex">
        @if ($comment->post->getFileType() == 'webm')
        <video controls loop="true" src="{{ asset('uploads/'.$comment->post->image) }}"></video>
        @else
        <img src="{{ asset('uploads/'.$comment->post->image) }}" alt="">
        @endif
    </div>

    <div class="recent-comment-content flex-auto">
        <div class="recent-comment-meta">
            <b>When:</b> {{ $comment->post->created_at->diffForHumans() }}
            <span class="ml-2">
                <b>Who:</b> <a href="{{ route('profile', ['id' => $comment->post->uploader->id]) }}">{{ $comment->post->uploader->name }}</a>
            </span>
            <span class="ml-2">
                <b>Rating:</b> <span class="rating-{{ $comment->post->getRating(true) }}">{{ $comment->post->getRating() }}</span>
            </span>
            <span class="ml-2">
                <b>Score:</b> {{ $comment->post->score }}
            </span>
        </div>
        <div class="d-block">
            <b>Tags:</b>
            @foreach ($comment->post->allTags as $tag)
            @if (!$loop->last)
            <a href="{{ route('tagPosts', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>,
            @else
            <a href="{{ route('tagPosts', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>
            @endif
            @endforeach
        </div>

        <div class="mt-2 post-comment d-flex">
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
    </div>
</div>
@endforeach

{{ $comments->links() }}

@endsection
