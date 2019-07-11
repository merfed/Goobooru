@extends('layouts.default')

@section('mini-nav')
@include('partials.mini-nav.posts')
@endsection

@section('sidebar')

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
    <li><b>By:</b> someone</li>
    <li><b>Source:</b> {{ $post->source }}</li>
    <li><b>Rating:</b> {{ $post->getRating() }}</li>
    <li><b>Score:</b> {{ $post->score }}</li>
</ul>

<h4 class="mb-2">Options</h4>
<ul style="list-style-type: none;" class="mb-6">
    <li><a href="#">Edit</a></li>
    <li><a href="#">Original image</a></li>
    <li><a href="#">Delete</a></li>
    <li><a href="#">Flag for deletion</a></li>
    <li><a href="#">Add note</a></li>
    <li><a href="#">Add to favorites</a></li>
    <li><a href="#">Add to pool</a></li>
    <li><a href="#">Lock</a></li>
</ul>

@endsection

@section('content')

<img src="{{ asset('uploads/'.$post->image) }}" alt="">

<div class="actions" style="margin: 16px 0;">
    <a href="#">Edit</a> | <a href="#">Favorite</a> | <a href="#">Flag</a>
</div>

<div class="container-sm comments" style="margin: 30px 0;">
    <form>
        <div class="d-block" style="margin-bottom: 16px;">
            <textarea name="comment" id="" cols="30" rows="10" class="form-control input-block"></textarea>
        </div>
        <button class="btn" type="submit">Comment</button>
    </form>

    <h3 style="margin: 30px 0 20px 0;">Comments</h3>
</div>

@endsection
