@extends('layouts.no-sidebar')

@section('content')
<div class="d-flex">
    <div class="forum-sidebar">
        <div class="threads">
            <h3>Threads</h3>

            <ul class="thread-categories">
                <li><a href="#">Discussions</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Advice</a></li>
                <li><a href="#">Meaningless</a></li>
            </ul>

            <div class="thread-search">
                <input type="text" placeholder="Search thread titles...">
            </div>
        </div>
    </div>

    <div class="forum-main flex-auto">
        <div class="container-sm">
            <div class="upload-guidelines">
                <p><b>Whatchu got to say?</b></p>

                <p class="mb-0">Think you have something good enough to say to post a thread about it? Well have it! Remember that posting a thread is no small thing. Millions of people will read it so make it good!</p>
            </div>

            <form action="{{ route('postNewThread') }}" method="POST">
                @csrf

                <dl class="form-group">
                    <dt><label for="title">Title</label></dt>
                    <dd><input type="text" class="form-control input-block" name="title"></dd>
                </dl>

                <dl class="form-group">
                    <dt><label for="category_id">Category</label></dt>
                    <dd><select class="form-control" name="category_id" id="category_id">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select></dd>
                </dl>

                <div class="mt-2">
                    <textarea name="body" id="" cols="30" rows="10" class="form-control input-block" placeholder="Remember be nice..."></textarea>
                </div>

                <div class="mt-2">
                    <button class="btn-primary btn" type="submit">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
