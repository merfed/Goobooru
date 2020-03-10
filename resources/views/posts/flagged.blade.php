@extends('layouts.no-sidebar')

@section('mini-nav')
@include('partials.mini-nav.posts')
@endsection

@section('content')

@if ($posts->count() > 0)

<div class="warning" style="margin-bottom: 16px;">
    <p style="margin-bottom: 0 !important;">There are <b>{{ $posts->count() }}</b> posts flagged for deletion! It's recommended you review each of these before processing the deletion.</p>
</div>

<table class="tags-table" style="width: 100%; text-align: left">
    <thead>
        <th style="width: 80%;">Image</th>
        <th style="width: 10%;">Created</th>
        <th style="width: 10%;">Action</th>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td><a href="{{ route('post', $post->booru_id) }}">Image</a></td>
            <td>{{ $post->created_at->diffForHumans() }}</td>
            <td>
                <a href="{{ route('allowFlagged', $post) }}" style="margin-right: 6px;">Allow</a>
                <a href="{{ route('deleteFlagged', $post) }}" style="color: #f00;">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $posts->links() }}

@else
<div class="warning">
    <p><b>No posts have been flagged for deletion!</b></p>
    <div class="d-block">This is a good thing, or not. Always been on the lookout for dupes, low effort images and what not.</div>
</div>
@endif

@endsection
