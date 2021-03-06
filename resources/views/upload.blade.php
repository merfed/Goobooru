@extends('layouts.no-sidebar')

@section('mini-nav')
@include('partials.mini-nav.posts')
@endsection

@section('content')

<div class="container-sm">
    <div class="upload-guidelines">
        <p><b>Upload guidelines</b></p>

        <p>Please keep the following guidelines in mind when uploading something. Violating these rules will result in a ban.</p>

        <p><b>Read the <a href="#">Terms of Service</a> under prohibited content!</b></p>

        <ul>
            <li>Read our terms of service before continuing. This has been updated to reflect recent changes in our policy.</li>
            <li>Rate images appropriately. If you wouldn't look at it in front of your family, then it's probably not safe.</li>
            <li>While there is not a specific topic here, try and <b>stick to the status quo</b>.</li>
            <li>Do not upload images with compression artifacts, obnoxious watermarks, or generally garbage images.</li>
            <li>Tag your images that you are going to upload with <b>at least 5 tags!</b> Tag correctly or you will be banned.</li>
        </ul>

        <p>All accounts have unlimited and unmoderated uploads. This will change inthe future if you ignore the above rules.</p>

        <p><b>If your image returns that it is a duplicate, that means it already exists! Help by updating any info you have.</b></p>
    </div>

    <form method="POST" action="{{ route('uploadPost') }}" enctype="multipart/form-data" files="true">
        @csrf

        <dl class="form-group">
            <dt><label for="file">File</label></dt>
            <dd><input class="form-control input-block" type="file" name="file"></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="source">Source</label></dt>
            <dd><input class="form-control input-block" type="text" name="source"></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="title">Title</label></dt>
            <dd><input class="form-control input-block" type="text" name="title"></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="artist">Artist</label></dt>
            <dd><input class="form-control input-block" type="text" name="artist"></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="character">Character</label></dt>
            <dd><input class="form-control input-block" type="text" name="character"></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="copyright">Copyright</label></dt>
            <dd><input class="form-control input-block" type="text" name="copyright"></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="year">Year</label></dt>
            <dd><input class="form-control input-block" type="text" name="year"></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="tags">Tags</label></dt>
            <dd><textarea class="form-control input-block" name="tags" id="" cols="30" rows="10"></textarea></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="rating">Rating</label></dt>
            <dd class="form-checkbox">
                <div class="d-block"><input type="radio" name="rating" value="1"> Safe</div>
                <div class="d-block"><input type="radio" name="rating" value="2"> Questionable</div>
                <div class="d-block"><input type="radio" name="rating" value="3"> Explicit</div>
            </dd>
        </dl>

        <button class="btn" type="submit">Upload</button>
    </form>
</div>

@endsection
