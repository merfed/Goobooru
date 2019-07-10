@extends('layouts.no-sidebar')

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

    <form>
        <dl class="form-group">
            <dt><label for="file">File</label></dt>
            <dd><input class="form-control" type="file" name="file"></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="source">Source</label></dt>
            <dd><input class="form-control" type="text" name="source"></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="title">Title</label></dt>
            <dd><input class="form-control" type="text" name="title"></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="tags">Tags</label></dt>
            <dd><textarea class="form-control" name="tags" id="" cols="30" rows="10"></textarea></dd>
        </dl>
    </form>
</div>

@endsection
