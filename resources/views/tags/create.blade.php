@extends('layouts.no-sidebar')

@section('mini-nav')
@include('partials.mini-nav.tags')
@endsection

@section('content')

<div class="container-sm">
    <form method="POST" action="{{ route('tagsBulkPost') }}">
        @csrf
        <dl class="form-group">
            <dt><label for="tags">Tags</label></dt>
            <dd><textarea class="form-control" name="tags" id="" cols="30" rows="10"></textarea></dd>
        </dl>

        <button class="btn" type="submit">Create</button>
    </form>
</div>

@endsection
