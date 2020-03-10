<?php

namespace App;

use Auth;
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
}
