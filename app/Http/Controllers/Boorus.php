<?php

namespace App\Http\Controllers;

use Auth;
use App\Booru;
use App\Tag;
use App\Fav;
use App\Comment;
use Image;
use Illuminate\Http\Request;

class Boorus extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'tags' => Tag::defaultListing(),
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
            'post' => Booru::all()->random(),
            'metas' => ['artists', 'characters', 'copyrights', 'years']
        ]);
    }

    public function hot()
    {
        return view('posts.index', [
            'tags' => Tag::defaultListing(),
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

        $image = Image::make($request->file('file'));
        $slug = str_random(32);
        $path = public_path(config('goobooru.upload_path'));
        $thumbnail_path = public_path(config('goobooru.upload_path_thumb'));
        $ext = $request->file('file')->getClientOriginalExtension();

        $original = $slug .'.'. $ext;
        $thumbnail = 'thumb_' . $slug . '.' . $ext;
        $image->save($path.$original);

        $image->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image->save($thumbnail_path.$thumbnail);



        // $name = str_random(32) .'.'. $image->getClientOriginalExtension();

        // $image->move(public_path(config('goobooru.upload_path')), $name);

        $booru = Booru::create([
            'image' => $original,
            'uploader_id' => Auth::user()->id,
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

    public function fav(Booru $id)
    {
        $check = Fav::where('image_id', $id->id)->where('user_id', Auth::user()->id)->first();

        if ($check != null) {
            return back()->with('error', 'This post has already been favorited.');
        }

        Fav::create([
            'image_id' => $id->id,
            'user_id' => Auth::user()->id
        ]);

        return back()->with('success', 'This post has been added to your favorites.');
    }

    public function unfav(Booru $id)
    {
        $check = Fav::where('image_id', $id->id)->where('user_id', Auth::user()->id)->first();

        if ($check == null) {
            return back()->with('error', 'This post does not exist in your favorites.');
        }

        $check->delete();

        return back()->with('success', 'This post removed from your favorites.');
    }

    public function comment(Booru $id, Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        Comment::create([
            'body' => request('body'),
            'user_id' => Auth::user()->id,
            'booru_id' => $id->id
        ]);

        return back()->with('success', 'Your comment has been posted.');
    }
}
