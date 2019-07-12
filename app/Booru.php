<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booru extends Model
{
    protected $guarded = ['id'];

    public function uploader()
    {
        return $this->hasOne('App\User', 'id', 'uploader_id');
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

    public function getRating()
    {
        $ratings = [
            1 => 'Safe',
            2 => 'Questionable',
            3 => 'Explicit'
        ];

        return $ratings[$this->rating];
    }

    public function getFileType()
    {
        return pathinfo(asset('uploads/'. $this->image), PATHINFO_EXTENSION);
    }
}
