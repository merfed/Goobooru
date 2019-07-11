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

        <b><a href="#">{{ $pool->name }}</a> <span style="color: #ccc;">({{ $pool->posts_count }})</span></b>
    </div>

    @if ($pool->description != null)
    <p class="mb-0">{{ $pool->description }}</p>
    @endif
</div>
@endforeach

@else
NO POOLS
@endif

@endsection
