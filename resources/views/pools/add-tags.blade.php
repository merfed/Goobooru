@extends('layouts.no-sidebar')

@section('mini-nav')
@include('partials.mini-nav.pools')
@endsection

@section('content')
<div class="container-sm">
    <form action="{{ route('poolsPostBulkAddTags') }}" method="POST">
        @csrf

        <dl class="form-group">
            <dt><label for="pool">Pool</label></dt>
            <dd>
                <select name="pool" id="" class="form-control">
                    <option value="" selected>Choose a pool</option>
                    @foreach ($pools as $pool)
                    <option value="{{ $pool->id }}">{{ $pool->name }}</option>
                    @endforeach
                </select>
            </dd>
        </dl>

        <dl class="form-group">
            <dt><label for="posts">Tags</label></dt>
            <dd><textarea name="tags" id="" cols="30" rows="10" class="form-control"></textarea></dd>
        </dl>

        <button class="btn" type="submit">Add</button>
    </form>
</div>

@endsection
