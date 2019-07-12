@extends('layouts.no-sidebar')

@section('content')
<div class="d-flex">
    <div class="forum-sidebar">
        <div class="threads">
            <h3>Threads</h3>

            <ul class="thread-categories">
                <li><a href="#">Discussions</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Advice</a></li>
                <li><a href="#">Meaningless</a></li>
            </ul>

            <div class="thread-search">
                <input type="text" placeholder="Search thread titles...">
            </div>
        </div>
    </div>

    <div class="forum-main flex-auto">
        <div class="thread">
            <div class="main-title">
                <h3>{{ $thread->title }}</h3>
            </div>

            <div class="forum-top">
                <div class="thread-pagination">
                    1 - 50
                </div>

                <div class="thread-bc">in <a href="{{ route('forum') }}">Threads</a> > <a href="{{ route('forumCategory', ['id' => $thread->category]) }}">{{ $thread->category->name }}</a> > <a href="{{ route('forumThread', ['id' => $thread->id]) }}">{{ $thread->title }}</a></div>
            </div>

            @foreach ($comments as $comment)
            <div class="forum-comment d-flex">
                <div class="forum-comment-sidebar">
                    <a class="username" href="{{ route('profile', ['id' => $comment->user->id]) }}">{{ $comment->user->name }}</a>
                    <div class="when">{{ $comment->created_at->diffForHumans() }}</div>

                    @if ($comment->user->avatar != null)
                    <img width="50" height="50" src="{{ asset(config('goobooru.avatar_upload_path') .'/'. $comment->user->avatar) }}" alt="">
                    @endif
                </div>
                <div class="forum-comment-content flex-auto">
                    {!! $comment->body !!}
                </div>
            </div>
            @endforeach

            <div class="forum-top">
                <div class="thread-pagination">
                    1 - 50
                </div>

                <div class="thread-bc">in <a href="{{ route('forum') }}">Threads</a> > <a href="{{ route('forumCategory', ['id' => $thread->category]) }}">{{ $thread->category->name }}</a> > <a href="{{ route('forumThread', ['id' => $thread->id]) }}">{{ $thread->title }}</a></div>
            </div>

            <div class="mt-4 container-sm">
                <form action="{{ route('reply', ['id' => $thread->id]) }}" method="POST">
                    @csrf

                    <textarea name="body" id="" cols="30" rows="10" class="form-control input-block" placeholder="Remember be nice..."></textarea>

                    <div class="mt-2">
                        <button class="btn btn-primary" type="submit">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
