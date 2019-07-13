@extends('layouts.no-sidebar')

@section('content')

<div class="d-flex">
    <div class="profile-sidebar">
        <h1>{{ $user->name }}</h1>
        <div class="user-class">Member</div>
        <a href="#"><b>Send PM</b></a>

        <div class="user-stats">
            <h5>Statistics</h5>

            <div class="d-flex user-stats-stat">
                <div class="flex-auto user-stat">Joined</div>
                <div class="user-stat-value">{{ $user->created_at->diffForHumans() }}</div>
            </div>

            <div class="d-flex user-stats-stat">
                <div class="flex-auto user-stat">Posts</div>
                <div class="user-stat-value">{{ $user->posts->count() }}</div>
            </div>

            <div class="d-flex user-stats-stat">
                <div class="flex-auto user-stat">Deleted Posts</div>
                <div class="user-stat-value">0</div>
            </div>

            <div class="d-flex user-stats-stat">
                <div class="flex-auto user-stat">Favorites</div>
                <div class="user-stat-value">{{ $user->favs->count() }}</div>
            </div>

            <div class="d-flex user-stats-stat">
                <div class="flex-auto user-stat">Comments</div>
                <div class="user-stat-value">0</div>
            </div>

            <div class="d-flex user-stats-stat">
                <div class="flex-auto user-stat">Forum Posts</div>
                <div class="user-stat-value">
                    <abbr title="Threads">{{ $user->threads->count() }}</abbr> / <abbr title="Replies">{{ $user->replies->count() }}</abbr>
                </div>
            </div>
        </div>
    </div>

    <div class="profile-content flex-auto">
        <div class="section-header">Recent Favorites</div>


        <div class="section-header">Recent Uploads</div>

        <div class="wrapper-masonry content">
            <div id="masonry">
                @foreach ($user->posts as $post)
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
    </div>
</div>

@endsection
