<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumThread extends Model
{
    protected $table = 'forum_threads';
    protected $guarded = ['id'];

    public function category()
    {
        return $this->hasOne('App\ForumCategory', 'id', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany('App\ForumComment', 'thread_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function responder()
    {
        return $this->hasOne('App\ForumComment', 'thread_id', 'id')->latest();
    }
}
