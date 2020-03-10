@extends('layouts.no-sidebar')

@section('mini-nav')
@include('partials.mini-nav.pools')
@endsection

@section('content')

<div class="container-sm">
    <form action="{{ route('updatePool', $pool) }}" method="POST">
        @csrf

        <dl class="form-group">
            <dt><label for="name">Name</label></dt>
            <dd><input type="text" class="form-control" name="name" value="{{ $pool->name }}"></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="description">Description</label></dt>
            <dd><textarea name="description" id="" cols="30" rows="10" class="form-control">{{ $pool->description }}</textarea></dd>
        </dl>

        <div class="form-checkbox">
            <label>
                <input type="radio" name="visible" value="1" @if ($pool->visible) checked @endif> Public
            </label>
        </div>

        <div class="form-checkbox">
            <label>
                <input type="radio" name="visible" value="0" @if (!$pool->visible) checked @endif> Private
            </label>
        </div>

        <button class="btn" type="submit">Create</button>
    </form>
</div>

@endsection
