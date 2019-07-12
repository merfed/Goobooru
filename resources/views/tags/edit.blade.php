@extends('layouts.no-sidebar')

@section('mini-nav')
@include('partials.mini-nav.tags')
@endsection

@section('content')
<div class="container-sm">
    <form action="{{ route('postEditTag', ['tag' => $tag->name]) }}" method="POST">
        @csrf

        <dl class="form-group">
            <dt><label for="old">Original Tag</label></dt>
            <dd><input type="text" class="form-control" name="old" value="{{ $tag->name }}" readonly></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="new">New Tag</label></dt>
            <dd><input type="text" class="form-control" name="name"></dd>
        </dl>

        <div class="mt-2">
            <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </form>
</div>
@endsection
