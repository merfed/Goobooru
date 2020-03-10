<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Tagged;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Tags extends Controller
{
    public function index()
    {
        return view('tags.list', ['tags' => Tag::withCount('posts')->paginate(40)]);
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tags' => 'required',
        ]);

        return self::processTags(request('tags'));
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', ['tag' => $tag]);
    }

    public function change(Tag $tag, Request $request)
    {
        $this->validate($request, [
            'old'  => 'required',
            'name' => [
                'required',
                Rule::unique('tags')->ignore($tag->id),
            ],
        ]);

        if ($tag->name != request('old')) {
            return back()->with('error', 'Please don\'t change the original tag name.');
        }

        $tag->name = request('name');
        $tag->save();

        return redirect()->route('tags')->with('success', 'The tag <b>' . request('old') . '</b> has been changed to <b>' . request('name') . '</b>.');
    }

    public function destroy(Tag $tag)
    {
        return view('tag.delete', ['tag' => $tag]);
    }

    public function getPosts(Tag $tag)
    {
        return view('posts.index', [
            'tags'  => Tag::withCount('posts')->latest()->take(40)->get(),
            'posts' => $tag->posts()->paginate(config('goobooru.paginate')),
        ]);
    }
}
