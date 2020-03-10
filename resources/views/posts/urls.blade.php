@extends('layouts.no-sidebar')

@section('mini-nav')
@include('partials.mini-nav.posts')
@endsection

@section('content')

@if ($urls->count() > 0)

<div style="border: 1px solid rgba(0, 0, 0, 0.2); background: #ffe2c2; padding: 16px; margin-bottom: 16px;">
    <p style="margin-bottom: 0 !important;">There are <b>{{ $urls->count() }}</b> urls! Sources are provided when an image is uploaded. Deleting an image, deletes the associated source.</p>
</div>

<table class="tags-table" style="width: 100%; text-align: left;">
    <thead>
        <th style="width: 80%;">Source</th>
        <th style="width: 10%;">Image</th>
        <th style="width: 10%;">Created</th>
    </thead>
    <tbody>
        @foreach ($urls as $url)
        <tr>
            <td>
                <div class="d-flex flex-items-center">
                    <a href="{{ $url->source }}">{{ $url->source }}</a>
                </div>
            </td>
            <td><a href="{{ route('post', $url->booru_id) }}">Image</a></td>
            <td>{{ $url->created_at->diffForHumans() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $urls->links() }}

@else
<div style="border: 1px solid rgba(0, 0, 0, 0.2); background: #ffe2c2; padding: 16px;">
    <p><b>No sources exist!</b></p>
    <div class="d-block">You can help out by creating a source when uploading an image.</div>
</div>
@endif

@endsection
