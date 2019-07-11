@extends('layouts.no-sidebar')

@section('mini-nav')
@include('partials.mini-nav.posts')
@endsection

@section('content')

<h3 class="mb-3">Queue has {{ $posts->total() }} posts</h3>

@foreach ($posts as $post)
<div class="d-flex queue-post">
    <div class="queue-post-image d-flex flex-items-center flex-justify-center mr-4">
        @if ($post->getFileType() == 'webm')
        <video controls loop="true" src="{{ asset('uploads/'.$post->image) }}"></video>
        @else
        <img src="{{ asset('uploads/'.$post->image) }}" alt="">
        @endif
    </div>

    <div class="queue-post-metadata">
        <form action="{{ route('processQueue', ['id' => $post->id]) }}" method="POST">
            @csrf
            <dl class="form-group">
                <dt><label for="tags">Tags</label></dt>
                <dd><textarea class="form-control" name="tags" id="" cols="30" rows="10"></textarea></dd>
            </dl>

            <div class="d-flex">
                <div class="form-checkbox"><input type="radio" name="rating" value="1"> Safe</div>
                <div class="form-checkbox"><input type="radio" name="rating" value="2"> Questionable</div>
                <div class="form-checkbox"><input type="radio" name="rating" value="3"> Explicit</div>
            </div>

            <button class="btn" type="submit">Update</button>
        </form>
    </div>
</div>
@endforeach

{{ $posts->links() }}

@endsection
