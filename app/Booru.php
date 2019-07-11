<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booru extends Model
{
    protected $guarded = ['id'];

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'boorus_tags')->withCount('posts');
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
}
