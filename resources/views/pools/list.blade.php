@extends('layouts.no-sidebar')

@section('mini-nav')
@include('partials.mini-nav.pools')
@endsection

@section('content')

@if ($pools->count())

@foreach ($pools as $pool)
<div class="d-block py-3" @if (!$loop->first) style="border-top: 1px solid #d5d5d5;" @endif>
    <div class="mb-2">
        @if ($pool->visible)
        <span style="border-radius: 3px; font-size: 12px; color: #fff; background: #00f; padding: 2px 4px;">Public</span>
        @else
        <span style="border-radius: 3px; font-size: 12px; color: #fff; background: #f00; padding: 2px 4px;">Private</span>
        @endif

        <b><a href="{{ route('pool', $pool) }}">{{ $pool->name }}</a> <span style="color: #ccc;">({{ ($pool->posts->count() > 0) ? $pool->posts->count() : 0 }})</span></b>
    </div>

    @if ($pool->description != null)
    <p class="mb-0">{{ $pool->description }}</p>
    @endif
</div>
@endforeach

{{ $pools->links() }}

@else
<div class="warning">
    <p><b>There are no pools!</b></p>
    <div class="d-block">Why not <a href="{{ route('poolsCreate') }}">create</a> a pool to group images that don't have similar tags?</div>
</div>
@endif

@endsection
