<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = ['id'];

    public function posts()
    {
        return $this->belongsToMany('App\Booru', 'boorus_tags');
    }

    public function getType()
    {
        $type = [
            0 => 'tag',
            1 => 'artist',
            2 => 'character',
            3 => 'copyright',
            4 => 'year'
        ];

        return $type[$this->type];
    }

    public function getHumanReadableType()
    {
        $type = [
            0 => 'General',
            1 => 'Artist',
            2 => 'Character',
            3 => 'Copyright',
            4 => 'Year'
        ];

        return $type[$this->type];
    }

    public static function defaultListing()
    {
        return Tag::withCount('posts')->latest()->take(40)->get();
    }

    public static function hasEnoughTags($tags)
    {
        return (count(explode(',', $tags)) >= config('goobooru.min_tags'));
    }

    public static function processMeta($tags, $type, $booru = null)
    {
        $ignored = [];

        if ($tags != null) {
            $tags = explode(',', $tags);

            foreach ($tags as $tag) {
                $tag = trim($tag);

                if ($tag !== '' || $tag !== "" || empty($tag)) {
                    $check = Tag::where('name', $tag)->where('type', $type)->first();
                    if ($check === null) {
                        $t = Tag::create([
                            'name' => $tag,
                            'type' => $type,
                        ]);

                        if ($booru != null) {
                            Tagged::create([
                                'booru_id' => $booru->id,
                                'tag_id'   => $t->id,
                            ]);
                        }
                    } else {
                        if ($booru != null) {
                            Tagged::create([
                                'booru_id' => $booru->id,
                                'tag_id'   => $check->id,
                            ]);
                        }

                        $ignored[] = $tag;
                    }
                }
            }
        }

        if (count($ignored) == 0) {
            return redirect()->back()->with('success', 'All tags have been added!');
        } else {
            return redirect()->back()->with('warning', 'Some of the tags you entered were duplicates and were not added: <i>' . implode(',', $ignored) . '</i>.');
        }
    }

    public static function processTags($tags, $booru = null)
    {
        $tags    = rtrim($tags, ',');
        $tags    = explode(',', $tags);
        $ignored = [];

        foreach ($tags as $tag) {
            $tag   = trim($tag);
            $check = Tag::where('name', $tag)->first();

            if ($tag !== '') {
                if ($check === null) {
                    $t = Tag::create([
                        'name' => $tag,
                        'type' => 0,
                    ]);

                    if ($booru != null) {
                        Tagged::create([
                            'booru_id' => $booru->id,
                            'tag_id'   => $t->id,
                        ]);
                    }
                } else {
                    if ($booru != null) {
                        Tagged::create([
                            'booru_id' => $booru->id,
                            'tag_id'   => $check->id,
                        ]);
                    }

                    $ignored[] = $tag;
                }
            }
        }

        if (count($ignored) == 0) {
            return redirect()->back()->with('success', 'All tags have been added!');
        } elseif (count($ignored) == count($tags)) {
            return redirect()->back()->with('error', 'None of the following tags have been added since they are all duplicates: <i>' . implode(',', $ignored) . '</i>.');
        } else {
            return redirect()->back()->with('warning', 'Some of the tags you entered were duplicates and were not added: <i>' . implode(',', $ignored) . '</i>.');
        }
    }
}
