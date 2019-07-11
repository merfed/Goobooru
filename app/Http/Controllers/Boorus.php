<?php

namespace App\Http\Controllers;

use App\Booru;
use App\Tag;
use Illuminate\Http\Request;

class Boorus extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'tags' => Tag::withCount('posts')->latest()->take(40)->get(),
            'posts' => Booru::latest()->paginate(config('goobooru.paginate'))
        ]);
    }

    public function post(Booru $id)
    {
        $id->views += 1;
        $id->save();

        return view('posts.view', [
            'post' => $id,
            'metas' => ['artists', 'characters', 'copyrights', 'years']
        ]);
    }

    public function random()
    {
        return view('posts.view', [
            'post' => Booru::all()->random()
        ]);
    }

    public function hot()
    {
        return view('posts.index', [
            'tags' => Tag::withCount('posts')->latest()->take(40)->get(),
            'posts' => Booru::where('views', '>', config('goobooru.hot_threshold'))->paginate(config('goobooru.paginate'))
        ]);
    }

    public function tos()
    {
        return view('posts.tos');
    }

    public function dcma()
    {
        return view('posts.dcma');
    }

    public function create()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:'. config('goobooru.allowed_filetypes') .'|max:'. config('goobooru.max_file_size'),
            'title' => 'max:512',
            'tags' => 'required',
            'rating' => 'required'
        ]);

        // if (!$this->checkImage()) {
        //     return back()->with('error', 'The image you attempted to upload exists already in this booru, and can be found <a href="#">here</a>.');
        // }

        if (!Tags::hasEnoughTags(request('tags'))) {
            return back()->with('error', 'You have not supplied enough tags to meet the minimum required amount of <b>'. config('goobooru.min_tags') .'</b>');
        }

        $image = $request->file('file');
        $name = str_random(32) .'.'. $image->getClientOriginalExtension();

        $image->move(public_path(config('goobooru.upload_path')), $name);

        $booru = Booru::create([
            'image' => $name,
            'uploader_id' => 1,
            'source' => trim(request('source')),
            'title' => trim(request('title')),
            'rating' => request('rating'),
        ]);

        Tags::processTags(request('tags'), $booru);

        $this->processMeta($request, $booru);

        return redirect()->back()->with('success', 'Your image has been uploaded successfully.');
    }

    public function queue()
    {
        return view('posts.queue', ['posts' => Booru::doesntHave('tags')->paginate(20)]);
    }

    public function processQueue(Booru $id, Request $request)
    {
        $this->validate($request, [
            'tags' => 'required',
            'rating' => 'required'
        ]);

        if (!Tags::hasEnoughTags(request('tags'))) {
            return back()->with('error', 'You have not supplied enough tags to meet the minimum required amount of <b>'. config('goobooru.min_tags') .'</b>');
        }

        Tags::processTags(request('tags'), $id);

        return back()->with('success', 'You have successfully processed the image in the queue.');
    }

    public function checkImage($image)
    {
        // md5 desired file
        // check against existing hashes
        // HASH FOUND
            // return FALSE
        // NO HASH FOUND
            // Create hash
            // return TRUE
    }

    public function processMeta($request, $booru)
    {
        $metas = [
            1 => 'artist',
            2 => 'character',
            3 => 'copyright',
            4 => 'year'
        ];

        foreach ($metas as $id => $type) {
            if ($request->has($type)) {
                Tags::processMeta(request($type), $id, $booru);
            }
        }
    }
}
