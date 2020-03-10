<?php

namespace App;

use Auth;
use Image;
use App\Tag;
use Illuminate\Database\Eloquent\Model;

class Booru extends Model
{
    protected $guarded = ['id'];

    public function uploader()
    {
        return $this->hasOne('App\User', 'id', 'uploader_id');
    }

    public function allTags()
    {
        return $this->belongsToMany('App\Tag', 'boorus_tags')->withCount('posts');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'boorus_tags')->where('type', 0)->withCount('posts');
    }

    public function artists()
    {
        return $this->belongsToMany('App\Tag', 'boorus_tags')->where('type', 1)->withCount('posts');
    }

    public function characters()
    {
        return $this->belongsToMany('App\Tag', 'boorus_tags')->where('type', 2)->withCount('posts');
    }

    public function copyrights()
    {
        return $this->belongsToMany('App\Tag', 'boorus_tags')->where('type', 3)->withCount('posts');
    }

    public function years()
    {
        return $this->belongsToMany('App\Tag', 'boorus_tags')->where('type', 4)->withCount('posts');
    }

    public function source()
    {
        return $this->hasOne('App\Source', 'booru_id');
    }

    public function flagged()
    {
        return $this->hasMany('App\Flag', 'booru_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'booru_id');
    }

    public function pools()
    {
        return $this->belongsToMany('App\Pool', 'boorus_pools', 'booru_id', 'pool_id');
    }

    public function getRating($lowercase = false)
    {
        $ratings = [
            1 => 'Safe',
            2 => 'Questionable',
            3 => 'Explicit',
        ];

        return ($lowercase) ? strtolower($ratings[$this->rating]) : $ratings[$this->rating];
    }

    public function getFileType()
    {
        return pathinfo(asset('uploads/' . $this->image), PATHINFO_EXTENSION);
    }

    public function isFavorited()
    {
        $check = \App\Fav::where('image_id', $this->id)->where('user_id', Auth::user()->id)->first();

        return ($check != null) ? true : false;
    }

    public function isFlagged()
    {
        return ($this->flagged->where('creator_id', Auth::user()->id)->count()) ? true : false;
    }

    public function unFlag()
    {
        return $this->flagged()->delete();
    }

    public function flag()
    {
        Flag::create([
            'booru_id'   => $this->id,
            'creator_id' => Auth::user()->id,
        ]);
    }

    public function getSource()
    {
        return ($this->source == null) ? 'Unknown' : $this->source->source;
    }

    public function posScore()
    {
        return $this->hasMany('App\Score', 'booru_id')->sum('pos');
    }

    public function negScore()
    {
        return $this->hasMany('App\Score', 'booru_id')->sum('neg');
    }

    public function getScore()
    {
        $pos = ($this->posScore() != null) ? $this->posScore() : 0;
        $neg = ($this->negScore() != null) ? $this->negScore() : 0;

        return (object) [
            'simple' => $pos - $neg,
            'pos'    => $pos,
            'neg'    => $neg,
        ];
    }

    public static function upload($data, $checkTags = true)
    {
        // if (!$this->checkImage()) {
        //     return back()->with('error', 'The image you attempted to upload exists already in this booru, and can be found <a href="#">here</a>.');
        // }

        if ($checkTags) {
            if (! Tag::hasEnoughTags($data->tags)) {
                return back()->with('error', 'You have not supplied enough tags to meet the minimum required amount of <b>' . config('goobooru.min_tags') . '</b>');
            }
        }

        $slug = str_random(32);
        $ext = $data->file->getClientOriginalExtension();
        $path = public_path(config('goobooru.upload_path'));
        $thumbnail_path = public_path(config('goobooru.upload_path_thumb'));
        $original = Image::make($data->file);
        $thumbnail = Image::make($data->file);
        $thumbnail->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $upload = (object) [
            'original' => (object) [
                'image' => $original,
                'name' => $slug .'.'. $ext,
                'width' => $original->width(),
                'height' => $original->height(),
                'path' => $path . $slug .'.'. $ext,
            ],
            'thumbnail' => (object) [
                'image' => $thumbnail,
                'name' => 'thumb_'. $slug .'.'. $ext,
                'path' => $thumbnail_path . 'thumb_'. $slug .'.'. $ext,
            ],
            'title' => $data->title,
            'rating' => $data->rating,
            'source' => $data->source
        ];

        $original->save($upload->original->path);
        $thumbnail->save($upload->thumbnail->path);

        $booru = Booru::create([
            'image' => $upload->original->name,
            'uploader_id' => Auth::user()->id,
            'title' => $upload->title,
            'rating' => $upload->rating,
            'width' => $upload->original->width,
            'height' => $upload->original->height,
        ]);

        if ($upload->source != null) {
            Source::create([
                'booru_id' => $booru->id,
                'source' => trim($upload->source)
            ]);
        }

        if ($checkTags) {
            Tag::processTags($data->tags, $booru);

            $metas = [
                1 => 'artist',
                2 => 'character',
                3 => 'copyright',
                4 => 'year',
            ];

            foreach ($metas as $id => $type) {
                if ($data->has($type)) {
                    Tag::processMeta(request($type), $id, $booru);
                }
            }
        }
    }
}
