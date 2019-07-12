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

    public static function defaultListing()
    {
        return Tag::withCount('posts')->latest()->take(40)->get();
    }
}
