<?php

namespace App\Http\Controllers;

use Auth;
use App\ForumCategory;
use App\ForumThread;
use App\ForumComment;
use Illuminate\Http\Request;

class Forums extends Controller
{
    public function index()
    {
        return view('forum.index', ['threads' => ForumThread::withCount('comments')->latest()->paginate(50)]);
    }

    public function create()
    {
        return view('forum.create', ['categories' => ForumCategory::all()]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        $thread = ForumThread::create([
            'title' => request('title'),
            'user_id' => Auth::user()->id,
            'category_id' => request('category_id')
        ]);

        ForumComment::create([
            'body' => request('body'),
            'user_id' => Auth::user()->id,
            'thread_id' => $thread->id,
        ]);

        return back()->with('success', 'Your thread has been posted!');
    }

    public function view(ForumThread $id)
    {
        return view('forum.thread', ['thread' => $id, 'comments' => $id->comments()->oldest()->paginate(2)]);
    }

    public function reply(ForumThread $id, Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        ForumComment::create([
            'body' => request('body'),
            'user_id' => Auth::user()->id,
            'thread_id' => $id->id,
        ]);

        return back()->with('success', 'Your reply has been posted!');
    }

    public function category()
    {
        return view('forum.category');
    }
}
