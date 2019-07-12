@extends('layouts.no-sidebar')

@section('mini-nav')
@include('partials.mini-nav.tags')
@endsection

@section('content')

@if ($tags->count() > 0)

<div style="border: 1px solid rgba(0, 0, 0, 0.2); background: #ffe2c2; padding: 16px; margin-bottom: 16px;">
    <p style="margin-bottom: 0 !important;">There are <b>{{ $tags->count() }}</b> tags! Tags are created when uploading an image. Tags can be edited here individually which will update across all the images associated with this tag. Deleting a tag requires you to provide a alternative for images associated with it to be retagged with. Abuse of the tags will result in a ban! So tag responsibly.</p>
</div>

<table class="tags-table" style="width: 100%; text-align: left;">
    <thead>
        <th style="width: 80%;">Tag</th>
        <th style="width: 10%;">Type</th>
        <th style="width: 10%;">Created</th>
    </thead>
    <tbody>
        @foreach ($tags as $tag)
        <tr>
            <td>
                <div class="d-flex flex-items-center">
                    <a href="{{ route('tagPosts', ['tag' => $tag->name]) }}" class="flex-auto">{{ $tag->name }} <span style="color: #ccc; font-size: 12px;">({{ number_format($tag->posts_count) }})</span></a>

                    <a href="#" class="tag-edit">Edit</a>
                    <a href="#" class="tag-delete">Delete</a>
                </div>
            </td>
            <td>{{ $tag->getHumanReadableType() }}</td>
            <td>{{ $tag->created_at->diffForHumans() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $tags->links() }}

@else
<div style="border: 1px solid rgba(0, 0, 0, 0.2); background: #ffe2c2; padding: 16px;">
    <p><b>No tags exist!</b></p>
    <div class="d-block">You can help out by creating a tag when uploading an image.</div>
</div>
@endif

@endsection
