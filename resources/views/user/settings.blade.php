@extends('layouts.no-sidebar')

@section('content')
<div class="container-sm">
    <h4>Avatar</h4>

    @if (Auth::user()->avatar != null)
    <img src="{{ asset(config('goobooru.avatar_upload_path') .'/'. Auth::user()->avatar) }}" alt="">
    @endif

    <form action="{{ route('postAvatar') }}" method="POST" enctype="multipart/form-data" files="true">
        @csrf

        <div class="form-group">
            <input type="file" name="avatar" class="form-control">
        </div>

        <button class="btn btn-primary" type="submit">Upload</button>
    </form>
</div>
@endsection
