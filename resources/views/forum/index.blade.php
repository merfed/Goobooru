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
        <div class="forum-top d-flex flex-items-center">
            <div class="flex-auto">
                <div class="thread-pagination">
                    <span class="current">1</span>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <span class="gap">...</span>
                    <a href="#">788</a>
                    <a href="#">789</a>

                    <span class="totals">1-50 of 39,439</span>
                </div>
            </div>

            <a href="{{ route('newThread') }}" class="new-thread">New</a>
        </div>

        <div class="forum-headers d-flex flex-items-center">
            <div class="forum-headers-main">Thread Title &amp; Category</div>
            <div class="forum-headers-starter">Started By</div>
            <div class="forum-headers-last">Last Post</div>
            <div class="forum-headers-replies">Post</div>
        </div>

        @foreach ($threads as $thread)
        <div class="forum-thread d-flex flex-items-center">
            <div class="forum-thread-main">
                <a href="{{ route('forumThread', ['id' => $thread->id]) }}">{{ $thread->title }}</a> <a href="#" class="muted">#</a>
                <div class="more"><a href="{{ route('forumCategory', ['id' => $thread->category->id]) }}">{{ $thread->category->name }}</a></div>
            </div>

            <div class="forum-thread-starter">
                <a href="{{ route('profile', ['id' => $thread->user->id]) }}">{{ $thread->user->name }}</a>
                <div class="more">{{ $thread->created_at->diffForHumans() }}</div>
            </div>

            <div class="forum-thread-last">
                <a href="{{ route('profile', ['id' => $thread->responder->user->id]) }}">{{ $thread->responder->user->name }}</a>
                <div class="more">{{ $thread->responder->created_at->diffForHumans() }}</div>
            </div>

            <div class="forum-thread-replies">
                {{ number_format($thread->comments_count) }}
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
