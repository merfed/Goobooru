<?php

namespace App\Http\Controllers;

use App\Tagged;
use App\Tag;
use Illuminate\Http\Request;

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
            'tags' => 'required'
        ]);

        return self::processTags(request('tags'));
    }

    public function edit()
    {

    }

    public function destroy()
    {

    }

    public static function hasEnoughTags($tags)
    {
        return (count(explode(',', $tags)) >= config('goobooru.min_tags'));
    }

    public static function processTags($tags, $booru = null)
    {
        $tags = rtrim($tags, ',');
        $tags = explode(',', $tags);
        $ignored = [];

        foreach ($tags as $tag) {
            $tag = trim($tag);

            if ($tag !== '') {
                $check = Tag::where('name', $tag)->first();

                if ($check === null) {
                    $t = Tag::create([
                        'name' => $tag,
                        'type' => 0
                    ]);

                    if ($booru != null) {
                        Tagged::create([
                            'booru_id' => $booru->id,
                            'tag_id' => $t->id
                        ]);
                    }
                } else {
                    $ignored[] = $tag;
                }
            }
        }

        if (count($ignored) == 0) {
            return redirect()->back()->with('success', 'All tags have been added!');
        } elseif (count($ignored) == count($tags)) {
            return redirect()->back()->with('error', 'None of the following tags have been added since they are all duplicates: <i>'. implode(',', $ignored) .'</i>.');
        } else {
            return redirect()->back()->with('warning', 'Some of the tags you entered were duplicates and were not added: <i>'. implode(',', $ignored) .'</i>.');
        }
    }
}
